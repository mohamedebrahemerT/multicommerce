<!DOCTYPE html>
@if(app()->getLocale() == 'ar')
    <html dir="rtl" direction="rtl" lang="ar">
    @else
        <html lang="en">
        @endif
        <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
            <title>{{ __('Reset Password') }}</title>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon/favicon.ico') }}"/>
            @if(app()->getLocale() == 'ar')
                <link rel="stylesheet" href="{{ asset('assets/css/ar-bootstrap.min.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">

                <!-- Template CSS -->
                <link rel="stylesheet" href="{{ asset('assets/css/ar-style.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/css/ar-components.css') }}">
            @else
                <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">

                <!-- Template CSS -->
                <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
            @endif

            <style>
                .card .card-header h4 {
                    color: @isset(site_info()->basic_colors_1){{site_info()->basic_colors_1}}@endisset;
                }

                .btn-block {
                    background: @isset(site_info()->basic_colors_1) {{site_info()->basic_colors_1}} @endisset;
                    color: #fff;
                    border-color: @isset(site_info()->basic_colors_1){{site_info()->basic_colors_1}}@endisset;
                }
                .card.card-primary {
                    border-top: 2px solid @isset(site_info()->basic_colors_1){{site_info()->basic_colors_1}}@endisset;
                }
            </style>

            <style>
    body
        {
            background:url('uploads/5-of-the-best-password-reset-emails.png') no-repeat center center fixed;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            margin: 0;
            padding: 0;
        }

    </style>
        </head>

        <body>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div
                            class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4" style="margin-top: 13%;">
                            <!--div class="login-brand">
                                @if(app()->getLocale() == 'ar')
                                    <img src="{{ asset('uploads/logo/footer_logo.png') }}" alt="" class="img-fluid wow swing" style="width: 205px;height: 50px;">
                                @else
                                    <img src="{{ asset('uploads/logo/footer_logo_en.png') }}" alt="" class="img-fluid wow swing" style="width: 205px;height: 50px;">
                                @endif
                            </div -->

                            <div class="card card-primary">
                                <div class="card-header">{{ __('Reset Password') }}</div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                                   autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                            @enderror


                                        </div>


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </form>


                                    {{--        <div class="simple-footer">--}}
                                    {{--            Copyright &copy; {{ env('APP_NAME') }} {{ date('Y') }}--}}
                                    {{--        </div>--}}

                                </div>
                            </div>
            </section>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

        <!-- Template JS File -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        </body>
        </html>





