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
                                    <th scope="col">Trường Dữ Liệu </th>
                                    <th scope="col">Giá trị </th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $field => $value)
                                    <tr>
                                        <td>{{ strtoupper($field) }}</td>
                                        <td>
                                            @switch($field)
                                                @case('img')
                                                    <img src="{{ file_url($value) }}" alt="{{ $data['name'] }}" class="img-fluid"
                                                        style="max-width: 150px;">
                                                @break

                                                @case('is_active')
                                                    @switch($value)
                                                        @case('1')
                                                            <span class="badge bg-danger">Active</span>
                                                        @break

                                                        @case('0')
                                                            <span class="badge bg-info">Un Active</span>
                                                        @break
                                                    @endswitch
                                                    @case('created_at')
                                                        {{ date('d/m/Y H:i:s', strtotime($value)) }}
                                                    @break

                                                    @case('updated_at')
                                                        {{ date('d/m/Y H:i:s', strtotime($value)) }}
                                                    @break
                                                    @default
                                                        {{ $value }}
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="/admin/categories" class="btn btn-warning">
                                Back to list
                            </a>
                        </div>
                        <a href="#" class="btn btn-block btn-light">View all</a>
                    </div>
                </div>
            </div>

        </div>
    @endsection
