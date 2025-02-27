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
                <a href="/admin/categories/create" class="btn btn-sm btn-success">Create</a>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">IMG</th>
                                    <th scope="col">IsAct</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $value)
                                    <tr>
                                        <th scope="row">{{ $value['id'] }}</th>
                                        <td>{{ $value['name'] }}</td>
                                        <td>
                                            <img src="{{file_url($value['img'])}}" alt="{{ $value['name'] }}"
                                                class="img-fluid" style="max-width: 150px;">
                                        </td>
                                        <td>{{ $value['type'] }}</td>
                                        <td>
                                            <a href="/admin/categories/show/{{ $value['id'] }}"
                                                class="btn btn-sm btn-info">Show</a>
                                            <a href="/admin/categories/edit/{{ $value['id'] }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="/admin/categories/delete/{{ $value['id'] }}" class="btn btn-sm btn-danger"
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
