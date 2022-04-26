<!doctype html>
@if(app()->getLocale() == 'ar')
    <html   lang="ar">
@else
    <html lang="en">
@endif

<head>


      @php
       if(App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name')->first())
        {
              $shop_name=App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name')->first()->value;
        }

       
        @endphp


        @php
       if(App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name_ar')->first())
        {
              $shop_name_ar=App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name_ar')->first()->value;
        }

       
        @endphp
        

      
    <title>


        @if(Session::get('locale') == 'ar')  

          @isset($shop_name_ar)
         {{$shop_name_ar}}
        @endisset

@else

        @isset($shop_name)
         {{$shop_name}}
        @endisset

        @endif



 

                                
     
                            
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @php
  $user_id = domain_info('user_id');
@endphp

     <link rel="icon" href="{{url('/')}}/uploads/{{$user_id}}/favicon.ico" type="image/gif" sizes="16x16">



    {{-- generate seo info --}}
    {!! SEO::generate() !!}
    {!! JsonLdMulti::generate() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
 @php
        Helper::autoload_site_data();
    @endphp
     

   

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!--Slick slider css-->
    <link rel="stylesheet" href="{{url('/')}}/frontend/bigbag/external/slick.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/bigbag/external/slick-theme.min.css">


    <!--animate css-->
    <link rel="stylesheet" href="{{url('/')}}/frontend/bigbag/external/animate.min.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/bigbag/css/themify-icons.css">

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('/')}}/frontend/bigbag/external/bootstrap.min.css">

    <!--SM Clean-->
    <link rel="stylesheet"
        href="{{url('/')}}/frontend/bigbag/external/sm-core-css.min.css">
    <link rel="stylesheet"
        href="{{url('/')}}/frontend/bigbag/external/sm-clean.min.css">

    <!--venobox-->    
    <link rel="stylesheet" href="{{url('/')}}/frontend/bigbag/external/venobox.min.css">

    <!-- price slider-->    
    <link rel="stylesheet" href="{{url('/')}}/frontend/bigbag/external/ion.rangeSlider.min.css">

    <!-- Style css -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/bigbag/css/style.css">

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/bigbag/css/rtl.css">
     @endif
   @yield('extra-js')
 
   {{ load_header() }}
    <style type="text/css">
          .hidden
          {
            display: none;
          }
          .cart-options
          {
            cursor: pointer;
          }
      </style>
      <link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{url('/')}}/frontend/bigbag/font-awesome.min.css">


<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6038b8a36d01a000119a0ab4&product=inline-share-buttons" async="async"></script>
 <script type="text/javascript">
        $('.home-slider').slick({
    nav:true,
    dots:true,
autoplay: true
  })
    </script>

      @stack('style')

@if(app()->getLocale() == 'ar')
              <style type="text/css">
                .accountDetails .media {
    padding: 20px;
    margin-right: 21%;

}
              </style>
              @else

              <style type="text/css">
                .accountDetails .media {
    padding: 20px;
  margin-left: 18%;

}
              </style >

  @endif

</head>

<body style="font-family: 'Tajawal', sans-serif;" >

    
      @php
  $user_id = domain_info('user_id');
 
                                    
      if(App\Useroption::where('user_id',$user_id)->where('key','currency')->first())
      {
         $currency=App\Useroption::where('key','currency')->where('user_id',$user_id)->first();
      }
         
      $currency=json_decode($currency->value ?? '');
@endphp

 