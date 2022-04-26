<!DOCTYPE html>
@if(app()->getLocale() == 'ar')
    <html dir="rtl" direction="rtl" lang="ar">
    @else
        <html lang="en">
        @endif
        <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
            <title>{{__('login')}} - {{ env('APP_NAME') }}</title>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- Favicon -->
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon/favicon.ico') }}"/>
            <!-- General CSS Files -->
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
        </head>

        <body>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div
                            class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="login-brand">
{{--                                <img src="{{ asset('uploads/logo2.png') }}" alt="logo" width="150" class="">--}}
                                @if(app()->getLocale() == 'ar')
                                    <img src="{{ asset('uploads/logo/footer_logo.png') }}" alt="" class="img-fluid wow swing" style="width: 205px;height: 50px;">
                                @else
                                    <img src="{{ asset('uploads/logo/footer_logo_en.png') }}" alt="" class="img-fluid wow swing" style="width: 205px;height: 50px;">
                                @endif
                            </div>

                            <div class="card card-primary">
                                <div class="card-header"><h4>{{ __('Login') }}</h4></div>

                                <div class="card-body">

                                     @if(session('success'))
   <div class="alert alert-success ">
   {{session('success')}}

     </div>
   @endif

          @if(session('danger'))
   <div class="alert alert-danger ">
   {{session('danger')}}

     </div>
   @endif

                                    <form method="POST"  class="needs-validation"
                                          action="{{url('/')}}/login_seller_admin">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email"
                                                   value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="password" class="control-label">{{ __('Password') }}</label>

                                            </div>
                                            <input id="password" type="password"
                                                   class="form-control  @error('password') is-invalid @enderror"
                                                   name="password"
                                                   required autocomplete="current-password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <br>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="remember" class="custom-control-input"
                                                           tabindex="3"
                                                           id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                           for="remember-me">{{ __('Remember Me') }}
                                                    </label>
                                                    @if (Route::has('password.request'))
                                                        <div class="float-right">
                                                            <a href="{{ route('password.request') }}" class="text-small">
                                                                {{ __('Forgot Password?') }}
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block basicbtn"
                                                        tabindex="4">
                                                    {{ __('Login') }}
                                                </button>
                                            </div>

                                            
                                    </form>

                                    @php
                                    $url=url('/').'/'.'login';
                                    $urlmain= env('APP_URL').'/'.'login';
                                     
                                    @endphp

                                    
            

                              @if($url ==  $urlmain  )    
      <div class="form-group">
                                                <a href="{{url('/')}}/priceing"  class="btn btn-primary btn-lg btn-block basicbtn"
                                                        tabindex="4">
                                                    {{ __('Register') }}
                                                </a>
                                            </div>
 @endif


                                    


                                    {{--          <div class="simple-footer">--}}
                                    {{--            {{ __('Copyright') }} &copy; {{ env('APP_NAME') }} {{ date('Y') }}--}}
                                    {{--          </div>--}}

                                </div>
                            </div>
            </section>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
        <!-- Template JS File -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/js/form.js') }}"></script>
        </body>
        </html>




