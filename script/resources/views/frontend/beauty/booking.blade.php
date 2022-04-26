<!DOCTYPE html>
<html lang="en">

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
	<link rel="icon" href="{{url('/')}}/frontend/beauty/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{url('/')}}/frontend/beauty/images/favicon.png" />
	
	<!-- PAGE TITLE HERE -->
	<title>Beautyspa  </title>
	
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- FAVICONS ICON -->
	<link rel="icon" href="{{url('/')}}/frontend/beauty/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{url('/')}}/frontend/beauty/images/favicon.png" />
	
	<!-- PAGE TITLE HERE -->
	<title>Beautyspa </title>
	
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


	<!---------------------------------------------->
	<link class="skin" rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/beauty/plugins/smartwizard/css/smart_wizard.css">
	<link rel="stylesheet" href="{{url('/')}}/frontend/beauty/plugins/datepicker/css/bootstrap-datetimepicker.min.css"/>

	 	<link class="skin" rel="stylesheet" type="text/css" href="{{url('/')}}/frontend/beauty/plugins/smartwizard/css/smart_wizard.css">
	<link rel="stylesheet" href="{{url('/')}}/frontend/beauty/plugins/datepicker/css/bootstrap-datetimepicker.min.css"/>


	<!------------------------------------------------->
 
	<!-- Revolution Navigation Style -->
</head>
<body id="bg" dir="{{isset($locale) && $locale == 'ar' ? 'rtl' : 'ltr'}}" style="font-family: 'Tajawal', sans-serif;">
<div id="loading-area"></div>
<div class="page-wraper">

    <!-- header -->
        @include('frontend/beauty/layouts/header')

    <!-- header END -->
   
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary bg-pt" style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('booking')}}</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="{{url('/')}}">{{__('Home')}}</a></li>
							<li>{{__('booking')}}</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
		<div class="content-block">
		<section class="ftco-section">
		<div class="container">
			
			<div class="row">
				<div class="col-md-12">
					<div class="content w-100">
				    <div class="calendar-container">
				      <div class="calendar"> 
				        <div class="year-header">
				          <form method="post"  action="{{url('/')}}/beauty/Add_Time"> 
				        @csrf    
				          <span class="left-button fa fa-chevron-left" id="prev"> </span> 
				          <span class="year" id="label"></span> 
				          <span class="right-button fa fa-chevron-right" id="next"> </span>
				        </div> 
				        <table class="months-table w-100"> 
				          <tbody>
				            <tr class="months-row">
				              <td class="month"> <label class="btn"> 
											<input name="month" type="radio" value="{{__('Jan')}}">  {{__('Jan')}}
										</label></td> 
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('Feb')}}">  {{__('Feb')}}
										</label> </td> 
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('Mar')}}">  {{__('Mar')}}
										</label> </td> 
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('Apr')}}">  {{__('Apr')}}
										</label> </td> 
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('May')}}">  {{__('May')}}
										</label> </td> 
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('May')}}">  {{__('Jun')}}
										</label>  </td> 
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('May')}}">  {{__('Jul')}}
										</label>  </td>
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('Aug')}}">  {{__('Aug')}}
										</label> </td> 
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('Sep')}}">  {{__('Sep')}}
										</label> </td> 
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('Oct')}}">  {{__('Oct')}}
										</label>  </td>          
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('Nov')}}">  {{__('Nov')}}
										</label>  </td>
				              <td class="month"><label class="btn"> 
											<input name="month" type="radio" value="{{__('Nov')}}">  {{__('Dec')}}
										</label> </td>
				            </tr>
				          </tbody>
				        </table> 
				        
				        <table class="days-table w-100"> 
				          <td class="day"><label class="btn"> 
											<input  name="day" type="radio" value="{{__('Sun')}}"> <span class="day">{{__('Sun')}} </span> 
										</label>  </td> 
				          <td class="day"><label class="btn"> 
											<input name="day" type="radio" value="{{__('Mon')}}"> <span class="day"> {{__('Mon')}}</span>
										</label>  </td> 
				          <td class="day"><label class="btn"> 
											<input name="day" type="radio" value="{{__('Tue')}}">  {{__('Tue')}}
										</label>  </td> 
				          <td class="day"><label class="btn"> 
											<input name="day" type="radio" value="{{__('Wed')}}"> <span class="day"> {{__('Wed')}}</span>
										</label>  </td> 
				          <td class="day"><label class="btn"> 
											<input name="day" type="radio" value="{{__('Thu')}}"><span class="day">  {{__('Thu')}} </span>
										</label> </td> 
				          <td class="day"><label class="btn"> 
											<input name="day" type="radio" value="{{__('Fri')}}"> <span class="day"> {{__('Fri')}} </span>
										</label>  </td> 
				          <td class="day"><span class="day">{{__('Sat')}}</span></td>
				        </table> 
				        <div class="frame"> 
				          <table class="dates-table w-100"> 
			              <tbody class="tbody">             
			              </tbody> 
				          </table>
				        </div> 
				        <a class="button" id="add-button" style="color:#fff">{{__('Add Time')}}</a>
				      </div>
				    </div>
				   
				    <div class="dialog" id="dialog">
				        <h2 class="dialog-header"> {{__('Add Time')}} </h2>
				      
				       	<div class="book-time row">
									<div class="btn-group d-flex flex-column m-b10 col-lg-4 col-md-4 col-sm-4 col-4" data-toggle="buttons">
										
										<label class="btn"> 9:00 pm
											<input name="time" type="checkbox" value="9:00 pm"> 
										</label>
										<label class="btn"> 10:00 pm
											<input name="time" type="checkbox" value="10:00 pm"> 
										</label>
										<label class="btn">
											<input name="time" type="checkbox" value="11:00 pm"> 11:00 pm
										</label>
										<label class="btn">
											<input name="time" type="checkbox" value="12:00 pm"> 12:00 pm
										</label>
										 
									
										
									</div>
									<div class="btn-group d-flex flex-column m-b10 col-lg-4 col-md-4 col-sm-4 col-4" data-toggle="buttons">
										
										<label class="btn"> 9:00 pm
											<input name="time" type="checkbox" value="9:00 pm"> 
										</label>
										<label class="btn active"> 10:00 pm
											<input name="time" type="checkbox" value="10:00 pm"> 
										</label>
										<label class="btn">
											<input name="time" type="checkbox" value="11:00 pm"> 
										</label>
										<label class="btn"> 12:00 pm
											<input name="time" type="checkbox" value="12:00 pm"> 
										</label>
										
										
									
									</div>
									<div class="btn-group d-flex flex-column m-b10 col-lg-4 col-md-4 col-sm-4 col-4" data-toggle="buttons">
										
										
										<label class="btn">
											<input name="time" type="checkbox" value="2:00 pm"> 2:00 pm
										</label>
										<label class="btn"> 3:00 pm
											<input name="time" type="checkbox"  value="3:00 pm"> 
										</label>
										<label class="btn"> 4:00 pm
											<input name="time" type="checkbox" value="4:00 pm"> 
										</label>
										
									</div>
									
								</div>
								<div class="pull-right">
								<button   class="site-button radius-no button-effect1 pull-right"
                                   type="submit"  
								>{{__('Go to checkout')}}</button>
								</form>
								</div>
				      </div>
				  </div>
				</div>
			</div>
		</div>
	</section>

          
    </div>
    <!-- Content END-->

	<!-- Footer -->
        @include('frontend/beauty/layouts/footer')

    <!-- Footer END-->
    <button class="scroltop fa fa-chevron-up" ></button>
