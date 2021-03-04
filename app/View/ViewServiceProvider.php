<?php

namespace App\View;

use Roots\Acorn\View\ViewServiceProvider as BaseViewServiceProvider;

class ViewServiceProvider extends BaseViewServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->singleton('templateLoader', TemplateLoader::class);
    }

    public function boot()
    {
        parent::boot();

        $this->app['templateLoader']->boot();
    }
}
