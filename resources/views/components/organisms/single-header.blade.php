@props([
    'title' => html(get_the_title()),
    'image' => get_post_thumbnail_id(),
])

<header>
    <x-atoms.attachment-image
        class="w-full"
        :image="$image"
        :size="full"
    />

    <x-atoms.page-heading>{{ $title }}</x-atoms.page-heading>
</header>
