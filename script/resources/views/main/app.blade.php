<!DOCTYPE html>
@if(app()->getLocale() == 'ar')
    <html dir="rtl" direction="rtl" lang="ar">
    @else
        <html lang="en">
        @endif


        <head>
            <title>



                        @php
                        $site_info = \App\Option::where('key', 'company_info')->first();
         $info = json_decode($site_info->value);

            $name=$info->name;

          $name = json_decode($name);
                        @endphp

        @if(app()->getLocale() == 'ar')

            {{ $name->ar ?? '' }}

              @else
            {{ $name->en ?? '' }}
            @endif


            </title>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="description" content=" {{ $name->en ?? '' }}">
            <meta name="keywords" content=" {{ $name->en ?? '' }}">
            <meta property="og:title" content=" {{ $name->en ?? '' }}" />
            <meta property="og:description" content=" {{ $name->en ?? '' }}" />
            <meta property="og:keywords" content=" {{ $name->en ?? '' }}" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
            {{-- generate seo info --}}
            {!! SEO::generate() !!}
            {!! JsonLdMulti::generate() !!}
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- Favicon -->

            <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon/favicon.ico') }}"/>

            <!--
             Essential stylesheets
             =====================================-->
            @if(app()->getLocale() == 'ar')
                <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/bootstrap/ar-bootstrap.min.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/icofont/ar-icofont.min.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/slick-carousel/slick/slick.css') }}">
                <link rel="stylesheet"
                      href="{{ asset('assets/frontend/plugins/slick-carousel/slick/slick-theme.css') }}">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
                <!-- Main Stylesheet -->
@include('main.style')
@include('main.rtl')



            @else
                <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/bootstrap/bootstrap.min.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/icofont/icofont.min.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/slick-carousel/slick/slick.css') }}">
                <link rel="stylesheet"
                      href="{{ asset('assets/frontend/plugins/slick-carousel/slick/slick-theme.css') }}">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
                <!-- Main Stylesheet -->

