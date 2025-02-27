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
    @include('admin.components.display-errors')
    <div class="row">
        <div class="col-12  mb-4 mb-lg-0">
            <div class="card">
                <div class="card-body">

                    <form action="/admin/users/update/{{ $data['id'] }}" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 row">
                            <label for="name" class="col-4 col-form-label">Name</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $data['name'] }}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-4 col-form-label">Email</label>
                            <div class="col-8">
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ $data['email'] }}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="avatar" class="col-4 col-form-label">Avatar</label>
                            <div class="col-8">
                                <input type="file" class="form-control" name="avatar" id="avatar" />
                                <img src="{{ file_url($data['avatar']) }}"width="100px" alt="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="type" class="col-4 col-form-label">Type</label>
                            <div class="col-8">
                                <select class="form-select" name="type" id="type">
                                    <option @if ($data['type'] == 'admin') selected @endif value="admin">Admin</option>
                                    <option @if ($data['type'] == 'client') selected @endif value="client">Client</option>

                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>

                                <a href="/admin/users" class="btn btn-warning">
                                    Back to list
                                </a>
                            </div>
                        </div>
                    </form>
                    <a href="#" class="btn btn-block btn-light">View all</a>
                </div>
            </div>
        </div>

    </div>
@endsection
