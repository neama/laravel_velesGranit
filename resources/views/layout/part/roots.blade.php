<h4>{{__('Разделы каталога')}}</h4>
<div id="catalog-sidebar">
    <ul>
        @foreach($items as $item)
            @php

                if(!in_array($item->name, $breadCrumb)){
                    $displayNone = 'style="display: none;"';
                    $icon = ' <span class="badge badge-dark"><i class="fa fa-plus"></i></span>';
                }else{
                    $displayNone = 'style=';
                    $icon = ' <span class="badge badge-dark"><i class="fa fa-minus"></i></span>';
                }
                if(count($item->children)==0){
                  $icon = '';
                }
            @endphp
            <li>
                @php
                    $countCategoryProduct = count($item->getProducts()->get());
                    $countCategoryProduct = $countCategoryProduct != 0 ? '('.$countCategoryProduct.')' : '';
                @endphp
                <a href="{{ route('catalog.category', ['slug' => $item->slug,'locale' => app()->getLocale()]) }}">{{ $item->name }} {{$countCategoryProduct}}</a>
                @isset($item->children)
                    <?php echo $icon?> <!-- бейдж с плюсом или минусом -->
                    <ul <?php echo $displayNone ?>>
                        @foreach($item->children as $child)
                            <li>
                                @php
                                    $countCategoryProduct = count($child->getProducts()->get());
                                    $countCategoryProduct = $countCategoryProduct != 0 ? '('.$countCategoryProduct.')' : '';
                                    @endphp
                                <a href="{{ route('catalog.category', ['slug' => $child->slug,'locale' => app()->getLocale()]) }}">
                                    {{ $child->name }} {{$countCategoryProduct}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endisset
            </li>
        @endforeach
    </ul>
</div>
