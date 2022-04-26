@extends('frontend.ecommerce.layouts.app')

@section('content')
    <section class="bg-light">
        <!--Shopping Cart Area Strat-->
        <div class="Shopping-cart-area py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-content table-responsive favorites-tabel">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th>images</th>
                                    <th>Product</th>
                                    <th>Unit Price</th>
                                    <th>Stock Status</th>
                                    <th>Add To Cart</th>
                                    <th>remove</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td class="li-product-thumbnail"><a href="#"><img
                                                src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}"
                                                alt="Li's Product Image"></a>
                                    </td>
                                    <td class="li-product-name"><a href="#">Arduino Mega ADK For Android
                                            . -ITALY</a></td>
                                    <td class="li-product-price"><span class="amount">850.00</span></td>
                                    <td class="status">
                                        <label for="" class="green">In Stock</label>
                                    </td>
                                    <td class="order-btns"><a href="order-details.html" class="btn btn-black">Add to
                                            Cart</a></td>
                                    <td class="li-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                </tr>
                                <tr>

                                    <td class="li-product-thumbnail"><a href="#"><img
                                                src="{{ asset('frontend/ecommerce/images/products/5.jpg') }}"
                                                alt="Li's Product Image"></a>
                                    </td>
                                    <td class="li-product-name"><a href="#">Thermistor Resistance</a></td>
                                    <td class="li-product-price"><span class="amount">5.00</span></td>
                                    <td class="status">
                                        <label for="" class="red">Out Stock</label>
                                    </td>
                                    <td class="order-btns"><a href="order-details.html" class="btn btn-black">Add to
                                            Cart</a></td>
                                    <td class="li-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
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
