<ul>
    @foreach ($items->where('parent_id', $parent) as $item)
        <li>
            <a href="{{ route('catalog.category', ['category' => $item->slug,'locale' => app()->getLocale()]) }}">{{ $item->name }}</a>
            @if (count($items->where('parent_id', $item->id)))
                <span class="badge badge-dark">
                <i class="fa fa-plus"></i>
            </span>
                @include('layout.part.branch', ['parent' => $item->id])
            @endif
        </li>
    @endforeach
</ul>
