<?php

namespace App\View;

use Illuminate\View\Compilers\BladeCompiler;
use Roots\Acorn\View\ViewServiceProvider as BaseViewServiceProvider;

use function collect;
use function sprintf;

class ViewServiceProvider extends BaseViewServiceProvider
{
    protected BladeCompiler $compiler;

    public function register()
    {
        parent::register();

        $this->app->singleton('templateLoader', TemplateLoader::class);
    }

    public function boot(?BladeCompiler $compiler = null)
    {
        $this->compiler = $compiler;

        parent::boot();

        $this->app['templateLoader']->boot();

        $this->attachHelpers();
    }

    protected function attachHelpers()
    {
        $this->compiler->precompiler(function ($value) {
            $prefix = collect($this->app['config']['view.helpers'])
                ->map(fn($fqn, $alias) => sprintf('use function %s as %s;', $fqn, $alias))
                ->implode("\n");

            $value = "<?php\n$prefix\n?>$value";

            return $value;
        });
    }
}
