<?php

namespace App\Providers;

use App\Traits\AddsHooksTrait;
use Roots\Acorn\Assets\AssetsServiceProvider as BaseServiceProvider;

use function Roots\asset;

class AssetsServiceProvider extends BaseServiceProvider
{
    use AddsHooksTrait;

    public function boot()
    {
        $this->addAction('wp_enqueue_scripts', 'enqueueAssets');
    }

    public function enqueueAssets() {
        wp_enqueue_script('app/app.js', asset('js/app.js')->uri(), [], null, true);
        wp_enqueue_style('app/app.css', asset('css/app.css')->uri(), false, null);
    }
}
