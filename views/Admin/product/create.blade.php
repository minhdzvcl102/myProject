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
                    <form action="/admin/product/store" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 row">
                            <label for="name" class="col-4 col-form-label">Name Product</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $_SESSION['data']['name'] ?? null }}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="Categories" class="col-4 col-form-label">Name Categories</label>
                            <div class="col-8">
                                <select class="form-select" id="type" name="category_id">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item['id'] }}">
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="overview" class="col-4 col-form-label">Over view</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="overview" id="overview"
                                    value="{{ $_SESSION['data']['overview'] ?? null }}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="content" class="col-4 col-form-label">Content</label>
                            <div class="col-8">
                                <textarea style="width: 100%; height: 200px;" id="content" name="content">{!! $_SESSION['data']['content'] ?? null !!}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="img" class="col-4 col-form-label">image thumbnail</label>
                            <div class="col-8">
                                <input type="file" class="form-control" name="img_thumbnail" id="img" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="price" class="col-4 col-form-label">Price</label>
                            <div class="col-8">
                                <input type="number" class="form-control" name="price" id="price" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="price" class="col-4 col-form-label">Price Sale</label>
                            <div class="col-8">
                                <input type="number" class="form-control" name="price_sale" id="price" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="type" class="col-4 col-form-label">Is Active</label>
                            <div class="col-8">
                                <select class="form-select" name="is_active" id="type">
                                    <option value="1">Active</option>
                                    <option selected value="0">Un Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="type" class="col-4 col-form-label">Is sale</label>
                            <div class="col-8">
                                <select class="form-select" name="is_sale" id="type">
                                    <option value="1">sale</option>
                                    <option selected value="0">Un sale</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="type" class="col-4 col-form-label">Is show_home</label>
                            <div class="col-8">
                                <select class="form-select" name="is_show_home" id="type">
                                    <option value="1">show_home</option>
                                    <option selected value="0">Un show_home</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                                <a href="/admin/product/" class="btn btn-warning">
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
