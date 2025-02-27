@extends('client.layouts.main')
@section('content')
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">shop</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.components.display-msg-success')
        <!-- breadcrumb area end -->

        <!-- page main wrapper start -->
        <div class="shop-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <!-- sidebar area start -->
                    <div class="col-lg-3 order-2 order-lg-1">
                        <aside class="sidebar-wrapper">
                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">categories</h5>
                                <div class="sidebar-body">
                                    <ul class="shop-categories">
                                        @foreach ($listCategories as $categories)
                                            <li><a href="#">{{ $categories['name'] }} </a></li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            <!-- single sidebar end -->

                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">price</h5>
                                <div class="sidebar-body">
                                    <div class="price-range-wrap">
                                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                            data-min="1" data-max="1000">
                                            <div class="ui-slider-range ui-corner-all ui-widget-header"
                                                style="left: 0%; width: 100%;"></div><span tabindex="0"
                                                class="ui-slider-handle ui-corner-all ui-state-default"
                                                style="left: 0%;"></span><span tabindex="0"
                                                class="ui-slider-handle ui-corner-all ui-state-default"
                                                style="left: 100%;"></span>
                                        </div>
                                        <div class="range-slider">
                                            <form action="#" class="d-flex align-items-center justify-content-between">
                                                <div class="price-input">
                                                    <label for="amount">Price: </label>
                                                    <input type="text" id="amount">
                                                </div>
                                                <button class="filter-btn">filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single sidebar end -->
                        </aside>
                    </div>
                    <!-- sidebar area end -->

                    <!-- shop main wrapper start -->
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="shop-product-wrapper">
                            <!-- shop product top wrap start -->
                            <div class="shop-top-bar">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                        <div class="top-bar-left">
                                            <div class="product-amount">
                                                <p>Showing 1–16 of 21 results</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                        <div class="top-bar-right">
                                            <div class="product-short">
                                                <p>Sort By : </p>
                                                <select class="nice-select" name="sortby" style="display: none;">
                                                    <option value="trending">Relevance</option>
                                                    <option value="sales">Name (A - Z)</option>
                                                    <option value="sales">Name (Z - A)</option>
                                                    <option value="rating">Price (Low &gt; High)</option>
                                                    <option value="date">Rating (Lowest)</option>
                                                    <option value="price-asc">Model (A - Z)</option>
                                                    <option value="price-asc">Model (Z - A)</option>
                                                </select>
                                                <div class="nice-select" tabindex="0"><span
                                                        class="current">Relevance</span>
                                                    <ul class="list">
                                                        <li data-value="trending" class="option selected">Relevance</li>
                                                        <li data-value="sales" class="option">Name (A - Z)</li>
                                                        <li data-value="sales" class="option">Name (Z - A)</li>
                                                        <li data-value="rating" class="option">Price (Low &gt; High)</li>
                                                        <li data-value="date" class="option">Rating (Lowest)</li>
                                                        <li data-value="price-asc" class="option">Model (A - Z)</li>
                                                        <li data-value="price-asc" class="option">Model (Z - A)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- product item list wrapper start -->
                            <div class="shop-product-wrap grid-view row mbn-30">
                                <!-- product single item start -->
                                @foreach ($listProducts as $product)
                                    <div class="col-md-4 col-sm-6">
                                        <!-- product grid start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="/detailProduct/{{ $product['id'] }}/{{ $product['category_id'] }}">
                                                    <img class="pri-img" src="{{ file_url($product['img_thumbnail']) }}"
                                                        alt="product">
                                                    <img class="sec-img" src="{{ file_url($product['img_thumbnail']) }}"
                                                        alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    <a href="wishlist.html" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title=""
                                                        data-bs-original-title="Add to wishlist"
                                                        aria-label="Add to wishlist"><i class="pe-7s-like"></i></a>
                                                    <a href="compare.html" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title=""
                                                        data-bs-original-title="Add to Compare"
                                                        aria-label="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title=""
                                                            data-bs-original-title="Quick View" aria-label="Quick View"><i
                                                                class="pe-7s-search"></i></span></a>
                                                </div>
                                                <div class="cart-hover">
                                                    <a href="/addProduct/{{ $product['id'] }}" class="btn btn-cart">add to
                                                        cart</a>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <ul class="color-categories">
                                                    <li>
                                                        <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-darktan" href="#" title="Darktan"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-grey" href="#" title="Grey"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-brown" href="#" title="Brown"></a>
                                                    </li>
                                                </ul>
                                                <h6 class="product-name">
                                                    <a href="product-details.html">{{ $product['name'] }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    <span class="price-regular"
                                                        style="display: {{ $product['is_sale'] != 1 ? 'none' : '' }}">${{ $product['price_sale'] }}</span>
                                                    <span
                                                        class="{{ $product['is_sale'] == 1 ? 'price-old' : 'price-regular' }}">${{ $product['price'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product grid end -->
                                    </div>
                                @endforeach
                            </div>
                            <!-- product item list wrapper end -->

                            <!-- start pagination area -->
                            <div class="paginatoin-area text-center">
                                <ul class="pagination-box">
                                    <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                                </ul>
                            </div>
                            <!-- end pagination area -->
                        </div>
                    </div>
                    <!-- shop main wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->
    </main>
@endsection
