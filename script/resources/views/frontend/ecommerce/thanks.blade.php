@extends('frontend.ecommerce.layouts.app')

@section('content')
    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-md-center text-center">
                <div class="col-md-5">
                    <div class="thanks">
                        <img
                            src="{{ asset('frontend/ecommerce/images/thankful.png') }}"
                            alt="">
                        <h3 class="pt-2">Thank you </h3>
                        <h6 class="pb-5">
                            Your order has been placed and will be processed as soon as possible.

                            Make sure you make note of your order number, which is MyKart

                            You will be receiving an email shortly with confirmation of your order.
                        </h6>
                        <p><span>Order Number: </span> <strong>4661</strong></p>
                        <p><span>Date: </span> <strong> July 30, 2020</strong></p>
                        <p><span>Total: </span> <strong>875 EGP</strong></p>
                        <p><span>Payment Method: </span> <strong> Credit Card</strong></p>
                        <a href="products.html" class="links">shop MORE</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('js')
    {{--    <script src="{{ asset('frontend/ecommerce/js/index.js')}}"></script>--}}
@endpush
