@extends('admin.layouts.main')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <h1 class="h2">{{ $title }}</h1>

    @include('admin.components.display-msg-fail')
    @include('admin.components.display-msg-success')
    <div class="row">
        <div class="col-12  mb-4 mb-lg-0">
            <div class="card">
                <a href="/admin/product/create" class="btn btn-sm btn-success">Create</a>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name </th>
                                    <th scope="col">IMG</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Sale</th>
                                    <th scope="col">Is SAle</th>
                                    <th scope="col">Is Show Home</th>
                                    <th scope="col">Is Active</th>
                                    <th scope="col">Create at</th>
                                    <th scope="col">Update at</th>
                                    <th scope="col">Categories</th>
                                    <th scope="col"> Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $product)
                                    <tr>
                                        <th scope="row">{{ $product['id'] }}</th>
                                        <td>{{ $product['name'] }}</td>
                                        <td>
                                            <img src="{{ file_url($product['img_thumbnail']) }}"
                                                alt="{{ $product['name'] }}" class="img-fluid" style="max-width: 150px;">
                                        </td>
                                        <td>{{ $product['content'] }}</td>
                                        <td>{{ $product['price'] }}</td>
                                        <td>{{ $product['price_sale'] }}</td>
                                        <td>{{ $product['is_sale'] == 1 ? 'Sale' : 'Un Sale' }}</td>
                                        <td>{{ $product['is_show_home'] == 1 ? 'Active' : 'Un Active' }}</td>
                                        <td>{{ $product['is_active'] == 1 ? 'Active' : 'Un Active' }}</td>
                                        <td>{{ $product['created_at'] }}</td>
                                        <td>{{ $product['updated_at'] }}</td>
                                        <td>
                                            @foreach ($categories as $cate)
                                                @if ($cate['id'] == $product['category_id'])
                                                    {{ $cate['name'] }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a style="width: 100px; margin: 2px;"href="/admin/product/show/{{ $product['id'] }}"
                                                class="btn btn-sm btn-info">Show</a>
                                            <a style="width: 100px; margin: 2px;"href="/admin/product/edit/{{ $product['id'] }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a style="width: 100px; margin: 2px;"href="/admin/product/delete/{{ $product['id'] }}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn xóa không ?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <a href="#" class="btn btn-block btn-light">View all</a>
                </div>
            </div>
        </div>

    </div>
@endsection
