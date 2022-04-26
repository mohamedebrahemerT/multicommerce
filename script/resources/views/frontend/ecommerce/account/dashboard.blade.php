@extends('frontend.ecommerce.layouts.app')
@section('content')

    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="products-section accountDetails">
                        <div class="media border-bottom">
                            <img src="{{ asset('frontend/ecommerce/images/profile.jpg') }}" class="mr-2" alt="...">
                            <div class="media-body">
                                <h6 class="mt-0">Mohamed Ragab</h6>
                                <a href="#">Log out</a>
                            </div>
                        </div>
                        <div class="accountDetailsList">
                            <ul>
                                <li class="active"><a href="{{ url('/user/dashboard') }}"><span
                                            class="ti-user mr-2"></span> Account
                                        Details</a></li>
                                <li><a href="{{ url('/user/orders') }}"><span class="ti-files mr-2"></span>
                                        Orders</a></li>
                                <li><a href="{{ url('/user/addresses') }}"><span class="ti-location-pin mr-2"></span>
                                        Addresses</a></li>
                                <li><a href="{{ url('/user/payment') }}"><i class="ti-credit-card mr-2"></i>Payment Cards</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="wrap-account-details mt-30">
                        <p>Hello <span>Mohamed Ragab</span></p>
                        <p>From your account dashboard you can view your recent orders, manage your shipping and
                            billing addresses,
                            and edit your password and account details.</p>
                        <form action="#" class="pt-40">
                            <div class="chekbox-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>First Name <span class="required">*</span></label>
                                            <input placeholder="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input placeholder="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input placeholder="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input placeholder="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-20">
                                        <h6>Password change</h6>
                                    </div>
                                    <div class="row change-password p-20">
                                        <div class="col-md-8">
                                            <div class="checkout-form-list">
                                                <label>Current password (leave blank to leave unchanged)</label>
                                                <input placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="checkout-form-list">
                                                <label>New password (leave blank to leave unchanged)</label>
                                                <input placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="checkout-form-list">
                                                <label>Confirm new password</label>
                                                <input placeholder="" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="links">Save Changes</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
