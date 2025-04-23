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
                                    <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">cart</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Thumbnail</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listOders as $index => $value)
                                            <tr>
                                                <td class="pro-thumbnail"><a href="#"><img class="img-fluid"
                                                            src="{{ file_url($value['img_thumbnail']) }}"
                                                            alt="Product"></a></td>
                                                <td class="pro-title"><a href="#">{{ $value['product_name'] }}</a>
                                                </td>
                                                <td class="pro-price">${{ $value['price'] }}</td>
                                                <td class="pro-quantity">
                                                    <div >{{ $value['quantity'] }}</div>
                            </div>
                            </td>
                            <td class="pro-subtotal"><span>${{ $value['price'] * $value['quantity'] }}</span></td>
                            </td>
                            </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                        <!-- Cart Update Option -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Cart Totals</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>${{ $subTotal}}</td>
                                            </tr>
                                            <tr>
                                                <td>VAT 2%</td>
                                                <td>${{ ($subTotal * 2) / 100 }}</td>
                                            </tr>
                                            <tr class="total">
                                                <td>Total</td>
                                                <td class="total-amount">
                                                    ${{ $subTotal + ($subTotal * 2) / 100}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- cart main wrapper end -->
    </main>
@endsection
