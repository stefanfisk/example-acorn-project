{{--
    Template Name: Custom Template
--}}

<x-layouts.app>
    <h1>{!! get_the_title() !!}</h1>

    <p><strong>This is a custom template</strong></p>

    @php(the_content())
</x-layouts.app>
