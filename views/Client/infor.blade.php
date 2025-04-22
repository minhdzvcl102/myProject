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
                                    <li class="breadcrumb-item active" aria-current="page">my-account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- my account wrapper start -->
        <div class="my-account-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- My Account Page Start -->
                            <div class="myaccount-page-wrapper">
                                <!-- My Account Tab Menu Start -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-4">
                                        <div class="myaccount-tab-menu nav" role="tablist">
                                            <a href="#orders" data-bs-toggle="tab" class="active"><i
                                                    class="fa fa-cart-arrow-down"></i>
                                                Orders</a>
                                            <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account
                                                Details</a>
                                            <a href="#pass" data-bs-toggle="tab"><i class="fa fa-user"></i> Change Pass
                                            </a>
                                            <a href="login-register.html"><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>
                                    <!-- My Account Tab Menu End -->

                                    <!-- My Account Tab Content Start -->
                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="myaccountContent">
                                            <div class="tab-pane fade show active" id="orders" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Orders</h5>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Order</th>
                                                                    <th>Customer</th>
                                                                    <th>Toltal_amount</th>
                                                                    <th>phone</th>
                                                                    <th>method_pay</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($listOders as $orderIndex => $oder)
                                                                    <tr>
                                                                        <td>{{ $orderIndex + 1}}</td>
                                                                        <td>{{ $oder['customers'] }}</td>
                                                                        <td>${{ $oder['total_amount'] }}</td>
                                                                        <td>${{ $oder['phone'] }}</td>
                                                                        <td>${{ $oder['method_pay'] }}</td>
                                                                        <td><a href="/user/orderDetail/{{$oder['id']}}" class="btn btn-sqr">View</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade" id="account-info" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Account Details</h5>
                                                    <div class="account-details-form">
                                                        <form action="/user/update/{{ $userDetail['id'] }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @include('admin.components.display-msg-fail')
                                                            @include('admin.components.display-msg-success')
                                                            @include('admin.components.display-errors')
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">
                                                                            Name</label>
                                                                        <input type="text" id="first-name"
                                                                            value="{{ $userDetail['name'] }}"
                                                                            name="name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="email" class="required">Email
                                                                    Addres</label>
                                                                <input type="email" id="email"
                                                                    value="{{ $userDetail['email'] }}" name="email">
                                                            </div>
                                                            <input type="hidden" value="client" name="type">
                                                            <div class="single-input-item">
                                                                <label for="avatar" class="required">avatar
                                                                </label>
                                                                <img style="max-height: 200px"
                                                                    src="{{ file_url($userDetail['avatar']) }}"
                                                                    alt="">
                                                                <input type="file" id="avatar" name="avatar">
                                                            </div>
                                                            <div class="single-input-item">
                                                                <button type="submit" class="btn btn-sqr">Save
                                                                    Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- Single Tab Content End -->
                                            <div class="tab-pane fade" id="pass" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <div class="account-details-form">
                                                        <form action="/user/updatePass/{{ $userDetail['id'] }}"
                                                            method="post">
                                                            @include('admin.components.display-msg-fail')
                                                            @include('admin.components.display-msg-success')
                                                            @include('admin.components.display-errors')
                                                            <fieldset>
                                                                <legend>Password change</legend>
                                                                <div class="single-input-item">
                                                                    <label for="current-pwd" class="required">Current
                                                                        Password</label>
                                                                    <input type="password" id="current-pwd"
                                                                        placeholder="Current Password" name="oldPassword">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="single-input-item">
                                                                            <label for="new-pwd" class="required">New
                                                                                Password</label>
                                                                            <input type="password" id="new-pwd"
                                                                                placeholder="New Password"
                                                                                name="newPassword">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="single-input-item">
                                                                            <label for="confirm-pwd"
                                                                                class="required">Confirm
                                                                                Password</label>
                                                                            <input type="password" id="confirm-pwd"
                                                                                placeholder="Confirm Password"
                                                                                name="confirmPassword">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <div class="single-input-item">
                                                                <button type="submit" class="btn btn-sqr">Save
                                                                    Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- Single Tab Content End -->

                                        </div>
                                    </div> <!-- My Account Tab Content End -->
                                </div>
                            </div> <!-- My Account Page End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
    </main>
@endsection
