<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!--Slick slider css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">


    <!--animate css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/ecommerce/css/themify-icons.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!--SM Clean-->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartmenus/1.0.2/css/sm-core-css.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartmenus/1.0.2/css/sm-clean/sm-clean.min.css">

    <!--venobox-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.3/venobox.min.css">

    <!-- price slider-->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css">

    <!-- Style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/ecommerce/css/style.css') }}">
    @stack('css')
    <title>My Kart</title>

</head>

<body>
<b class="screen-overlay"></b>

<!-- offcanvas panel -->
<aside class="offcanvas" id="my_offcanvas1">
    <header class="p-4 bg-light border-bottom">
        <button class="btn btn-outline-danger btn-close"> &times Close</button>
    </header>
    <nav>
        <ul id="sub-menu" class="sm sm-vertical sm-clean">
            <li><a class="has-submenu" href="category-page.html">Title Menu One</a>
                <ul class="mega-menu sm-nowrap">
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                </ul>
            </li>
            <li><a class="has-submenu" href="category-page.html">Title Menu One</a>
                <ul class="mega-menu sm-nowrap">
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                </ul>
            </li>
            <li><a class="has-submenu" href="category-page.html">Title Menu One</a>
                <ul class="mega-menu sm-nowrap">
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                </ul>
            </li>
            <li><a class="has-submenu" href="category-page.html">Title Menu One</a>
                <ul class="mega-menu sm-nowrap">
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                </ul>
            </li>
            <li><a class="has-submenu" href="category-page.html">Title Menu One</a>
                <ul class="mega-menu sm-nowrap">
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                    <li><a href="product-page.html">Custome Menu</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
<!-- offcanvas panel .end -->
<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="header-contact">
                    <ul>
                        <li>Welcome to Our store MYkart</li>
                        <li><i class="ti-mobile"></i>Call Us: 01098719871</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 text-right">
                <ul class="header-dropdown">
                    <li class="mobile-wishlist"><a href="{{ url('/wishlist') }}"><i class="ti-heart"></i></a>
                    </li>
                    <li class="onhover-dropdown mobile-account">
                        <a href="#"><i class="ti-user"></i> My Account </a>
                        <ul class="onhover-show-div">
                            <li><a href="{{ url('/user/login') }}">Login/Register</a></li>
                            <li><a href="{{ url('/user/dashboard') }}">Account Details</a></li>
                            <li><a href="{{ url('/user/orders') }}">Orders</a></li>
                            <li><a href="{{ url('/user/addresses') }}">Addresses</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<header>
    <div class="container">
        <div class="row align-items-center py-3">
            <div class="col">
                <a data-trigger="#my_offcanvas1" href="#" class="mr-3"><i class="ti-menu"></i></a>
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('frontend/ecommerce/images/logo.png') }}"
                                                               alt=""></a>
            </div>
            <div class="col">
                <form action="search.html" class="searchbox">
                    <input type="text" placeholder="What are you Looking For ?">
                    <a href="search.html" class="li-btn" type="submit"><span class="ti-search"></span></a>
                </form>
            </div>
            <div class="col head_icons">
                <ul class="d-flex justify-content-end">
                    <li class="d-inline-block mr-5  onhover-dropdown"><a href="#"><i class="ti-settings"></i></a>
                        <ul class="onhover-show-div shopping-cart d-flex">
                            <div class="col p-0">
                                <h6>Language</h6>
                                <div class="dropdown-divider"></div>
                                <li><a href="index.html">Arabic</a></li>
                                <li><a href="index.html">English</a></li>
                            </div>

                            <div class="col p-0 pl-2">
                                <h6>Currency</h6>
                                <div class="dropdown-divider"></div>
                                <li><a href="index.html">EGP</a></li>
                                <li><a href="index.html">USD</a></li>
                                <li><a href="index.html">SAR</a></li>
                            </div>

                        </ul>
                    </li>
                    <li class="d-inline-block  onhover-dropdown">
                        <a href="#">
                            <i class="ti-shopping-cart"></i>
                            <span class="cart_qty_cls">2</span>
                        </a>
                        <ul class="show-div onhover-show-div shopping-cart">
                            <li>
                                <div class="media">
                                    <a href="product-page.html"><img alt="" class="me-3"
                                                                     src="https://via.placeholder.com/70X90"></a>
                                    <div class="media-body">
                                        <a href="product-page.html">
                                            <h4>item name</h4>
                                        </a>
                                        <h4><span>1 x EGP 299.00</span></h4>
                                    </div>
                                </div>
                                <div class="close-circle"><a href="#"><i class="fa fa-times"
                                                                         aria-hidden="true"></i></a></div>
                            </li>

                            <li>
                                <div class="total">
                                    <h5>subtotal : <span>EGP299.00</span></h5>
                                </div>
                            </li>
                            <li>
                                <div class="buttons"><a href="{{ url('/cart') }}" class="view-cart">view
                                        cart</a> <a href="{{ url('/checkout') }}" class="checkout">checkout</a></div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<div class="header-bottom header-sticky">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main_nav">

                    <ul class="navbar-nav">
                        <li class="nav-item active"><a class="nav-link" href="{{ url('/') }}">Home </a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html"> About us </a></li>
                        <li class="nav-item"><a class="nav-link" href="offers.html"> Offers </a></li>
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Categories </a>
                            <div class="dropdown-menu megamenu">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu One</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu two</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu three</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="col-megamenu">
                                            <h6 class="title">Title Menu four</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                                <li><a href="category-page.html">Custom Menu</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- dropdown-mega-menu.// -->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact.html"> Contact us </a></li>
                    </ul>
                </div> <!-- navbar-collapse.// -->
            </nav>
        </div>
    </div>

</div>

@yield('content')
@yield('external-footer')
@include('frontend/ecommerce/layouts/footer')
@yield('modal')
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<!-- jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- slick js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<!--Sm Clean-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.smartmenus/1.0.2/jquery.smartmenus.min.js"></script>
<!--scroll to top-->
<script src="{{ asset('frontend/ecommerce/js/scrollUp.min.js')}}"></script>
<!--Price Range-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<!-- notify bootstrap-->
<script src="{{ asset('frontend/ecommerce/js/bootstrap-notify.min.js')}}"></script>
<!--venobox-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.3/venobox.min.js"></script>
<!-- script js-->
<script src="{{ asset('frontend/ecommerce/js/script.js')}}"></script>
@stack('js')

</body>

</html>
