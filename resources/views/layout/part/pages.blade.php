
@foreach ($pages as $page)
    @if (count($pages->where('parent_id', $page->id)))
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
               role="button" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                {{ $page->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('page.show', ['slug' => $page->slug,'locale' => app()->getLocale()]) }}">
                    {{ $page->name }}
                </a>
                <div class="dropdown-divider"></div>
                @foreach ($pages->where('parent_id', $page->id) as $child)
                    <a class="dropdown-item" href="{{ route('page.show', ['slug' => $child->slug,'locale' => app()->getLocale()]) }}">
                        {{ $child->name }}
                    </a>
                @endforeach
            </div>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('page.show', ['slug' => $page->slug,'locale' => app()->getLocale()]) }}">
                {{ $page->name }}
            </a>
        </li>
    @endif
@endforeach
