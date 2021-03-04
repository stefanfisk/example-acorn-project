@props([
    'title' => html(get_the_title()),
    'image' => get_post_thumbnail_id(),
])

<header class="container">
    <x-atoms.attachment-image
        class="img-fluid"
        :image="$image"
        :size="full"
    />

    <h1>{{ $title }}</h1>
</header>
