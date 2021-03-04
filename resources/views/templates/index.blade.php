<x-layouts.app>
    <h1>{!! get_the_title() !!}</h1>

    @php(the_content())
</x-layouts.app>
