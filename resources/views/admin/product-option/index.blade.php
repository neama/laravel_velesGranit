@extends('layout.admin', ['title' => 'Дополнительные опции товаров'])

@section('content')
    <h1>Дополнительные опции</h1>
    <!-- Корневые категории для возможности навигации -->
    <form action="{{ route('admin.product-option.index') }}" method="get" class="mb-4">
        <div class="form-group">
            <label for="category">{{ __('Category') }}</label>
            <select name="category_id" id="category" class="form-control" onchange="this.form.submit()">
                <option value="">{{ __('All categories') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <label for="category">{{ __('Product') }}</label>
            <select name="product_id" id="product" class="form-control" onchange="this.form.submit()">
                <option value="">{{ __('All products') }}</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">{{ __('Filter') }}</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>
                    Option
                </th>
                <th>
                    value
                </th>
                <th>
                    product name
                </th>
                <th>
                    Category
                </th>
                <th>
                    Host
                </th>
                <th>
                    lang
                </th>
                <th>
                    add to current product
                </th>
                <th>
                    remove
                </th>
            </tr>
        </thead>
<tbody>

        @foreach ($productsOption as $pr)
        @php
         $categoryParentMain = [];
         $categoryParent = [];
         $product = json_decode($pr->getProduct(),true)[0];
         $categoryParent = json_decode($pr->getCategory($product['category_id']),true)[0];
         $host = $categoryParent['host'];
         $lang = $categoryParent['lang'];
         $pr_id = $product['id'];
         @endphp
     <tr>

     <td>
         {{ $pr->option_name }}
     </td>
     <td>
         {{ $pr->option_value }}
     </td>
     <td>
             <?= $product['name']; ?>
     </td>
     <td>
           <?= $categoryParent['name']; ?>
     </td>

         <td>
                 <?= $host; ?>
         </td>
         <td>
                 <?= $lang; ?>
         </td>
         <td>
             <a href="{{ route('admin.product-option.create',['product'=>$pr_id]) }}" class="btn btn-success mb-4">
                 Доп опцию к товару
             </a>
         </td>
         <td>
             <form action="{{ route('admin.product-option.destroy', $pr->id) }}" method="POST">
                 @csrf
                 @method('delete')
                 <button type="submit" class="btn btn-outline-danger mb-4">Delete</button>
             </form>


             </form>
         </td>

     </tr>
 @endforeach

</tbody>
</table>
<a href="{{ route('admin.product-option.create') }}" class="btn btn-success mb-4">
 Создать дополнительную опцию
</a>
<table class="table table-bordered">
 <!-- ..... -->
</table>

@endsection
