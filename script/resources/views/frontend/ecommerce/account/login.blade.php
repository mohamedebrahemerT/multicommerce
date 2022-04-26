@extends('frontend.ecommerce.account.layouts.app')
@section('content')

    <section class="bg-light bg-login py-5">


        <div class="brand m-auto text-center">
            <a href="index.html">
                <img src="images/logo.png" alt="" class="img/fluid">
            </a>
        </div>

        <section class="login-block mt-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 login-sec">

                        <div class="li-product-tab li-trending-product-tab">
                            <ul class="nav li-product-menu li-trending-product-menu">
                                <li><a class="active" data-toggle="tab" href="#signin"><span>Sign in</span></a></li>
                                <li><a data-toggle="tab" href="#signup"><span>sign up</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content li-tab-content li-trending-product-content">
                            <div id="signin" class="tab-pane show fade in active">
                                <div class="row">
                                    <div class="col">
                                        <form class="login-form">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                       placeholder="Mobile Number Or Email">

                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>


                                            <div class="form-check">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">Remember
                                                        me</label>
                                                </div>

                                            </div>
                                            <label for="" class="float-right"><a href="forgetpassword.html"  data-toggle="modal"
                                                                                 data-target="#exampleModal">Forget
                                                    Password ?</a></label>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-login">Login</button>
                                            </div>
                                        </form>
                                        <h6 class="line"><span class="line-center">OR</span></h6>
                                        <div class="social-btns">
                                            <a href="#" class="fb btn">
                                                <i class="fab fa-facebook fa-fw"></i> Login with Facebook
                                            </a>
                                            <a href="#" class="google btn"><i class="fab fa-google fa-fw">
                                                </i> Login with Google
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="signup" class="tab-pane show fade in">
                                <div class="row">
                                    <div class="col">
                                        <form class="login-form">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"
                                                               placeholder="First Name">

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"
                                                               placeholder="First Name">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Mobile Number">

                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Email">

                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control"
                                                       placeholder="Confrim Password">
                                            </div>
                                            <small>By Creating An Account, You Agree To Receive Sms
                                                From Our Website.</small>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-login">Signup</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </section>
@include('frontend/ecommerce/account/forget')
@endsection
