<?php

namespace App\View;

use Illuminate\Contracts\Support\DeferringDisplayableValue;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

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
