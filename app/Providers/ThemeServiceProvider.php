<?php

namespace App\Providers;

use Roots\Acorn\ServiceProvider as BaseServiceProvider;

class ThemeServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->addThemeSupport();
    }

    protected function addThemeSupport()
    {
        add_theme_support('title-tag');

        add_theme_support(
            'html5',
            [
                'comment-list',
                'comment-form',
                'search-form',
                'gallery',
                'caption',
                'style',
                'script',
            ]
        );

        add_theme_support('post-thumbnails');
    }
}
