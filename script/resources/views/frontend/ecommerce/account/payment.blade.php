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
                            <li><a href="{{ url('/user/dashboard') }}"><span
                                        class="ti-user mr-2"></span> Account
                                    Details</a></li>
                            <li><a href="{{ url('/user/orders') }}"><span class="ti-files mr-2"></span>
                                    Orders</a></li>
                            <li><a href="{{ url('/user/addresses') }}"><span class="ti-location-pin mr-2"></span>
                                    Addresses</a></li>
                            <li class="active"><a href="{{ url('/user/payment') }}"><i class="ti-credit-card mr-2"></i>Payment
                                    Cards</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="wrap-account-details mt-30">
                    <div class="row profile-payment p-1">

                        <div class="tab-product w-100">
                            <ul class="nav nav-tabs nav-material">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                        href="#SavedCards"><span>Saved
                                                Cards</span></a>
                                    <div class="material-border"></div>
                                </li>
                                <li class="nav-item"><a data-toggle="tab" href="#NewCard" class="nav-link"><span>New
                                                Card</span></a>
                                    <div class="material-border"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content tab-content nav-material content-payment">
                            <div id="SavedCards" class="tab-pane show fade in active mt-30">
                                <div class="row card-box">
                                    <div class="mr-3"><img src="images/payment/mastercard.png" alt=""></div>
                                    <div>
                                        <p> **** **** ****7106</p>
                                        <p>MasterCard</p>
                                    </div>
                                    <div class="ml-auto">
                                        <a href=""><span class="ti-pencil-alt mr-3"></span></a>
                                        <a href=""><span class="ti-trash mr-1"></span></a>
                                    </div>

                                </div>
                                <div class="row card-box">
                                    <div class="mr-3"><img src="images/payment/visa.png" alt=""></div>
                                    <div>
                                        <p> **** **** ****7106</p>
                                        <p>Visa</p>
                                    </div>
                                    <div class="ml-auto">
                                        <a href=""><span class="ti-pencil-alt mr-3"></span></a>
                                        <a href=""><span class="ti-trash mr-1"></span></a>
                                    </div>

                                </div>
                                <div class="row card-box">
                                    <div class="mr-3"><img src="images/payment/american.png" alt=""></div>
                                    <div>
                                        <p> **** **** ****7106</p>
                                        <p>AMEX</p>
                                    </div>
                                    <div class="ml-auto">
                                        <a href=""><span class="ti-pencil-alt mr-3"></span></a>
                                        <a href=""><span class="ti-trash mr-1"></span></a>
                                    </div>

                                </div>
                            </div>
                            <div id="NewCard" class="tab-pane show fade in">
                                <div class="row">
                                    <div class="col-md-8">

                                        <div class="container mt-30 ">
                                            <form action="" class="checkbox-form">
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <div class="checkout-form-list">
                                                            <label>Card Number <span
                                                                    class="required">*</span></label>
                                                            <input placeholder="" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Cardholder Name <span
                                                                    class="required">*</span></label>
                                                            <input placeholder="" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>Expire Date <span
                                                                    class="required">*</span></label>
                                                            <input placeholder="MM/YY" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list">
                                                            <label>CVV <span class="required">*</span></label>
                                                            <input placeholder="" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#">add card</a>
                                            </form>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

