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

                    <form action="/admin/categories/update/{{$data['id']}}" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 row">
                            <label for="name" class="col-4 col-form-label">Name Categories</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $data['name'] }}" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="img" class="col-4 col-form-label">image</label>
                            <div class="col-8">
                                <input type="file" class="form-control" name="img" id="img" />
                                <img  style="max-width: 150px;" src="{{ file_url($data['img']) }}" alt="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="type" class="col-4 col-form-label">Is Active</label>
                            <div class="col-8">
                                <select class="form-select" name="is_active" id="type">
                                    <option selected value="1">Active</option>
                                    <option value="0">Un Active</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                                <a href="/admin/categories/" class="btn btn-warning">
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
