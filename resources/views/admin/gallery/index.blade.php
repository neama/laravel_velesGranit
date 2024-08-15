@extends('layout.admin', ['title' => 'Все товары каталога'])

@section('content')
    <h1>картинки </h1>
    <!-- Корневые категории для возможности навигации -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Slug</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($images as $root)
            <tr>
                <!-- Поле Name -->
                <td>{{ $root->name }}</td>

                <!-- Поле Description, ограниченное 50 символами -->
                <td>{{ Str::limit($root->description, 50) }}</td>

                <!-- Поле Slug -->
                <td>{{ $root->slug }}</td>

                <!-- Поле Image -->
                @php( $url = url('storage/gallery/' . $root->base_image))
                <td>
                    <img src="{{ $url }}" alt="{{ $root->name }}" class="img-thumbnail" style="max-width: 100px;">
                </td>

                <!-- Кнопки для действий -->
                <td>
                    <a href="{{ route('admin.galleries.show', ['slug' => $root->slug]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.galleries.destroy', ['slug' => $root->slug]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <a href="{{ route('admin.galleries.create') }}" class="btn btn-success mb-4">
        добавить картинку
    </a>
    <table class="table table-bordered">
        <!-- ..... -->
    </table>
    {{ $images->links('vendor.pagination.bootstrap-4') }}
@endsection
