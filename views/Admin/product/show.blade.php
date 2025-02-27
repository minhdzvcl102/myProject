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
                <a href="/admin/products/create" class="btn btn-sm btn-success">Create</a>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Trường dữ liệu </th>
                                    <th scope="col">Giá trị </th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $field => $value)
                                    <tr>
                                        <td>{{ strtoupper($field) }}</td>
                                        <td>
                                            @switch($field)
                                                @case('img_thumbnail')
                                                    <img src="{{ file_url($value) }}" alt="{{ $data['name'] }}" class="img-fluid"
                                                        style="max-width: 150px;">
                                                @break

                                                @case('is_active')
                                                @case('is_sale')

                                                @case('is_show_home')
                                                    @switch($value)
                                                        @case('1')
                                                            <span class="badge bg-danger">Active</span>
                                                        @break

                                                        @case('0')
                                                            <span class="badge bg-info">Un Active</span>
                                                        @break
                                                    @endswitch
                                                @break

                                                @case('created_at')
                                                    {{ date('d/m/Y H:i:s', strtotime($value)) }}
                                                @break

                                                @case('updated_at')
                                                    {{ date('d/m/Y H:i:s', strtotime($value)) }}
                                                @break

                                                @case('category_id')
                                                    {{ $categories['name'] }}
                                                @break

                                                @default
                                                    {{ $value }}
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="/admin/product" class="btn btn-warning">
                            Back to list
                        </a>
                    </div>
                    <a href="#" class="btn btn-block btn-light">View all</a>
                </div>
            </div>
            <div class="card">
                <g href="#" class="btn btn-sm btn-success">{{ strtoupper('Comment') }}</g>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">User Comment</th>
                                    <th scope="col">Product </th>
                                    <th scope="col">Content </th>
                                    <th scope="col">Is Show </th>
                                    <th scope="col">Action </th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listComment as $value)
                                    <tr>
                                        <td>{{ $value['name'] }}</td>
                                        <td>{{ $value['nameProduct'] }}</td>
                                        <td>{{ $value['content'] }}</td>
                                        <td>{{ $value['is_show']== 1 ? 'show' : 'hide' }}</td>
                                        <td>
                                            <a href="/admin/comment/edit/{{ $value['id'] }}/{{$value['idProduct']}}"
                                                class="btn btn-sm btn-success">{{ $value['is_show']== 0 ? 'show' : 'hide' }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="/admin/product" class="btn btn-warning">
                            Back to list
                        </a>
                    </div>
                    <a href="#" class="btn btn-block btn-light">View all</a>
                </div>
            </div>
        </div>

    </div>
@endsection
