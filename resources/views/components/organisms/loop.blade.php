<div>
    @if (! have_posts())
        <x-molecules.alert
            type="warning"
            :message="__('Sorry, no results were found.', 'app')"
        />
    @else
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @while(have_posts())
                @php(the_post())

                <x-molecules.loop.post />
            @endwhile
        </div>
    @endif
</div>
