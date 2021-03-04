<div>
    @if (! have_posts())
        <x-molecules.alert
            type="warning"
            :message="__('Sorry, no results were found.', 'app')"
        />
    @else
        <div class="container">
            <div class="row">
                @while(have_posts())
                    @php(the_post())

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <x-molecules.loop.post />
                    </div>
                @endwhile
            </div>
        </div>
    @endif
</div>
