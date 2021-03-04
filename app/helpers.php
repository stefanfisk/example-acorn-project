<?php

namespace App;

use function array_pop;
use function array_push;
use function end;

/**
 * Pushes a post to the top of the post data stack.
 *
 * The global $post variable is set to $new_post, and then setup_postdata($post)
 * is called.
 *
 * @param WP_Post $post The new post to push onto the post stack.
 */
function push_postdata($post)
{
    $stack = app()['view.postdata'] ?? [];

    array_push($stack, $post);

    app()['view.postdata'] = $stack;

    reset_postdata();
}

/**
 * Pops the current post from the post data stack.
 *
 * The global $post variable is restored to the previous post, and then
 * setup_postdata($post) is called.
 */
function pop_postdata()
{
    $stack = app()['app.view.postdata'] ?? [];

    array_pop($stack);

    app()['view.postdata'] = $stack;

    reset_postdata();
}

/**
 * Resets the global post data to the last post in the post stack.
 */
function reset_postdata()
{
    $stack = app()['view.postdata'] ?? [];

    $post = end($stack);

    if ($post) {
        $GLOBALS['post'] = $post;

        setup_postdata($post);
    } else {
        wp_reset_postdata();
    }
}
