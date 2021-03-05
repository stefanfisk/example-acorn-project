{{--
    Template Name: Custom Template
--}}

<x-layouts.app>
    <x-organisms.single-header />

    <p class="text-gray-500">
        {{ get_page_template_slug() }}
    </p>

    @php(the_content())
</x-layouts.app>