@include('main.style')


                <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
        @endif
        <!--=====================================
         CSS LINK PART START
         =======================================-->
        {{ Helper::autoload_main_site_data() }}



        @stack('style')
        <!--=====================================
         CSS LINK PART END
         =======================================-->


        </head>
        <body id="top">
        <div id="cover">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
        <!--=====================================
                     NAVBAR PART START
                     =======================================-->

        @if(Cache::has('marketing_tool'))
            @php
                $tools=Cache::get('marketing_tool');
                $tools=json_encode($tools);
                $tools=json_decode($tools ?? '');
            @endphp
            @isset($tools->fb_pixel_status)
                @if($tools->fb_pixel_status == 'on')
                    {!! facebook_pixel($tools->fb_pixel) !!}
                @endif
            @endisset

        @endif
        <header>
            @if(Cache::has('site_info'))
                @php
                    $site_info=Cache::get('site_info');
                @endphp
                <div class="header-top-bar">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <ul class="top-bar-info list-inline-item pl-0 mb-0">
                                    <li class="list-inline-item"><a href="mailto:{{ $site_info->email1 }}"><i
                                                class="icofont-support-faq mr-2"></i>{{ $site_info->email1 }}</a></li>
                                    <li class="list-inline-item"><i
                                            class="icofont-location-pin mr-2"></i>{{ $site_info->address }} </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <div class="text-lg-right top-right-bar mt-2 mt-lg-0">
                                    @if(Cache::has('active_languages'))
                                        @php
                                            $langs=Cache::get('active_languages');
                                        @endphp
                                        <form class="translate_form" action="{{ route('translate') }}">
                                            <select class="translate_option" name="local">
                                                @foreach($langs as $key=>$row)
                                                    <option value="{{ $key }}"
                                                            @if(Session::get('locale') == $key) selected @endif>{{ $row }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <nav class="navbar navbar-expand-lg navigation  wow fadeIn" id="navbar">
                <div class="container">
                    <a class="navbar-brand wow swing" href="{{ url('/') }}">
                        @if(app()->getLocale() == 'ar')
                            <img src="{{ asset('uploads/logo/logo.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                        @else
                             <img src="{{ asset('uploads/logo/logo_en.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                        @endif
                    </a>

                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                            data-target="#navbarmain"
                            aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icofont-navigation-menu"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarmain">
                        <ul class="navbar-nav mr-auto">
                            {{ Menu('header','nav-item dropdown','navbar-item','navbar-link','',true) }}
                        </ul>
                        <div class="lang">
                            @if(Cache::has('active_languages'))
                                @php
                                    $langs=Cache::get('active_languages');
                                @endphp
                                <form class="translate_form" action="{{ route('translate') }}">
                                    <select class="translate_option" name="local">
                                        @foreach($langs as $key=>$row)
                                            <option value="{{ $key }}"
                                                    @if(Session::get('locale') == $key) selected @endif>{{ $row }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </header>


        <!--=====================================
        NAVBAR PART END
        =======================================-->

        @yield('content')



        <!--=====================================
FOOTER PART START
=======================================-->

        <footer class="footer section ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mr-auto col-sm-6">
                        <div class="widget mb-5 mb-lg-0 wow fadeIn" data-wow-delay="0.5s">
                            <div class="logo mb-4">

                                <a href="{{ url('/') }}">


                                    @if(app()->getLocale() == 'ar')
                                        <img src="{{ asset('uploads/logo/footer_logo.png') }}" alt="" class="img-fluid wow swing" style="width: 205px;height: 50px;">
                                    @else
                                        <img src="{{ asset('uploads/logo/footer_logo_en.png') }}" alt="" class="img-fluid wow swing" style="width: 205px;height: 50px;">
                                    @endif
                                </a>
                            </div>
                            @if(Cache::has('site_info'))
                                @php
                                    $site_info=Cache::get('site_info');
                                @endphp
                                <p>
                                    @if(app()->getLocale() == "ar")
                                        {{ json_decode($site_info->site_description , true)['ar'] }}
                                    @else
                                        {{ json_decode($site_info->site_description , true)['en'] }}
                                    @endif
                                </p>

                                <ul class="list-inline footer-socials mt-4">
                                    @if(!empty($site_info->facebook))
                                        <li class="list-inline-item"><a href="{{ $site_info->facebook }}"><i
                                                    class="icofont-facebook"></i></a></li>
                                    @endif
                                    @if(!empty($site_info->twitter))
                                        <li class="list-inline-item"><a href="{{ $site_info->twitter }}"><i
                                                    class="icofont-twitter"></i></a></li>
                                    @endif
                                    @if(!empty($site_info->linkedin))
                                        <li class="list-inline-item"><a href="{{ $site_info->linkedin }}"><i
                                                    class="icofont-linkedin"></i></a></li>
                                    @endif
                                    @if(!empty($site_info->instagram))
                                        <li class="list-inline-item"><a href="{{ $site_info->instagram }}"><i
                                                    class="icofont-instagram"></i></a></li>
                                    @endif
                                    @if(!empty($site_info->youtube))
                                        <li class="list-inline-item"><a href="{{ $site_info->youtube }}"><i
                                                    class="icofont-youtube"></i></a></li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6  wow fadeIn" data-wow-delay="1.00s">

                        {{ main_footer_menu('footer_left','','','','top',true) }}
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        {{ main_footer_menu('footer_center','','','','top',true) }}
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 wow fadeIn" data-wow-delay="2.00s">
                        {{ main_footer_menu('footer_right','','','','top',true) }}
                    </div>


                </div>

                <div class="footer-btm py-4 mt-5">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-12 text-center">
                            <div class="copyright">
                                &copy; Copyright Reserved by <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <a class="backtop js-scroll-trigger" href="#top">
                                <i class="icofont-long-arrow-up"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <!--=====================================
        FOOTER PART END
        =======================================-->
        <!--=====================================
        JS LINK PART START
        =======================================-->
        <script src="{{ asset('assets/frontend/plugins/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/frontend/plugins/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/plugins/slick-carousel/slick/slick.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
        <script>
            wow = new WOW({
                mobile: true, // default
            })
            wow.init();
            $(window).on('load', function () {
                $('#cover').fadeOut(1000);
            })
        </script>

        @stack('js')

        @if(Cache::has('marketing_tool'))
            @php
                $tools=Cache::get('marketing_tool');
                $tools=json_encode($tools);
                $tools=json_decode($tools ?? '');
            @endphp
            @isset($tools->google_status)
                @if($tools->google_status == 'on')
                    {!! google_analytics($tools->ga_measurement_id) !!}
                @endif
            @endisset

        @endif




                    @php
                     $info=App\Option::where('key','marketing_tool')->first();
        $info=json_decode($info->value ?? '');
                    @endphp








<!-- Snap Pixel Code -->
<script type='text/javascript'>
    (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
    {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
        a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
        r.src=n;var u=t.getElementsByTagName(s)[0];
        u.parentNode.insertBefore(r,u);})(window,document,
        'https://sc-static.net/scevent.min.js');

    snaptr('init', ' {{ $info->PixcelSnap ?? '' }}', {
        'user_email': 'marwan@sbs-sa.com'
    });

    snaptr('track', 'PAGE_VIEW');

</script>
<!-- End Snap Pixel Code -->



<!-- TikTok Pixel Code -->
<script>
    !function (w, d, t) {
        w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};

        ttq.load('{{ $info->PixcelTecToc ?? '' }}');
        ttq.page();
    }(window, document, 'ttq');
</script>
<!-- End TikTok Pixel Code -->





<!-- Twitter universal website tag code -->
<script>
    !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
    },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='//static.ads-twitter.com/uwt.js',
        a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
    // Insert Twitter Pixel ID and Standard Event data below
    twq('init','{{ $info->PixcelTwiter ?? '' }}');
    twq('track','PageView');
</script>


        </body>
        </html>
