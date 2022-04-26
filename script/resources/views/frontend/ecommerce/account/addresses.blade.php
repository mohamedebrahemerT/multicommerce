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
                                <li><a href="{{ url('/user/dashboard') }}"><span class="ti-user mr-2"></span> Account
                                        Details</a></li>
                                <li><a href="{{ url('/user/orders') }}"><span class="ti-files mr-2"></span>
                                        Orders</a></li>
                                <li class="active"><a href="{{ url('/user/addresses') }}"><span
                                            class="ti-location-pin mr-2"></span>
                                        Addresses</a></li>
                                <li><a href="{{ url('/user/payment') }}"><i class="ti-credit-card mr-2"></i>Payment
                                        Cards</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="wrap-account-details mt-30">
                        <div class="row profile-address">
                            <div class="col-md-3">
                                <div class="border py-2 p-3 rounded">
                                    <h5>home</h5>
                                    <p>Giza , Egypt</p>
                                    <p>PO. 1518475</p>
                                    <p> +02 010 64848 621</p>
                                    <div class="pt-3">
                                        <a href=""><span class="ti-pencil-alt mr-3"></span></a>
                                        <a href=""><span class="ti-trash mr-1"></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border py-2 p-3 rounded">
                                    <h5>Work</h5>
                                    <p>Giza , Egypt</p>
                                    <p>PO. 1518475</p>
                                    <p> +02 010 64848 621</p>
                                    <div class="pt-3">
                                        <a href=""><span class="ti-pencil-alt mr-3"></span></a>
                                        <a href=""><span class="ti-trash mr-1"></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border py-2 p-3 rounded text-center add-new-address" data-toggle="modal"
                                     data-target="#exampleModal">
                                    <a href="#">
                                        <i class="fa fa-plus fa-3x"></i>
                                        <h6>Add New Address</h6>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
