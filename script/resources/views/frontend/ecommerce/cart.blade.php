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
                    <div class="cart-header border-right">
                        <h1><span>02</span><br>BILLING & SHIPPING</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-header">
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
                    <div class="col-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>

                                        <th class="li-product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="li-product-price">Unit Price</th>
                                        <th class="li-product-quantity">Quantity</th>
                                        <th class="li-product-subtotal">Total</th>
                                        <th class="li-product-remove">remove</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td class="li-product-thumbnail"><a href="#"><img
                                                    src="{{ asset('frontend/ecommerce/images/products/3.jpg') }}"
                                                    alt="Li's Product Image"></a></td>
                                        <td class="li-product-name"><a href="#">Arduino Mega ADK For Android
                                                . -ITALY</a></td>
                                        <td class="li-product-price"><span class="amount">850.00</span></td>
                                        <td class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i>
                                                </div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount">850.00</span></td>
                                        <td class="li-product-remove"><a href="#"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td class="li-product-thumbnail"><a href="#"><img
                                                    src="{{ asset('frontend/ecommerce/images/products/1.jpg') }}"
                                                    alt="Li's Product Image"></a></td>
                                        <td class="li-product-name"><a href="#">Thermistor Resistance</a></td>
                                        <td class="li-product-price"><span class="amount">5.00</span></td>
                                        <td class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i>
                                                </div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount">5.00</span></td>
                                        <td class="li-product-remove"><a href="#"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                                   placeholder="Coupon code" type="text">
                                            <input class="button" name="apply_coupon" value="Apply coupon"
                                                   type="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>Subtotal <span>855.00</span></li>
                                            <li>Total <span>855.00</span></li>
                                        </ul>
                                        <a href="checkout1.html">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
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
