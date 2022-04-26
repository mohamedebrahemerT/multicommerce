@extends('frontend.ecommerce.layouts.app')

@section('content')
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>PRODUCT</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">PRODUCT</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-6">
                    <div class="slider-for">
                        <a href="images/products/3.jpg" class="venobox" data-gall="myGallery"><img class="pic-1"
                                                                                                   src="{{ asset('frontend/ecommerce/images/products/3.jpg') }}"></a>
                        <a href="images/products/4.jpg" class="venobox" data-gall="myGallery"><img class="pic-1"
                                                                                                   src="{{ asset('frontend/ecommerce/images/products/4.jpg') }}"></a>
                        <a href="images/products/5.jpg" class="venobox" data-gall="myGallery"><img class="pic-1"
                                                                                                   src="{{ asset('frontend/ecommerce/images/products/5.jpg') }}"></a>
                        <a href="images/products/6.jpg" class="venobox" data-gall="myGallery"><img class="pic-1"
                                                                                                   src="{{ asset('frontend/ecommerce/images/products/6.jpg') }}"></a>
                    </div>
                    <div class="slider-nav">
                        <div><img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/3.jpg') }}"></div>
                        <div><img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/4.jpg') }}"></div>
                        <div><img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/5.jpg') }}"></div>
                        <div><img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/6.jpg') }}"></div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="product-right">
                        <h2>Women Pink Shirt</h2>
                        <div class="rating-section">
                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                            <h6>120 ratings</h6>
                        </div>
                        <div class="label-section">
                            <span class="badge badge-grey-color">#1 Best seller</span>
                            <span class="label-text">in fashion</span>
                        </div>
                        <h3 class="price-detail">$32.96
                            <del>$459.00</del>
                            <span>55% off</span></h3>
                        <ul class="color-variant">
                            <li class="bg-light0 active"></li>
                            <li class="bg-light1"></li>
                            <li class="bg-light2"></li>
                        </ul>
                        <div id="selectSize" class="addeffect-section product-description border-product">

                            <div class="size-box">
                                <ul>
                                    <li><a href="javascript:void(0)">s</a></li>
                                    <li><a href="javascript:void(0)">m</a></li>
                                    <li><a href="javascript:void(0)">l</a></li>
                                    <li><a href="javascript:void(0)">xl</a></li>
                                </ul>
                            </div>
                            <h6 class="product-title">quantity</h6>
                            <div class="qty-box">
                                <div class="input-group"><span class="input-group-prepend"><button type="button"
                                                                                                   class="btn quantity-left-minus"
                                                                                                   data-type="minus"
                                                                                                   data-field=""><i
                                                class="ti-angle-left"></i></button> </span>
                                    <input type="text" name="quantity" class="form-control input-number" value="1">
                                    <span class="input-group-prepend"><button type="button"
                                                                              class="btn quantity-right-plus"
                                                                              data-type="plus" data-field=""><i
                                                class="ti-angle-right"></i></button></span>
                                </div>
                            </div>
                        </div>
                        <div class="product-buttons">
                            <a href="javascript:void(0)" id="cartEffect" class="btn btn-solid hover-solid">
                                <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i>
                                add to cart
                            </a>
                            <a href="#" class="btn btn-solid hover-solid"><i class="fa fa-bookmark fz-16 me-2"
                                                                             aria-hidden="true"></i>
                                wishlist
                            </a>
                        </div>
                        <div class="product-count">
                            <ul>
                                <li>
                                    <img src="{{ asset('frontend/ecommerce/images/truck.png') }}" class="img-fluid"
                                         alt="image">
                                    <span class="lang">Free shipping for orders above $500 USD</span>
                                </li>
                            </ul>
                        </div>

                        <div class="border-product">
                            <h6 class="product-title">shipping info</h6>
                            <ul class="shipping-info">
                                <li>100% Original Products</li>
                                <li>Free Delivery on order above Rs. 799</li>
                                <li>Pay on delivery is available</li>
                                <li>Easy 30 days returns and exchanges</li>
                            </ul>
                        </div>
                        <div class="border-product">
                            <h6 class="product-title">share it</h6>
                            <div class="product-icon">
                                <ul class="product-social">
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tab-product m-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <ul class="nav nav-tabs nav-material" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-toggle="tab" href="#tab1">Details</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#tab2">Specification</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#tab3">Reviews</a>
                            <div class="material-border"></div>
                        </li>
                    </ul>
                    <div class="tab-content nav-material" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab1">
                            <div class="product-tab-discription">
                                <div class="part">
                                    <p>The Model is wearing a white blouse from our stylist's collection, see the image
                                        for a mock-up of what the actual blouse would look like.it has text written on
                                        it in a black cursive language which looks great on a white color.</p>
                                </div>
                                <div class="part">
                                    <h5 class="inner-title">fabric:</h5>
                                    <p>Art silk is manufactured by synthetic fibres like rayon. It's light in weight and
                                        is soft on the skin for comfort in summers.Art silk is manufactured by synthetic
                                        fibres like rayon. It's light in weight and is soft on the skin for comfort in
                                        summers.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <p>The Model is wearing a white blouse from our stylist's collection, see the image for a
                                mock-up of what the actual blouse would look like.it has text written on it in a black
                                cursive language which looks great on a white color.</p>
                            <div class="single-product-tables">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>Sleeve Length</td>
                                        <td>Sleevless</td>
                                    </tr>
                                    <tr>
                                        <td>Neck</td>
                                        <td>Round Neck</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>Fabric</td>
                                        <td>Polyester</td>
                                    </tr>
                                    <tr>
                                        <td>Fit</td>
                                        <td>Regular Fit</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            <ul class="comment-section">
                                <li>
                                    <div class="media"><img
                                            src="{{ asset('frontend/ecommerce/images/avatar/avtar1.jpg') }}"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Mark Jecno <span>( 12 Jannuary 2018 at 1:30AM )</span></h6>
                                            <p>Donec rhoncus massa quis nibh imperdiet dictum. Vestibulum id est sit
                                                amet felis
                                                fringilla bibendum at at leo. Proin molestie ac nisi eu laoreet. Integer
                                                faucibus enim nec ullamcorper tempor. Aenean nec felis dui. Integer
                                                tristique</p>

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img src="{{ asset('frontend/ecommerce/images/avatar/2.jpg') }}"
                                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Mark Jecno <span>( 12 Jannuary 2018 at 1:30AM )</span></h6>
                                            <p>Donec rhoncus massa quis nibh imperdiet dictum. Vestibulum id est sit
                                                amet felis
                                                fringilla bibendum at at leo. Proin molestie ac nisi eu laoreet. Integer
                                                faucibus enim nec ullamcorper tempor. Aenean nec felis dui. Integer
                                                tristique</p>

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img
                                            src="{{ asset('frontend/ecommerce/images/avatar/avtar1.jpg') }}"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Mark Jecno <span>( 12 Jannuary 2018 at 1:30AM )</span></h6>
                                            <p>Donec rhoncus massa quis nibh imperdiet dictum. Vestibulum id est sit
                                                amet felis
                                                fringilla bibendum at at leo. Proin molestie ac nisi eu laoreet. Integer
                                                faucibus enim nec ullamcorper tempor. Aenean nec felis dui. Integer
                                                tristique</p>

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img src="{{ asset('frontend/ecommerce/images/avatar/2.jpg') }}"
                                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Mark Jecno <span>( 12 Jannuary 2018 at 1:30AM )</span></h6>
                                            <p>Donec rhoncus massa quis nibh imperdiet dictum. Vestibulum id est sit
                                                amet felis
                                                fringilla bibendum at at leo. Proin molestie ac nisi eu laoreet. Integer
                                                faucibus enim nec ullamcorper tempor. Aenean nec felis dui. Integer
                                                tristique</p>

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img src="images/avatar/avtar1.jpg"
                                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6>Mark Jecno <span>( 12 Jannuary 2018 at 1:30AM )</span></h6>
                                            <p>Donec rhoncus massa quis nibh imperdiet dictum. Vestibulum id est sit
                                                amet felis
                                                fringilla bibendum at at leo. Proin molestie ac nisi eu laoreet. Integer
                                                faucibus enim nec ullamcorper tempor. Aenean nec felis dui. Integer
                                                tristique</p>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <div class="added-notification">
        <img src="{{ asset('frontend/ecommerce/images/products/3.jpg') }}" class="img-fluid" alt="">
        <h3>added to cart</h3>
    </div>
@endsection

@push('js')
    {{--    <script src="{{ asset('frontend/ecommerce/js/index.js')}}"></script>--}}
@endpush
