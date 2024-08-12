<a class="nav-link @if ($positions) text-success @endif"
   href="{{ route('basket.index', ['locale' => app()->getLocale()]) }}">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{__('Корзина')}}
    <span id="basketQuant">@if ($positions) ({{ $positions }}) @endif</span>
</a>
