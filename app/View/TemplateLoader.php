<?php

namespace App\View;

use App\Traits\AddsHooksTrait;
use Illuminate\Contracts\Container\Container as ContainerContract;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Roots\Acorn\Filesystem\Filesystem;
use Roots\Acorn\View\FileViewFinder;

use function array_map;
use function array_reverse;
use function collect;
use function explode;
use function file_get_contents;
use function preg_match;
use function realpath;
use function str_replace;

class TemplateLoader
{
    use AddsHooksTrait;

    /** @var View|string|null $view */
    public $view;

    /** @var ContainerContract $app */
    protected $app;
    /** @var Filesystem $files */
    protected $files;
    /** @var FileViewFinder $finder */
    protected $finder;
    /** @var ViewFactory $viewFactory */
    protected $viewFactory;

    public function __construct(
        ContainerContract $app,
        Filesystem $files,
        FileViewFinder $finder,
        ViewFactory $viewFactory
    ) {
        $this->app         = $app;
        $this->files       = $files;
        $this->finder      = $finder;
        $this->viewFactory = $viewFactory;
    }

    public function boot()
    {
        $this->addFilter('theme_templates');

        collect([
            'index',
            '404',
            'archive',
            'author',
            'category',
            'tag',
            'taxonomy',
            'date',
            'home',
            'frontpage',
            'page',
            'paged',
            'search',
            'single',
            'singular',
            'attachment',
        ])->each(function ($type) {
            $this->addFilter("{$type}_template_hierarchy", 'filterTemplateHierarchy');
        });

        $this->addFilter('template_include');
    }

    /**
     * Merge page templates from /resources/views/templates with template list.
     *
     * Adapted from Roots\Acorn\Sage\Concerns::filterThemeTemplates(). Removes '.blade' from suffix
     * for backwards compatibility.
     *
     * @param string[]     $templates Array of template header names keyed by the template file name.
     * @param WP_Theme     $theme     The theme object.
     * @param WP_Post|null $post      The post being edited, provided for context, or null.
     * @param string       $postType  Post type to get the templates for.
     * @return string[] List of theme templates
     */
    public function filterThemeTemplates($templates, $theme, $post, $postType)
    {
        $viewTemplates = [];

        foreach (array_reverse($this->finder->getPaths()) as $dir) {
            foreach ($this->files->glob("$dir/templates/*.php") as $file) {
                if (! preg_match('|Template Name:(.*)$|mi', file_get_contents($file), $header)) {
                    continue;
                }

                $templatePostTypes = ['page'];

                if (preg_match('|Template Post Type:(.*)$|mi', file_get_contents($file), $match)) {
                    $templatePostTypes = explode(',', _cleanup_header_comment($match[1]));
                }

                $template = $this->files->getRelativePath("$dir/templates/", $file);
                $template = str_replace('.blade.php', '.php', $template);

                foreach ($templatePostTypes as $type) {
                    $type = sanitize_key($type);

                    if (! isset($viewTemplates[$type])) {
                        $viewTemplates[ $type ] = [];
                    }

                    $viewTemplates[$type][$template] = _cleanup_header_comment($header[1]);
                }
            }
        }

        return collect($templates)
            ->merge($viewTemplates[$postType] ?? [])
            ->unique()
            ->sortKeys()
            ->toArray();
    }

    /**
     * Prefer view templates before standard templates.
     *
     * @param  array $files
     * @return string[] List of possible files and views
     */
    public function filterTemplateHierarchy($files)
    {
        $relativeViewPaths = array_map(
            fn($dir) => $this->files->getRelativePath(STYLESHEETPATH . '/', $dir),
            $this->finder->getPaths()
        );

        $viewFiles = [];

        foreach ($files as $file) {
            foreach ($relativeViewPaths as $viewPath) {
                $viewFiles[] = "$viewPath/templates/" . str_replace('.php', '.blade.php', $file);
            }

            $viewFiles[] = $file;
        }

        return $viewFiles;
    }

    /**
     * If file is a Blade view, setup rendering and return path to renderer template.
     *
     * @param  string $file Template file.
     * @return string Template file to include.
     */
    public function filterTemplateInclude($file)
    {
        $file = realpath($file);

        $view = $this->finder->getPossibleViewNameFromPath($file);

        if (! $this->viewFactory->exists($view)) {
            return $file;
        }

        $this->view = $view;

        return get_template_directory() . '/index.php';
    }
}
