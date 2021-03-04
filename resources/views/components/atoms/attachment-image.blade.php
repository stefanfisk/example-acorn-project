@props([
    'image',
    'size' => 'large',
])

@php

if ($image instanceof \WP_Post) {
    $image = $image->ID;
} elseif (!empty($image['id'])) {
    $image = $image['id'];
} else {
    $image = $image;
}

@endphp

{!!
wp_get_attachment_image(
    $image,
    $size,
    false,
    iterator_to_array($attributes)
)
!!}
