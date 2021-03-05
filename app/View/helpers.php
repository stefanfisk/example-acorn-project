<?php

namespace App\View;

use Illuminate\Contracts\Support\DeferringDisplayableValue;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

use function array_filter;
use function array_map;
use function array_push;
use function array_walk_recursive;
use function explode;
use function implode;
use function is_int;

/**
 * Converts a value to an Htmlable.
 *
 * This is essentially e(), but without escaping.
 *
 * @param mixed $value Value.
 * @return Htmlable
 */
function html($value)
{
    if ($value instanceof DeferringDisplayableValue) {
        $value = $value->resolveDisplayableValue();
    }

    if ($value instanceof Htmlable) {
        return $value;
    }

    return new HtmlString($value);
}

/**
 * Conditionally joins DOM class names.
 *
 * The returned string is escaped and can safely be used for attributes.
 *
 * @param array ...$classes The classes to join.
 * @return string The joined classes.
 */
function classnames(...$classes)
{
    if (! $classes) {
        return '';
    }

    $effectiveClasses = [];

    array_walk_recursive(
        $classes,
        function ($value, $key) use (&$effectiveClasses) {
            if (is_int($key)) {
                $class = $value;
            } elseif ($value) {
                $class = $key;
            } else {
                return;
            }

            array_push($effectiveClasses, ...explode(' ', $class));
        }
    );

    $effectiveClasses = array_map('trim', $effectiveClasses);
    $effectiveClasses = array_filter($effectiveClasses);

    return implode(' ', $effectiveClasses);
}
