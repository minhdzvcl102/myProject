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
                                    <li class="breadcrumb-item"><a href=""><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="">shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Thanh toán </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Billing Details </h5>
                            <div class="billing-form-wrap">
                                <form action="/checkout" method="post">
                                    @include('admin.components.display-msg-fail')
                                    @include('admin.components.display-msg-success')
                                    @include('admin.components.display-errors')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="single-input-item">
                                                <label for="name" class="required">Name </label>
                                                <input value="{{ $_SESSION['name'] }}" type="text" name="customers"
                                                    placeholder="First Name">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="single-input-item">
                                        <label for="street-address" class="required mt-20">address</label>
                                        <input value="{{ $_SESSION['address'] }}" type="text" name="address"
                                            id="street-address" placeholder="Đia chỉ người nhận Line 1">

                                    </div>



                                    <div class="single-input-item">
                                        <label for="phone">phone</label>
                                        <input value="{{ $_SESSION['phone'] }}" type="text" id="phone" name="phone"
                                            placeholder="Phone">

                                    </div>

                                    <div class="checkout-box-wrap">
                                        <div class="single-input-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" name="method_pay" value="COD"
                                                    class="custom-control-input" id="create_pwd">
                                                <label class="custom-control-label" for="create_pwd">Thanh toán khi nhận
                                                    hàng </label>
                                            </div>
                                        </div>
                                        <div class="account-create single-form-row">
                                            <p>Xin vui lòng quay video khi tiến hành nhận hàng và mở hàng </p>

                                        </div>
                                    </div>

                                    <div class="checkout-box-wrap">
                                        <div class="single-input-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" value="VN_Pay" name="method_pay"
                                                    class="custom-control-input" id="ship_to_different">
                                                <label class="custom-control-label" for="ship_to_different">VNPAY</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="note">note</label>
                                        <textarea name="note" id="note" cols="30" rows="3"
                                            placeholder="Ghi chú về đơn hàng của bạn, ví dụ ghi chú đặc biệt về việc giao hàng."></textarea>
                                    </div>
                                    <button style="margin-left: 70%;" type="submit" class="btn btn-sqr">Thanh toán
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Your Order Summary</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <h5>Product</h5>
                                                </th>
                                                <th>
                                                    <h5>Total</h5>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($_SESSION['listCart'] as $item)
                                                <tr>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item['is_sale'] == 1 ? $item['price_sale'] : $item['price'] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Sub Total </td>
                                                <td><strong>${{ $_SESSION['total'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>VAT 2% </td>
                                                <td><strong>${{ $_SESSION['total'] * 0.02 }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Total Amount </td>
                                                <td><strong>${{ $_SESSION['total'] * 0.02 + $_SESSION['total'] }}</strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- checkout main wrapper end -->
    </main>
@endsection
