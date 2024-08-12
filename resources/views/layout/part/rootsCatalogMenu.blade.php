<div id="catalog-sidebar_menu">
    <div class="catalog-item-menu">
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="nav-link">
            {{__('home')}}
        </a>
    </div>
    <div class="catalog-item-menu">
        <a href="{{ route('gallery.preview', ['locale' => app()->getLocale()]) }}" class="nav-link">
            {{__('gallery')}}
        </a>
    </div>
    <div class="catalog-item-menu">
        <a href="{{ route('catalog.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
            {{__('catalog')}}
        </a>
    </div>
    @foreach($items as $item)
        @php
            $displayNone = 'd-none';
            $icon = ' <span class="badge badge-dark"><i class="fa fa-plus"></i></span>';
            if(count($item->children) == 0){
                $icon = '';
            }
            $countCategoryProduct = count($item->getProducts()->get());
            $countCategoryProduct = $countCategoryProduct != 0 ? '('.$countCategoryProduct.')' : '';
        @endphp
        <div class="catalog-item-menu">
            <a href="{{ route('catalog.category', ['slug' => $item->slug,'locale' => app()->getLocale()]) }}" class="nav-link">
                {{ $item->name }}{!! $icon !!}
            </a>
            @if(isset($item->children)&&count($item->children)>=1)
                <div id="children-{{ $item->id }}" class="collapse_menu {{ $displayNone }}" style="width: max-content;">
                    @foreach($item->children as $child)
                        @php
                            $countCategoryProduct = count($child->getProducts()->get());
                            $countCategoryProduct = $countCategoryProduct != 0 ? '('.$countCategoryProduct.')' : '';
                        @endphp
                        <div class="catalog-sub-item-menu">
                            <a href="{{ route('catalog.category', ['slug' => $child->slug,'locale' => app()->getLocale()]) }}" class="nav-link">
                                {{ $child->name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>

<style>
    #catalog-sidebar_menu {
        display: flex;
        flex-wrap: wrap;
        padding: 0;
        margin: 0;
    }

    .catalog-item-menu {
        position: relative;
        margin-right: 5px;
    }

    .nav-link {
        display: block;
        color: #007bff;
        text-decoration: none;
        padding: 5px;
    }

    .nav-link:hover {
        text-decoration: underline;
    }

    .collapse_menu {
        position: absolute;
        top: 100%;
        left: 0;
        background: rgba(255, 255, 255, 1); /* Полупрозрачный фон */
        padding: 10px;
        display: none;
        z-index: 1000;
        border-radius: 10px;
        border-left: 1px solid;
        border-right: 1px solid;
        border-bottom: 1px solid;

    }

    .catalog-item-menu:hover .collapse {
        display: block;
    }

    .catalog-sub-item-menu {
        margin-bottom: 10px;
    }

    .collapse_menu .nav-link {
        color: #000; /* Черный цвет ссылок */
    }

    .badge {
        cursor: pointer;
    }

</style>
