<!DOCTYPE html>
@if(app()->getLocale() == 'ar')
    <html dir="rtl" direction="rtl" lang="ar">
    @else
        <html lang="en">
        @endif
        <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
            <title>{{ env('APP_NAME') }}</title>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- Favicon -->
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
        </head>

        <body>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div
                            class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                            <div class="login-brand">
                                <a href="{{ url('/') }}">
                                    @if(app()->getLocale() == 'ar')
                                        <img src="{{ asset('uploads/logo/footer_logo.png') }}" alt="" class="shadow-light" style="width: 205px;height: 50px;">
                                    @else
                                        <img src="{{ asset('uploads/logo/footer_logo_en.png') }}" alt="" class="shadow-light" style="width: 205px;height: 50px;">
                                    @endif
                                </a>

                            </div>

                            <div class="card card-primary">
                                <div class="card-header"><h4>{{ __('Register') }}</h4></div>
                                <form class="basicform" method="post"
                                      action="{{ route('merchant.register-make',$info->id) }}">
                                    @csrf

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="frist_name">{{ __('NameOFStore') }}</label>
                                                <input id="frist_name" type="text" class="form-control" name="name"
                                                       autofocus>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="last_name">{{ __('Email') }}</label>
                                                <input id="email" type="email" class="form-control" name="email">
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="password" class="d-block">{{ __('Password') }}</label>
                                                <input id="password" type="password" class="form-control pwstrength"
                                                       data-indicator="pwindicator" name="password">
                                                <div id="pwindicator" class="pwindicator">
                                                    <div class="bar"></div>
                                                    <div class="label"></div>
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="password2"
                                                       class="d-block">{{ __('Password Confirmation') }}</label>
                                                <input id="password2" type="password" class="form-control"
                                                       name="password_confirmation">
                                            </div>
                                        </div>

                                         <div class="row">
                                            <div class="form-group col-6">
                                                <label for="phone" class="d-block">{{ __('Phone') }}</label>
                                                <input id="phone" type="number" class="form-control pwstrength"
                                                       data-indicator="pwindicator" name="phone">

                                            </div>




                                            <div class="form-group col-6">
                                                <label for="phone" class="d-block">{{ __('kianType') }}</label>
                                                <input id="phone" type="text" class="form-control pwstrength"
                                                       data-indicator="pwindicator" name="kianType" required>



                                        </div>
 </div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="shop_type"
                                                       class="d-block">{{ __('Choose Activity Type') }}</label>
                                                <select id="shop_type" class="form-control" name="shop_type">
                                                    <option value="" selected disabled>{{ __('Choose Activity Type') }}</option>
                                                    <option value="1">{{ __('Online Shop') }}</option>
                                                    <option value="2">{{ __('Supermarkets / Pharmacies') }}</option>
                                                    <option value="3">{{ __('Restaurant') }}</option>
                                                    <option value="4">{{ __('Beauty Center') }}</option>
                                                </select>
                                            </div>
                                        </div>


                                        @if($info->custom_domain==0)
                                            <div class="form-divider">
                                                {{ __('Your Subdomain') }} <br>
                                                <span>{{ __('Example') }}: </span>
                                                <span>{example}.{{ env('APP_PROTOCOLESS_URL') }}</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="input-group mb-2">
                                                            <input id="my-field" type="text" class="form-control text-right"
                                                                   name="domain"
                                                                   placeholder="subdomain without protocol"   onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    .{{ env('APP_PROTOCOLESS_URL') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @else
                                            <div class="form-divider">
                                                {{ __('Protocol Less Domain') }}<br>
                                                <span>{{ __('Example') }}: </span>
                                                <span>{{ __('example.com') }}</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="my-field" name="domain"
                                                               placeholder="{{ __('Protocol Less Domain') }}"  onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)">

                                                    </div>
                                                    <span>{{ __('Note') }}: <small
                                                            class="text-danger">{{ __('You Need To Also Connect With Your Domain With Our Server Once Complete The Payment You Will Get The Credentials') }}</small></span>

                                                </div>
                                            </div>

                                        @endif

                                        @if($info->custom_domain==1)
                                            <div class="form-divider">
                                                {{ __('Full Domain') }} <br>
                                                <span>{{ __('Example') }}: </span>
                                                <span>https://example.com</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">

                                                        <input type="text" class="form-control" id="my-field1" name="full_domain"
                                                               placeholder="{{ __('Full Domain') }}"  onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)">


                                                    </div>

                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" required="" name="agree"
                                                       class="custom-control-input" id="agree">
                                                <label class="custom-control-label"
                                                       for="agree">{{ __('I agree with the') }} <a
                                                        href="{{ url('/terms-conditions') }}">{{ __('terms and conditions') }}</a></label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block basicbtn">
                                                {{ __('Register And Payment') }}
                                            </button>
                                        </div>
                                </form>
                            </div>
                        </div>
                        {{--          <div class="simple-footer">--}}
                        {{--            {{ __('Copyright') }} &copy; {{ env('APP_NAME') }} {{ date('Y') }}--}}
                        {{--          </div>--}}
                    </div>
                </div>
        </div>
        </section>
        </div>
        <input type="hidden" id="location_url" value="{{ url('/merchant/make-payment',$info->id) }}">
        <!-- General JS Scripts -->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
        <!-- Template JS File -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/js/form.js') }}"></script>
        <script src="{{ asset('assets/js/admin/register.js') }}"></script>


    <script type="text/javascript">
        function testInput(event) {
   var value = String.fromCharCode(event.which);
   var pattern = new RegExp(/[a-zåäö ]/i);
   return pattern.test(value);
}

$('#my-field').bind('keypress', testInput);
$('#my-field1').bind('keypress', testInput);
    </script>
        </body>
        </html>




