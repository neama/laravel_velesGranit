<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-header">
            <h5 class="text-center">{{ $product->name }}</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                @if ($product->image)
                    @php($url = url('storage/catalog/product/source/' . $product->image))
                    <div class="image-container">
                        <img src="{{ $url }}" class="img-fluid" alt="">
                    </div>
                @else
                    <div class="image-container">
                        <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="">
                    </div>
                @endif
            </li>
            <li class="list-group-item">
                <span style="float: left;">{{ number_format($product->price, 2, '.', '') }}</span>
                <span style="float: right;">(lei.)</span>
            </li>
        </ul>
        <div class="card-footer">
            <a href="{{ route('catalog.product', ['slug' => $product->slug,'locale' => app()->getLocale()]) }}" class="btn btn-primary mx-auto d-block">{{__('Go to product')}}</a>
        </div>
    </div>
</div>

<style>
    .image-container {
        width: 100%;
        height: 210px; /* Фиксированная высота */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-container img {
        max-height: 100%;
        width: auto;
    }
</style>
