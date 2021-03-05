<?php

namespace App\Providers;

use App\Traits\AddsHooksTrait;
use Illuminate\Support\Str;
use Roots\Acorn\Assets\AssetsServiceProvider as BaseServiceProvider;

use function array_merge;
use function file_exists;
use function Roots\asset;
use function wp_enqueue_script;
use function wp_enqueue_style;

class AssetsServiceProvider extends BaseServiceProvider
{
    use AddsHooksTrait;

    public function boot()
    {
        $this->addAction('wp_enqueue_scripts');
        $this->addAction('admin_enqueue_scripts');
        $this->addAction('enqueue_block_editor_assets');
    }

    public function wpEnqueueScripts()
    {
        $this->enqueueScript('front');
        $this->enqueueStyle('front');
    }

    public function adminEnqueueScripts()
    {
        $this->enqueueScript('admin');
        $this->enqueueStyle('admin');
    }

    public function enqueueBlockEditorAssets()
    {
        add_theme_support('editor-styles');

        $this->enqueueScript('editor');
        $this->enqueueStyle('editor', ['wp-edit-blocks']);
    }

    /**
     * @param string $handle
     * @param string[] $deps
     * @param bool $inFooter
     */
    protected function enqueueScript($handle, $deps = [], $inFooter = true)
    {
        $asset = asset("js/$handle.js");

        $assetMetaPath = Str::replaceLast('.js', '.asset.php', $asset->path());

        $assetMeta = file_exists($assetMetaPath)
            ? require $assetMetaPath
            : ['dependencies' => []];

        $deps = array_merge($deps, $assetMeta['dependencies']);

        wp_enqueue_script("app/$handle", $asset->uri(), $deps, null, $inFooter);
    }

    /**
     * @param string $handle
     * @param string[] $deps
     */
    protected function enqueueStyle($handle, $deps = [])
    {
        wp_enqueue_style("app/$handle", asset("css/$handle.css")->uri(), $deps, false, null);
    }
}
