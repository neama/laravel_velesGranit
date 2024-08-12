<!-- Menu Column -->
<div class="col-4  d-flex flex-column">
    <div class="d-flex flex-column">
        <h5 class="text-info">{{ __('Menu') }}</h5>

        @foreach ($pages as $page)
            <a class="nav-link_header mb-2 " href="{{ route('page.show', ['slug' => $page->slug, 'locale' => app()->getLocale()]) }}">
                {{ $page->name }}
            </a>
        @endforeach
    </div>
</div>
