@extends('frontend.ecommerce.layouts.app')
@section('content')
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-content table-responsive py-5">
                        <table class="table order-table-details">
                            <thead>
                            <tr>

                                <th>Order Status</th>
                                <th>Order Date</th>
                                <th>Total Order</th>
                                <th>Payment Mehod</th>
                                <th>QTY</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="status">
                                    <label class="new"></label>
                                    New
                                </td>
                                <td>30/6/2020</td>
                                <td class="totalorder">
                                    <div class="row">
                                        <div class="col"><strong>Subtotal</strong></div>
                                        <div class="col"><label for=""> 855.00</label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><strong>Shipping Fees</strong></div>
                                        <div class="col"><label for=""> 20.00</label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><strong>Total</strong></div>
                                        <div class="col"><label for=""> 875.00</label></div>
                                    </div>
                                </td>
                                <td>Credit Card</td>
                                <td>2</td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="li-product-thumbnail"><a href="#"><img src="{{ asset('frontend/ecommerce/images/products/1.jpg') }}"
                                                                                  alt=""></a></td>
                                <td>Arduino Mega ADK For Android. -ITALY</td>
                                <td>1</td>
                                <td>850.00</td>
                                <td><a href="#" class="btn btn-gray" data-toggle="modal"
                                       data-target="#exampleModal">I Dont Need This
                                        Product</a></td>
                            </tr>
                            <tr>
                                <td class="li-product-thumbnail"><a href="#"><img src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}"
                                                                                  alt=""></a></td>
                                <td>Thermistor Resistance</td>
                                <td>1</td>
                                <td>5.00</td>
                                <td><a href="#" class="btn btn-gray" data-toggle="modal"
                                       data-target="#exampleModal">I Dont Need This
                                        Product</a></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

