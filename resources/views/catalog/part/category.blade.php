<div class="col-md-4 mb-4">
    <a href="{{ route('catalog.category', ['slug' => $category->slug,'locale' => app()->getLocale()]) }}"
       class="btn btn-dark  mx-auto d-block">{{$category->name}}</a>
</div>