</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="{{url('/')}}/frontend/beauty/js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="{{url('/')}}/frontend/beauty/js/main.js"></script><!-- JQUERY.MIN JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/wow/wow.js"></script><!-- WOW JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/bootstrap/js/popper.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/bootstrap/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/bootstrap-select/bootstrap-select.min.js"></script><!-- FORM JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
<script src="{{url('/')}}/frontend/beauty/plugins/masonry/masonry-3.1.4.js"></script><!-- MASONRY -->
<script src="{{url('/')}}/frontend/beauty/plugins/masonry/masonry.filter.js"></script><!-- MASONRY -->
<script src="{{url('/')}}/frontend/beauty/plugins/owl-carousel/owl.carousel.js"></script><!-- OWL SLIDER -->
<script src="{{url('/')}}/frontend/beauty/plugins/rangeslider/rangeslider.js" ></script><!-- Rangeslider -->
<script src="{{url('/')}}/frontend/beauty/js/custom.min.js"></script><!-- CUSTOM FUCTIONS  -->
<script src="{{url('/')}}/frontend/beauty/js/dz.carousel.min.js"></script><!-- SORTCODE FUCTIONS  -->
<script src="{{url('/')}}/frontend/beauty/js/dz.ajax.js"></script><!-- CONTACT JS  -->

<script src="{{url('/')}}/frontend/beauty/plugins/datepicker/js/moment.js"></script><!-- DATEPICKER JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/datepicker/js/bootstrap-datetimepicker.min.js"></script><!-- DATEPICKER JS -->
<script src="{{url('/')}}/frontend/beauty/plugins/smartwizard/js/jquery.smartWizard.js"></script>
<script>
	$(document).ready(function(){

		// Step show event
		$("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
		   //alert("You are on step "+stepNumber+" now");
		   if(stepPosition === 'first'){
			   $("#prev-btn").addClass('disabled');
		   }else if(stepPosition === 'final'){
			   $("#next-btn").addClass('disabled');
		   }else{
			   $("#prev-btn").removeClass('disabled');
			   $("#next-btn").removeClass('disabled');
		   }
		});

		// Toolbar extra buttons
		var btnFinish = $('<button></button>').text('Finish')
										 .addClass('btn btn-info')
										 .on('click', function(){ alert('Finish Clicked'); });
		var btnCancel = $('<button></button>').text('Cancel')
										 .addClass('btn btn-danger')
										 .on('click', function(){ $('#smartwizard').smartWizard("reset"); });


		// Smart Wizard
		$('#smartwizard').smartWizard({
				selected: 0,
				theme: 'default',
				transitionEffect:'fade',
				showStepURLhash: true,
				toolbarSettings: {toolbarPosition: 'both',
								  toolbarButtonPosition: 'end',
								  toolbarExtraButtons: [btnFinish, btnCancel]
								}
		});


		// External Button Events
		$("#reset-btn").on("click", function() {
			// Reset wizard
			$('#smartwizard').smartWizard("reset");
			return true;
		});

		$("#prev-btn").on("click", function() {
			// Navigate previous
			$('#smartwizard').smartWizard("prev");
			return true;
		});

		$("#next-btn").on("click", function() {
			// Navigate next
			$('#smartwizard').smartWizard("next");
			return true;
		});

		$("#theme_selector").on("change", function() {
			// Change theme
			$('#smartwizard').smartWizard("theme", $(this).val());
			return true;
		});

		// Set selected theme on page refresh
		$("#theme_selector").change();
	});
</script>
<script>
jQuery(document).ready(function() {
	$('#datetimepicker4').datetimepicker();
});	
</script>
</body>

</html>
