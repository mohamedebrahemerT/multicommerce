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
                                <li class="active"><a href="{{ url('/user/orders') }}"><span
                                            class="ti-files mr-2"></span>
                                        Orders</a></li>
                                <li><a href="{{ url('/user/addresses') }}"><span class="ti-location-pin mr-2"></span>
                                        Addresses</a></li>
                                <li><a href="payment.html"><i class="ti-credit-card mr-2"></i>Payment Cards</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="wrap-account-details mt-30">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="country-select clearfix">
                                    <select class="nice-select wide">
                                        <option data-display="Month">Month</option>
                                        <option value="uk">Year</option>
                                        <option value="rou">Day</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 ml-auto">
                                <div class="country-select clearfix">
                                    <select class="nice-select wide">
                                        <option data-display="Status">Status</option>
                                        <option value="done">done</option>
                                        <option value="rou">completed</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>

                                        <th>Order NO.</th>
                                        <th>Date</th>
                                        <th>QTY</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td>2563</td>
                                        <td>30/6/2020</td>
                                        <td>2</td>
                                        <td>875.00</td>
                                        <td class="status">
                                            <label class="new"></label>
                                            New
                                        </td>
                                        <td class="order-btns">
                                            <a href="{{ url('/user/order/view/1') }}" class="btn btn-black">Details</a>
                                            <a href="#" class="btn btn-gray" data-toggle="modal"
                                               data-target="#exampleModal">Cancel</a>
                                        </td>

                                    </tr>
                                    <tr>

                                        <td>2563</td>
                                        <td>30/6/2020</td>
                                        <td>2</td>
                                        <td>875.00</td>
                                        <td class="status">
                                            <label class="Completed"></label>
                                            Completed
                                        </td>
                                        <td class="order-btns">
                                            <a href="{{ url('/user/order/view/1') }}" class="btn btn-black">Details</a>
                                        </td>

                                    </tr>
                                    <tr>

                                        <td>2563</td>
                                        <td>30/6/2020</td>
                                        <td>2</td>
                                        <td>875.00</td>
                                        <td class="status">
                                            <label class="Canceled"></label>
                                            Canceled
                                        </td>
                                        <td class="order-btns">
                                            <a href="orders-completed.html" class="btn btn-black">Details</a>
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
    </section>
@endsection
