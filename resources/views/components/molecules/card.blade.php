@props([
    'image',
    'meta',
    'title',
    'text',
    'link',
])

<div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
    <div class="flex-shrink-0">
        <x-atoms.attachment-image
            class="h-48 w-full object-cover"
            :image="$image"
            :size="large"
            alt=""
        />
    </div>

    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
        <div class="flex-1">
            @if ($meta)
                <p class="text-sm font-medium text-indigo-600">
                    <a href="{{ $link }}" class="hover:underline">
                        {{ $meta }}
                    </a>
                </p>
            @endif

            <a href="{{ $link }}" class="block mt-2">
                <p class="text-xl font-semibold text-gray-900">
                    {{ $title }}
                </p>

                <p class="mt-3 text-base text-gray-500">
                    {{ $text }}
                </p>
            </a>
        </div>
    </div>
</div>
