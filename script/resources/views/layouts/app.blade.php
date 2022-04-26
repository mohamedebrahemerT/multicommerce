<!doctype html>
@if(app()->getLocale() == 'ar')
    <html dir="rtl" direction="rtl" lang="ar">
@else
    <html lang="en">
@endif
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/ar-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/ar-all.min.css') }}">
        {{--                <link href="//fonts.googleapis.com/css?family=Nunito:400,600,700,800" rel="stylesheet">--}}
        <link rel="stylesheet" href="{{ asset('assets/css/ar-style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font/ar-flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/ar-components.css') }}">
        <!--<link href="https://fonts.googleapis.com/css2?family=Tajawal" rel="stylesheet">-->
    @else
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon/favicon.ico') }}"/>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/moment.min.js')}}"></script>
    <style>
        .navbar-bg {
            background-color: @isset(site_info()->basic_colors_1){{site_info()->basic_colors_1}}@endisset;;
        }
    </style>

<body>

  @stack('style')

 

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('layouts/partials/header')
      @include('layouts/partials/sidebar')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
         @yield('head')
         <div class="section-body">
         </div>
       </section>
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


   
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

       @yield('content')
     </div>
     <footer class="main-footer">
      <div class="footer-left">
        Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Powered By <a href="{{ domain_info('full_domain') }}">

            @php
             $user_id=getUserId();
             $shop_name=App\Useroption::where('key','shop_name')->where('user_id',$user_id)->first();

             $shop_name_ar=App\Useroption::where('key','shop_name_ar')->where('user_id',$user_id)->first();


            @endphp

      @if(app()->getLocale() == 'ar')
       {{ $shop_name_ar->value ?? '' }}
               <a href=" {{ domain_info('full_domain') }}"> {{ domain_info('full_domain') }}</a>
        @else
        {{ $shop_name->value ?? '' }}
         <a href=" {{ domain_info('full_domain') }}"> {{ domain_info('full_domain') }}</a>
             @endif







        </a>
      </div>

    </footer>
  </div>
</div>
<!-- General JS Scripts -->
<!-- <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script> -->
<script src="{{ asset('assets/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.min.js')}}"></script>
<!-- <script src="{{ asset('assets/js/moment.min.js')}}"></script> -->
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
@stack('js')
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts.js') }}"></script>


    <script src="{{url('/')}}/assets/ckeditor/ckeditor/ckeditor.js"></script>
  <script src="{{url('/')}}/assets/ckeditor/ckeditor/samples/js/sample.js"></script>
  <!--<link rel="stylesheet" href="{{url('/')}}/assets/ckeditor/ckeditor/samples/css/samples.css">-->
<script>
  initSample();
</script>


@if(app()->getLocale() == 'ar')
    <style>

         * {
            font-family: 'Tajawal', sans-serif;
        }

         h1 {
            font-family: 'Tajawal', sans-serif;
        }
    </style>
@endif


</body>
</html>
