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
                <a href="/admin/users/create" class="btn btn-sm btn-success">Create</a>
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
                                                @case('avatar')
                                                    <img src="{{ file_url($value) }}" alt="{{ $data['name'] }}" class="img-fluid"
                                                        style="max-width: 150px;">
                                                @break

                                                @case('type')
                                                    @switch($value)
                                                        @case('admin')
                                                            <span class="badge bg-danger">Admin</span>
                                                        @break

                                                        @case('client')
                                                            <span class="badge bg-info">Client</span>
                                                        @break
                                                    @endswitch
                                                    @case('created_at')
                                                        {{ date('d/m/Y H:i:s', strtotime($value)) }}
                                                    @break

                                                    @case('updated_at')
                                                        {{ date('d/m/Y H:i:s', strtotime($value)) }}
                                                    @break

                                                    @case('password')
                                                        ***************
                                                    @break

                                                    @default
                                                        {{ $value }}
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="/admin/users" class="btn btn-warning">
                                Back to list
                            </a>
                        </div>
                        <a href="#" class="btn btn-block btn-light">View all</a>
                    </div>
                </div>
            </div>

        </div>
    @endsection
