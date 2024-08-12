@extends('layout.site')

@section('title', $product->name)
@section('description',  $product->content)
@section('keywords', $product->keywords)

@section('content')
    <div class="row">
        @include('layout.part.modalFormForCall')
        <div class="col-md-3">
            @include('layout.part.roots')
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h1>{{ $product->name }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($product->image)
                                @php($url = url('storage/catalog/product/source/' . $product->image))
                                <img style="max-height: 500px;" src="{{ $url }}" class="img-fluid rounded mx-auto d-block" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x150" class="img-fluid rounded mx-auto d-block" alt="Placeholder image">
                            @endif
                        </div>
                        <div class="col-md-6 d-flex flex-column align-items-center">
                            @if(!empty($options) && count($options)>=1 && !empty($options[0]->option_value))
                                <h2>{{__("Size")}}</h2>
                                <div class="mb-2">
                                    @foreach($options as $opt)
                                        @if($opt->option_name == 'size')
                                            <div class="option" data-price="{{ $opt->prise }};{{ $opt->id }}">
                                                {{ $opt->option_value }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="option" hidden="true" data-price="{{ $options[0]->prise }};{{ $options[0]->id }}"></div>
                            @endif
                            <form action="{{ route('basket.add', ['id' => $product->id, 'locale' => app()->getLocale()]) }}" method="post" class="form-inline add-to-basket w-100">
                                @csrf
                                <input type="hidden" name="option" id="input-option" value="{{ $options[0]->id }}">
                                <div class="w-100 mb-2 text-center">
                                    <label for="input-price">{{__('Price:')}}</label>
                                    <input type="text" readonly name="price" id="input-price" value="{{ number_format($options[0]->price, 2, '.', '') }}" class="form-control mx-2 w-75">
                                </div>
                                <div class="w-100 mb-2 text-center">
                                    <label for="input-quantity">{{__('Quantity:')}}</label>
                                    <input type="number" name="quantity" id="input-quantity" value="1" min="1" class="form-control mx-2 w-75">
                                </div>

                                <div class="w-100 mb-2 text-center">
                                    <button type="submit" class="btn btn-success mt-2">{{__('Add to Basket')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">{{ __('Description') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="specifications-tab" data-toggle="tab" href="#specifications" role="tab" aria-controls="specifications" aria-selected="false">{{ __('Details') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">{{ __('Delivery') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="productTabsContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <p class="mt-4 mb-0">{{ $product->content }}</p>
                        </div>
                        <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                            <!-- Add product specifications here -->
                            <p class="mt-4 mb-0">{{__('text_detail')}}</p>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <!-- Add product reviews here -->
                            <p class="mt-4 mb-0">{{__('text_delivery')}}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('catalog.category', ['slug' => $category->slug, 'locale' => app()->getLocale()]) }}">
                                {{ $category->name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>

        @include('layout.part.description')
    <style>
        .option {
            cursor: pointer;
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .option:hover {
            background-color: #f0f0f0;
        }
        .option.selected {
            background-color: #d0d0d0;
            border-color: #999;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const options = document.querySelectorAll('.option');
            if (options.length > 0) {
                // Select the first option by default
                const firstOption = options[0];
                firstOption.classList.add('selected');
                const newPrice = firstOption.getAttribute('data-price').split(';');
                document.getElementById('input-price').value = newPrice[0];
                document.getElementById('input-option').value = newPrice[1];

                // Add event listeners for other options
                options.forEach(option => {
                    option.addEventListener('click', function() {
                        // Remove 'selected' class from all options
                        options.forEach(opt => opt.classList.remove('selected'));
                        // Add 'selected' class to the clicked option
                        this.classList.add('selected');
                        const newPrice = this.getAttribute('data-price').split(';');
                        document.getElementById('input-price').value = newPrice[0];
                        document.getElementById('input-option').value = newPrice[1];
                    });
                });
            }
        });
    </script>
@endsection
