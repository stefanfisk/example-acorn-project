<?php

namespace App\Providers;

use App\Traits\AddsHooksTrait;
use Roots\Acorn\ServiceProvider;

use function array_replace_recursive;

class BlockEditorServiceProvider extends ServiceProvider
{
    use AddsHooksTrait;

    public function boot()
    {
        $this->addFilter('register_post_type_args', 'filterWpBlockRegisterPostTypeArgs');
    }

    /**
     * Make wp_block show admin UI.
     *
     * @param array  $args
     * @param string $postType
     * @return array
     */
    public function filterWpBlockRegisterPostTypeArgs($args, $postType)
    {
        if ('wp_block' !== $postType) {
            return $args;
        }

        $args = array_replace_recursive($args, [
            '_builtin'          => false,
            'show_in_menu'      => true,
            'show_in_admin_bar' => true,
            'menu_position'     => 63,
            'menu_icon'         => 'dashicons-screenoptions',
            'supports'          => [
                'revisions',
            ],
        ]);

        return $args;
    }
}
