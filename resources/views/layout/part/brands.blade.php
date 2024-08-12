<ul>
    @foreach ($items as $item)
        <li>
            <a href="{{ route('catalog.category', ['slug' => $item->slug,'locale' => app()->getLocale()]) }}">{{ $item->name }}</a>
            @if ($item->descendants?->count())
                <span class="badge badge-dark">
                <i class="fa fa-plus"></i>
            </span>
                @include('layout.part.branch', ['items' => $item->children])
            @endif
        </li>
    @endforeach
</ul>
