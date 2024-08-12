@extends('layout.admin', ['title' => 'Все товары каталога'])

@section('content')
    <h1>Все товары</h1>
    <!-- Корневые категории для возможности навигации -->
    <ul>
        @foreach ($roots as $root)
            <li>
                <a href="{{ route('admin.product.category', ['category' => $root->id]) }}">
                    {{ $root->name }}
                </a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('admin.product.create') }}" class="btn btn-success mb-4">
        Создать товар
    </a>
    <table class="table table-bordered">
        <!-- ..... -->
    </table>
    {{ $products->links('vendor.pagination.bootstrap-4') }}
@endsection
