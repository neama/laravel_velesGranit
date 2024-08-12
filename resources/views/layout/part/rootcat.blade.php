<!-- Catalog Sections Column -->
<div class="col-4  d-flex flex-column">
    <div class="d-flex flex-column">
        <h5 class="text-info">{{ __('Разделы каталога') }}</h5>
        @foreach($items as $item)
            <a href="{{ route('catalog.category', ['slug' => $item->slug,'locale' => app()->getLocale()]) }}" class="d-block mb-2 nav-link_header">
                {{ $item->name }}
            </a>
        @endforeach
    </div>
</div>
