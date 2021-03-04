@props([
    'image',
    'title',
    'text',
    'link',
    'linkText' => __('Read more', 'app'),
])

<div class="card">
    <x-atoms.attachment-image
        class="card-img-top"
        :image="$image"
        :size="medium"
    />

    <div class="card-body">
        <h2 class="card-title">{{ $title }}</h2>

        <p class="card-text">{{ $text }}</p>

        <a class="btn btn-primary" href="{{ $link }}">{{ $linkText }}</a>
    </div>
</div>
