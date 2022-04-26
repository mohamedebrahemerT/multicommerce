<!DOCTYPE html>
<html lang="{{isset($locale) ? $locale : 'en'}}">

<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="Beautyspa " />
	<meta property="og:title" content="Beautyspa" />
	<meta property="og:description" content="Beautyspa " />
	<meta property="og:image" content="Beautyspa " />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON -->
	<link rel="icon" href="{{ asset('frontend/beauty/images/favicon.ico') }}" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/beauty/images/favicon.png') }}" />
	
	<!-- PAGE TITLE HERE -->
	<title>Beautyspa  </title>
	
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	

	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/beauty/css/plugins.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/beauty/css/style.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/beauty/css/templete.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/beauty/css/style.css') }}">
	@if(isset($locale) && $locale == 'ar')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/beauty/css/rtl.css') }}">
	@endif
	<link class="skin" rel="stylesheet" type="text/css" href="{{ asset('frontend/beauty/css/skin/skin-3.css') }}">
	<!-- Revolution Slider Css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/beauty/plugins/revolution/revolution/css/layers.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/beauty/plugins/revolution/revolution/css/settings.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/beauty/plugins/revolution/revolution/css/navigation.css') }}">
	<link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300&display=swap" rel="stylesheet">
	<!-- Revolution Navigation Style -->
  
    @stack('css')
    <title>My Kart</title>

   

</head>
<body id="bg" dir="{{isset($locale) && $locale == 'ar' ? 'rtl' : 'ltr'}}" style="font-family: 'Tajawal', sans-serif;">
<div id="loading-area"></div>
<div class="page-wraper">
    @include('frontend/beauty/layouts/header')
    @include('frontend/beauty/layouts/message')
    @yield('content')
    @yield('external-footer')
    @include('frontend/beauty/layouts/footer')
    @yield('modal')
</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="{{ asset('frontend/beauty/js/jquery.min.js')}}"></script><!-- JQUERY.MIN JS -->
<script src="{{ asset('frontend/beauty/plugins/wow/wow.js')}}"></script><!-- WOW JS -->
<script src="{{ asset('frontend/beauty/plugins/bootstrap/js/popper.min.js')}}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('frontend/beauty/plugins/bootstrap/js/bootstrap.min.js')}}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{ asset('frontend/beauty/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script><!-- FORM JS -->
<script src="{{ asset('frontend/beauty/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script><!-- FORM JS -->
<script src="{{ asset('frontend/beauty/plugins/magnific-popup/magnific-popup.js')}}"></script><!-- MAGNIFIC POPUP JS -->
<script src="{{ asset('frontend/beauty/plugins/counter/waypoints-min.js')}}"></script><!-- WAYPOINTS JS -->
<script src="{{ asset('frontend/beauty/plugins/counter/counterup.min.js')}}"></script><!-- COUNTERUP JS -->
<script src="{{ asset('frontend/beauty/plugins/imagesloaded/imagesloaded.js')}}"></script><!-- IMAGESLOADED -->
<script src="{{ asset('frontend/beauty/plugins/masonry/masonry-3.1.4.js')}}"></script><!-- MASONRY -->
<script src="{{ asset('frontend/beauty/plugins/masonry/masonry.filter.js')}}"></script><!-- MASONRY -->
<script src="{{ asset('frontend/beauty/plugins/owl-carousel/owl.carousel.js')}}"></script><!-- OWL SLIDER -->
<script src="{{ asset('frontend/beauty/plugins/rangeslider/rangeslider.js')}}" ></script><!-- Rangeslider -->
<script src="{{ asset('frontend/beauty/plugins/lightgallery/js/lightgallery-all.js')}}"></script><!-- LIGHT GALLERY -->
<script src="{{ asset('frontend/beauty/js/custom.min.js')}}"></script><!-- CUSTOM FUCTIONS  -->
<script src="{{ asset('frontend/beauty/js/dz.carousel.min.js')}}"></script><!-- SORTCODE FUCTIONS  -->
<script src="{{ asset('frontend/beauty/js/dz.ajax.js')}}"></script><!-- CONTACT JS  -->
 <!-- revolution JS FILES -->
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<!-- Slider revolution 5.0 Extensions   -->
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{ asset('frontend/beauty/plugins/revolution/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{ asset('frontend/beauty/js/rev.slider.js')}}"></script>
<script>
jQuery(document).ready(function() {
	'use strict';
	dz_rev_slider_6();
});	/*ready*/
</script>
@stack('js')

<!-- notify bootstrap-->
    <script src="{{url('/')}}/frontend/bigbag/js/bootstrap-notify.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




     
    
 
    
<script type="text/javascript">
            $('.branch').on('change',function() {

                 var id = $(this).val();
                 
 
                    
        $.ajax({
            url:"{{ url('/beauty/branch') }}",
            method:"get",
           data :{
            
            id:id,

           },
            dataType:"json",
            beforeSend:function(){
                      
            },
            success:function(data)
            {
    //window.location.href = '{{ url("user/orders/pending") }}'
          location.reload(); 
             
              

            }
        });
             return false;
    
                  
  
   

});
        </script>





</body>

</html>
