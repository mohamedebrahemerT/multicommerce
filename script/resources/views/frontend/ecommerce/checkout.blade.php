@extends('frontend.ecommerce.layouts.app')

@section('content')

    <section class="wrap-header-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="cart-header border-right active">
                        <h1><span>01</span><br>Shopping Cart</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-header border-right active">
                        <h1><span>02</span><br>BILLING & SHIPPING</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-header active">
                        <h1><span>03</span><br>Payment Options</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <!--Shopping Cart Area Strat-->
        <div class="Shopping-cart-area pt-4 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="billing-section">
                            <h3>Payment Options</h3>
                            <form action="#">
                                <div class="checkbox-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkout-form-list mt-20">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                           name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1"><img
                                                            src="{{ asset('frontend/ecommerce/images/credit-card.png') }}"
                                                            alt=""> Credit Card</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                           name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2"><img
                                                            src="{{ asset('frontend/ecommerce/images/cash.png') }}"
                                                            alt="">cash on delivery</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Card Number <span class="required">*</span></label>
                                                <input placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Cardholder Name <span class="required">*</span></label>
                                                <input placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Expire Date <span class="required">*</span></label>
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
                                    <a href="thanks.html">Place order</a>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="cart-product-name">Product</th>
                                        <th class="cart-product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">Arduino Mega ADK For Android. -ITALY<strong
                                                class="product-quantity"> × 1</strong></td>
                                        <td class="cart-product-total"><span class="amount">850.00</span></td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">Thermistor Resistance<strong
                                                class="product-quantity"> × 1</strong></td>
                                        <td class="cart-product-total"><span class="amount">5.00</span></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">855.00</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Shipping Fees</th>
                                        <td><span class="amount">20.00</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">875.00</span></strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
    </section>
@endsection

@push('js')
    {{--    <script src="{{ asset('frontend/ecommerce/js/index.js')}}"></script>--}}
@endpush
