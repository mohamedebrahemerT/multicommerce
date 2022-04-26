@extends('frontend.ecommerce.layouts.app')

@section('content')
    @include('frontend/ecommerce/layouts/header')
    <section class="products my-5">
        <div class="container">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <h2 class="title-inner1">Trending products</h2>
                </div>
            </div>
            <div class="row slider">
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/1.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/2.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="javascript:void(0)" data-tip="Quick View" data-toggle="modal"
                                       data-target="#exampleModal"><i
                                            class="ti-eye"></i></a></li>
                                <li><a href="javascript:void(0)" data-tip="Add to Wishlist"><i class="ti-heart"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a>
                                </li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/3.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/4.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="javascript:void(0)" data-tip="Quick View" data-toggle="modal"
                                       data-target="#exampleModal"><i
                                            class="ti-eye"></i></a></li>
                                <li><a href="javascript:void(0)" data-tip="Add to Wishlist"><i class="ti-heart"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a>
                                </li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/5.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/6.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="javascript:void(0)" data-tip="Quick View" data-toggle="modal"
                                       data-target="#exampleModal"><i
                                            class="ti-eye"></i></a></li>
                                <li><a href="javascript:void(0)" data-tip="Add to Wishlist"><i class="ti-heart"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a>
                                </li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="javascript:void(0)" data-tip="Quick View" data-toggle="modal"
                                       data-target="#exampleModal"><i
                                            class="ti-eye"></i></a></li>
                                <li><a href="javascript:void(0)" data-tip="Add to Wishlist"><i class="ti-heart"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a>
                                </li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="javascript:void(0)" data-tip="Quick View" data-toggle="modal"
                                       data-target="#exampleModal"><i
                                            class="ti-eye"></i></a></li>
                                <li><a href="javascript:void(0)" data-tip="Add to Wishlist"><i class="ti-heart"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a>
                                </li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <a href="#" class="btn btn-secondary">More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="products my-5 pt-4 offers_section">
        <div class="container">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <h2 class="title-inner1">Available Offer</h2>
                </div>
            </div>
            <div class="row slider">
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/1.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/2.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="javascript:void(0)" data-tip="Quick View" data-toggle="modal"
                                       data-target="#exampleModal"><i
                                            class="ti-eye"></i></a></li>
                                <li><a href="javascript:void(0)" data-tip="Add to Wishlist"><i class="ti-heart"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a>
                                </li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/3.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/4.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="javascript:void(0)" data-tip="Quick View" data-toggle="modal"
                                       data-target="#exampleModal"><i
                                            class="ti-eye"></i></a></li>
                                <li><a href="javascript:void(0)" data-tip="Add to Wishlist"><i class="ti-heart"></i></a>
                                </li>
                                <li><a href="javascript:void(0)" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a>
                                </li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/5.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/6.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <a href="#" class="btn btn-secondary">More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="products my-5">
        <div class="container">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <h2 class="title-inner1">Best selling products</h2>
                </div>
            </div>
            <div class="row slider">
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/1.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/2.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/3.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/4.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/5.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/6.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <a href="#" class="btn btn-secondary">More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="products my-5">
        <div class="container">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <h2 class="title-inner1">New arrival products</h2>
                </div>
            </div>
            <div class="row slider">
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/1.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/2.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/3.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/4.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/5.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/6.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <a href="#" class="btn btn-secondary">More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="products mt-5 py-4 recently-viewed">
        <div class="container-fluid">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <h2 class="title-inner1">Recently Viewed</h2>
                </div>
            </div>
            <div class="row recently-viewed-slider">
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/1.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/2.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/3.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/4.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/5.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/6.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/7.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/8.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#">
                                <img class="pic-1" src="{{ asset('frontend/ecommerce/images/products/1.jpg') }}">
                                <img class="pic-2" src="{{ asset('frontend/ecommerce/images/products/2.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="" data-tip="Quick View"><i class="ti-eye"></i></a></li>
                                <li><a href="" data-tip="Add to Wishlist"><i class="ti-heart"></i></a></li>
                                <li><a href="" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">Sale</span>
                            <span class="product-discount-label">20%</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{ url('/product/prod/1') }}">multi color polo tshirt</a></h3>
                            <div class="price">$16.00
                                <span>$20.00</span>
                            </div>
                            <a class="add-to-cart" href="">+ Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('external-footer')
    @include('frontend/ecommerce/layouts/external-footer')
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="quick-view-img">
                                <img src="{{ asset('frontend/ecommerce/images/products/1.jpg') }}" alt=""
                                     class="img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-6 rtl-text">
                            <div class="product-right">
                                <h2>Women Pink Shirt</h2>


                                <h3 class="price-detail">$32.96
                                    <del>$459.00</del>
                                    <span>55% off</span></h3>
                                <ul class="color-variant">
                                    <li class="bg-light0 active"></li>
                                    <li class="bg-light1"></li>
                                    <li class="bg-light2"></li>
                                </ul>
                                <div class="border-product">
                                    <h6 class="product-title">product details</h6>
                                    <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium
                                        doloremque laudantium</p>
                                </div>
                                <div id="selectSize" class="addeffect-section product-description border-product">

                                    <div class="size-box">
                                        <ul>
                                            <li class="active"><a href="javascript:void(0)">s</a></li>
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
                                            <input type="text" name="quantity" class="form-control input-number"
                                                   value="1">
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
                                    <a href="{{ url('/product/prod/1') }}" class="btn btn-solid hover-solid">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{--    <script src="{{ asset('frontend/ecommerce/js/index.js')}}"></script>--}}
@endpush
