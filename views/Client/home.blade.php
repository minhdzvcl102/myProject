    @extends('client.layouts.main')
    @section('content')
        <!-- Section-->
        <main>
            <!-- hero slider area start -->
            <section class="slider-area">
                <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
                    <!-- single slider item start -->
                    @foreach ($listBanners as $banner)
                        @if ($banner['is_active'] == 1)
                            <div class="hero-single-slide hero-overlay">
                                <div class="hero-slider-item bg-img" data-bg="{{ $banner['img'] }}">
                                    <div class="hero-slider-content slide-2">
                                        <h2 class="slide-title">Diamonds Jewelry <span>Collection</span></h2>
                                        <h4 class="slide-desc">Shukra Yogam &amp; Silver Power Silver Saving Schemes.</h4>
                                        <a href="shop.html" class="btn btn-hero" tabindex="-1">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <!-- single slider item end -->


                </div>
            </section>
            <!-- hero slider area end -->


            <!-- product area start -->
            <section class="product-area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- section title start -->
                            <div class="section-title text-center">
                                <h2 class="title">our products</h2>
                                <p class="sub-title">Add our products to weekly lineup</p>
                            </div>
                            <!-- section title start -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-container">

                                <!-- product tab content start -->
                                <div class="tab-content">

                                    <div class="tab-pane fade active">
                                        <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                            <!-- product item start -->
                                            @foreach ($listProducts as $product)
                                                <div class="product-item">
                                                    <figure class="product-thumb">
                                                        <a href="{{ file_url('show/' . $product['id']) }}">
                                                            <img class="pri-img"
                                                                src="{{ file_url($product['img_thumbnail']) }}"
                                                                alt="product">
                                                            <img class="sec-img"
                                                                src="{{ file_url($product['img_thumbnail']) }}"
                                                                alt="product">
                                                        </a>
                                                        <div class="button-group">
                                                            <a href="wishlist.html" data-bs-toggle="tooltip"
                                                                data-bs-placement="left" title="Add to wishlist"><i
                                                                    class="pe-7s-like"></i></a>
                                                            <a href="compare.html" data-bs-toggle="tooltip"
                                                                data-bs-placement="left" title="Add to Compare"><i
                                                                    class="pe-7s-refresh-2"></i></a>
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                                                                    data-bs-placement="left" title="Quick View"><i
                                                                        class="pe-7s-search"></i></span></a>
                                                        </div>
                                                        <div class="cart-hover">
                                                            <a href="/addProduct/{{ $product['id'] }}"
                                                                class="btn btn-cart">add to
                                                                cart</a>
                                                        </div>
                                                    </figure>
                                                    <div class="product-caption text-center">
                                                        <h6 class="product-name">
                                                            <a href="product-details.html">{{ $product['name'] }}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            <span class="price-regular"
                                                                style="display: {{ $product['is_sale'] == 0 ? 'none' : '' }}">${{ $product['price_sale'] }}</span>
                                                            <span
                                                                class="{{ $product['is_sale'] == 1 ? 'price-old' : 'price-regular ' }}">${{ $product['price'] }}</del></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- product item end -->
                                            @endforeach
                                        </div>
                                    </div>


                                </div>
                                <!-- product tab content end -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- product area end -->


            <!-- testimonial area start -->
            <section class="testimonial-area section-padding bg-img" data-bg="assets/img/testimonial/testimonials-bg.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- section title start -->
                            <div class="section-title text-center">
                                <h2 class="title">testimonials</h2>
                                <p class="sub-title">What they say</p>
                            </div>
                            <!-- section title start -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="testimonial-thumb-wrapper">
                                <div class="testimonial-thumb-carousel">
                                    <div class="testimonial-thumb">
                                        <img src="assets/img/testimonial/testimonial-1.png" alt="testimonial-thumb">
                                    </div>
                                    <div class="testimonial-thumb">
                                        <img src="assets/img/testimonial/testimonial-2.png" alt="testimonial-thumb">
                                    </div>
                                    <div class="testimonial-thumb">
                                        <img src="assets/img/testimonial/testimonial-3.png" alt="testimonial-thumb">
                                    </div>
                                    <div class="testimonial-thumb">
                                        <img src="assets/img/testimonial/testimonial-2.png" alt="testimonial-thumb">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- testimonial area end -->

            <!-- latest blog area start -->
            <section style="margin-top: 50px" class="latest-blog-area section-padding pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- section title start -->
                            <div class="section-title text-center">
                                <h2 class="title">latest blogs</h2>
                                <p class="sub-title">There are latest blog posts</p>
                            </div>
                            <!-- section title start -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                                <!-- blog post item start -->
                                <div class="blog-post-item">
                                    <figure class="blog-thumb">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/blog-img1.jpg" alt="blog image">
                                        </a>
                                    </figure>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <p>25/03/2019 | <a href="#">Corano</a></p>
                                        </div>
                                        <h5 class="blog-title">
                                            <a href="blog-details.html">Celebrity Daughter Opens Up About Having Her Eye
                                                Color Changed</a>
                                        </h5>
                                    </div>
                                </div>
                                <!-- blog post item end -->

                                <!-- blog post item start -->
                                <div class="blog-post-item">
                                    <figure class="blog-thumb">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/blog-img2.jpg" alt="blog image">
                                        </a>
                                    </figure>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <p>25/03/2019 | <a href="#">Corano</a></p>
                                        </div>
                                        <h5 class="blog-title">
                                            <a href="blog-details.html">Children Left Home Alone For 4 Days In TV series
                                                Experiment</a>
                                        </h5>
                                    </div>
                                </div>
                                <!-- blog post item end -->

                                <!-- blog post item start -->
                                <div class="blog-post-item">
                                    <figure class="blog-thumb">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/blog-img3.jpg" alt="blog image">
                                        </a>
                                    </figure>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <p>25/03/2019 | <a href="#">Corano</a></p>
                                        </div>
                                        <h5 class="blog-title">
                                            <a href="blog-details.html">Lotto Winner Offering Up Money To Any Man That
                                                Will Date Her</a>
                                        </h5>
                                    </div>
                                </div>
                                <!-- blog post item end -->

                                <!-- blog post item start -->
                                <div class="blog-post-item">
                                    <figure class="blog-thumb">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/blog-img4.jpg" alt="blog image">
                                        </a>
                                    </figure>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <p>25/03/2019 | <a href="#">Corano</a></p>
                                        </div>
                                        <h5 class="blog-title">
                                            <a href="blog-details.html">People are Willing Lie When Comes Money, According
                                                to Research</a>
                                        </h5>
                                    </div>
                                </div>
                                <!-- blog post item end -->

                                <!-- blog post item start -->
                                <div class="blog-post-item">
                                    <figure class="blog-thumb">
                                        <a href="blog-details.html">
                                            <img src="assets/img/blog/blog-img5.jpg" alt="blog image">
                                        </a>
                                    </figure>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <p>25/03/2019 | <a href="#">Corano</a></p>
                                        </div>
                                        <h5 class="blog-title">
                                            <a href="blog-details.html">romantic Love Stories Of Hollywood’s Biggest
                                                Celebrities</a>
                                        </h5>
                                    </div>
                                </div>
                                <!-- blog post item end -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- latest blog area end -->

            <!-- brand logo area start -->
            <div class="brand-logo section-padding pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="brand-logo-carousel slick-row-10 slick-arrow-style">
                                <!-- single brand start -->
                                <div class="brand-item">
                                    <a href="#">
                                        <img src="assets/img/brand/1.png" alt="">
                                    </a>
                                </div>
                                <!-- single brand end -->

                                <!-- single brand start -->
                                <div class="brand-item">
                                    <a href="#">
                                        <img src="assets/img/brand/2.png" alt="">
                                    </a>
                                </div>
                                <!-- single brand end -->

                                <!-- single brand start -->
                                <div class="brand-item">
                                    <a href="#">
                                        <img src="assets/img/brand/3.png" alt="">
                                    </a>
                                </div>
                                <!-- single brand end -->

                                <!-- single brand start -->
                                <div class="brand-item">
                                    <a href="#">
                                        <img src="assets/img/brand/4.png" alt="">
                                    </a>
                                </div>
                                <!-- single brand end -->

                                <!-- single brand start -->
                                <div class="brand-item">
                                    <a href="#">
                                        <img src="assets/img/brand/5.png" alt="">
                                    </a>
                                </div>
                                <!-- single brand end -->

                                <!-- single brand start -->
                                <div class="brand-item">
                                    <a href="#">
                                        <img src="assets/img/brand/6.png" alt="">
                                    </a>
                                </div>
                                <!-- single brand end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- brand logo area end -->
        </main>
    @endsection
