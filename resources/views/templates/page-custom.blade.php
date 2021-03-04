{{--
    Template Name: Custom Template
--}}

<x-layouts.app>
    <x-organisms.single-header />

    <div class="container">
        <p class="lead">
            {{ get_page_template_slug() }}
        </p>

        @php(the_content())
    </div>
</x-layouts.app>
