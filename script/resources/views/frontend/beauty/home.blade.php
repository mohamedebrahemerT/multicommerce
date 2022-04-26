@extends('frontend.beauty.layouts.app')

@section('content')
    
    <!-- Content -->
    <div class="page-content">
		<!-- Main Slider -->
        <div class="rev-slider">
			<div id="rev_slider_265_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container errow-style-1" data-alias="" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
			<!-- START REVOLUTION SLIDER 5.4.6.3 fullwidth mode -->
			<div id="rev_slider_265_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.6.3">
				<ul>  <!-- SLIDE  -->
					@foreach($sliders as $key => $slider)
					<li data-index="rs-{{$key}}00" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="{{  asset($slider['slider'])}}" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img style="width:1920px;height:627px"  src="{{ asset($slider['slider'])}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina   >
						<div class="tp-caption tp-shape tp-shapewrapper bg-primary tp-resizeme" 
							id="slide-100-layer-1" 
							data-x="['left','left','center','center']" data-hoffset="['30','30','0','0']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['-1','-1','0','0']" 
							data-width="100"
							data-height="5"
							data-visibility="['on','on','off','off']"
							data-whitespace="nowrap"
							data-type="shape" 
							data-responsive_offset="off"
							data-frames='[{"from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;","ease":"Power2.easeInOut"}]'
							data-textAlign="['left','left','left','left']"
							data-paddingtop="[0,0,0,0]"
							data-paddingright="[0,0,0,0]"
							data-paddingbottom="[0,0,0,0]"
							data-paddingleft="[0,0,0,0]" style="z-index: 15;border-color:rgba(0, 0, 0, 0.50);border-width:0px; border-radius:2px;"> 
						</div>
						<div class="tp-caption tp-resizeme text-primary" 
							id="slide-100-layer-2" 
							data-x="['left','left','center','center']" data-hoffset="['30','30','0','0']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['-80','-80','-70','-60']"
							data-fontsize="['40','38','32','26']"
							data-lineheight="['80','60','60','40']"
							data-width="none"
							data-height="none"
							data-type="text" 
							data-responsive_offset="off"
							data-frames='[{"delay":"+500","split":"chars","splitdelay":0.05000000000000000277555756156289135105907917022705078125,"speed":2000,"split_direction":"forward","frame":"0","from":"opacity:0;","color":"#000000","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":2000,"frame":"999","color":"transparent","to":"opacity:0;","ease":"Power3.easeInOut"}]'
							data-textAlign="['inherit','inherit','inherit','inherit']"
							data-paddingtop="[0,0,0,0]"
							data-paddingright="[0,0,0,0]"
							data-paddingbottom="[0,0,0,0]"
							data-paddingleft="[0,0,0,0]"
							style="z-index: 7;  font-size: 35px; line-height: 80px; font-weight: 800; letter-spacing: 0px; font-family:Nunito;">{{json_decode($slider['meta'])->title}}
							
						</div>
						<!-- LAYER NR. 2 -->
						 
						<!-- LAYER NR. 6 -->
						<div class="tp-caption tp-resizeme" 
							id="slide-100-layer-5" 
							data-x="['left','left','center','center']" data-hoffset="['30','30','-85','-70']" 
							data-y="['middle','middle','middle','middle']" data-voffset="['200','200','50','50']"
							data-width="['auto']"
							data-height="['auto']"
							data-type="button" 
							data-actions=''
							data-responsive_offset="on" 
							data-frames=                   '[{"delay":2000,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"300","ease":"Power0.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0,0,0,1);bg:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]'
							data-textAlign="['inherit','inherit','inherit','inherit']"
							data-paddingtop="[0]"
							data-paddingright="[0]"
							data-paddingbottom="[0]"
							data-paddingleft="[0]"
							style="z-index: 10; white-space: nowrap; font-size: 16px; line-height: 30px; font-weight: 600; font-family:Montserrat;border-radius:3px 3px 3px 3px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none;">	<a href="{{$slider['url']}}" class="site-button button-md">{{json_decode($slider['meta'])->btn_text}}</a>
						</div>
					
					</li>
					@endforeach
				 

					 
				</ul>
				<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div> </div>
			</div>  
		</div>  
        <!-- Main Slider -->
		<!-- <div class="section-full bg-white content-inner-2 spa-about-bx">
                <div class="container">
					<div class="row d-flex align-item wow slideInUps-center">
						<div class="col-lg-6 col-md-6  wow slideInLeft">
							<div class="spa-bx-img">
								<img src="{{ asset('frontend/beauty/images/about/img4.jpg')}}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 spa-about-content wow slideInRight">
							<h2>Not Your <br>Everyday Spa</h2>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
							<a href="#" class="site-button radius-no button-effect1">Read More<span></span></a>
						</div>
					</div>
                </div>
		</div> -->
			<!-- contact area -->
        <div class="content-block" >
			<!-- Portfolio  -->
			<div class="section-full content-inner-2 portfolio-box">
				<div class="container">
					<div class="section-head text-black text-center wow slideInDown m-b20">
						<h2 class="text-primary m-b10">{{__('beauty.ourServices')}}</h2>
						<div class="dlab-separator-outer m-b0">
							<div class="dlab-separator text-primary style-icon"><i class="flaticon-spa text-primary"></i></div>
						</div>
						<p>{{__('beauty.ourServicesDesc')}}.</p>
					</div>
					<div class="site-filters style1 clearfix center">
						<ul class="filters" data-toggle="buttons">
							<li data-filter="" class="btn active"><input type="radio"><a href="#"><span>All</span></a></li>
							@foreach($categories as $category)
							@isset($category->id)
								<li data-filter="category_{{$category->id}}" class="btn"><input type="radio"><a href="#"><span>{{$category->name}}</span></a></li>
								@endisset
							@endforeach
							 
						</ul>
					</div>
					<div class="clearfix">
						<ul id="masonry" class="dlab-gallery-listing gallery-grid-4 gallery mfp-gallery sp10">
							@foreach($services as $service)
							<?php $class = '' ;?>
							@foreach($service->categories as $categ)
								<?php $class .= 'category_'.$categ->id.' ' ; ?>
							@endforeach
							<li class="{{$class}} design card-container col-lg-4  wow zoomIn col-md-4 col-sm-4 col-6">
								<div class="dlab-box dlab-gallery-box">
									<div class="dlab-media dlab-img-overlay1 dlab-img-effect"> 
										<a href="javascript:void(0);"> <img src="{{  $service->preview ? $service->preview->media->url : '' }}"  alt=""> </a>
										<div class="overlay-bx">
											<div class="overlay-icon"> 
												<a class="mfp-link" title="{{$service->title}}" href="{{$service->preview ? $service->preview->media->url : ''  }}"> <i class="ti-fullscreen"></i> </a>	
											</div>
										</div>
									</div>
								</div>
								<div class="price-tbl d-flex">
									<div class="flex-grow-1">
										<h4 class="text-primary">{{$service->title}}</h4>
										<p>{{$service->time_required}} {{__('beauty.MinuteSession')}} </p>
									</div>
									<div class="price-val align-self-center">
										<h3 class="text-secondry">{{$service->price ? $service->price->price : ''}}</h3>
										<span class="input-group-btn">
											<button id="add_to_cart" name="submit" value="Submit" type="submit" class="site-button radius-xl"><i class="ti-shopping-cart"></i> <span  style="display: none;">{{ $service->id }}</span>{{__('beauty.add')}}</button>
										</span>
									</div>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
					</div>
			</div>
        </div>
		<!-- contact area END -->
	
		
		<!-- Our Services -->
		<!-- <div class="section-full content-inner-3 services-box bg-pink-light" style="background-image:url({{ asset('frontend/beauty/images/background/bg5.jpg')}}); background-position: bottom; background-size: 100%; background-repeat: no-repeat;">
			<div class="container">
				<div class="section-head text-black text-center wow slideInDown">
					<h2 class="text-primary m-b10">Why choose Us</h2>
					<h6 class="m-b10">You Will Like To Look Like Goddes Every Day!</h6>
					<div class="dlab-separator-outer m-b0">
						<div class="dlab-separator text-primary style-icon"><i class="flaticon-spa text-primary"></i></div>
					</div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the.</p>
				</div>
				<div class="row">
			
					<div class="col-lg-3 col-md-6 col-sm-6 m-b30">
						<div class="icon-bx-wraper wow slideInUp p-lr15 p-b30 p-t20 bg-white center fly-box-ho">
							<div class="icon-lg m-b10"> <span class="icon-cell text-primary"><i class="flaticon-woman"></i></span> </div>
							<div class="icon-content">
								<h6 class="dlab-tilte">We are Professional</h6>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
								<a href="#" class="site-button-secondry">Site Button</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 m-b30">
						<div class="icon-bx-wraper wow slideInUp p-lr15 p-b30 p-t20 bg-white center fly-box-ho">
							<div class="icon-lg m-b10"><span class="icon-cell text-primary"><i class="flaticon-mortar"></i></span> </div>
							<div class="icon-content">
								<h6 class="dlab-tilte">Lux Cosmetic</h6>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
								<a href="#" class="site-button-secondry">Site Button</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 m-b30">
						<div class="icon-bx-wraper wow slideInUp p-lr15 p-b30 p-t20 bg-white center fly-box-ho">
							<div class="icon-lg m-b10"> <span class="icon-cell text-primary"><i class="flaticon-candle"></i></span> </div>
							<div class="icon-content">
								<h6 class="dlab-tilte">Medical Education</h6>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
								<a href="#" class="site-button-secondry">Site Button</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 m-b10">
						<div class="icon-bx-wraper wow slideInUp p-lr15 p-b30 p-t20 bg-white center fly-box-ho">
							<div class="icon-lg m-b10"> <span class="icon-cell text-primary"><i class="flaticon-sauna-1"></i></span> </div>
							<div class="icon-content">
								<h6 class="dlab-tilte">The Newest Equipment</h6>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
								<a href="#" class="site-button-secondry">Site Button</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- Our Services -->
		

		<!-- Our Professional Team -->
		<div id="OurTeam" class="section-full content-inner-2 overlay-white-middle" style="background-image:url({{ asset('frontend/beauty/images/background/bg1.png')}}), url({{ asset('frontend/beauty/images/background/bg2.png')}}); background-position: bottom, top; background-size: 100%; background-repeat: no-repeat;">
			<div class="container">
				<div class="section-head text-black text-center wow slideInDown">
					<h2 class="text-primary m-b10">{{__('beauty.OurProfessionalTeam')}}</h2>
					<div class="dlab-separator-outer m-b0">
						<div class="dlab-separator text-primary style-icon"><i class="flaticon-spa text-primary"></i></div>
					</div>
					<p>{{__('beauty.OurProfessionalTeamDesc')}}</p>
				</div>
				<div class="team-carousel owl-carousel owl-carousel owl-btn-center-lr owl-btn-3 owl-theme owl-dots-primary-full owl-loaded owl-drag">
					@foreach($employees as $employee)
					<div class="item wow slideInUp">
						<div class="dlab-box text-center team-box">
							<div class="dlab-media"> <img width="300" height="300" src="{{ asset($employee->image)}}" alt=""></div>
							<div class="dlab-title-bx p-a10">
								<h5 class="text-black m-a0"><a href="#">{{$employee->name}}</a></h5>
								<!-- <span class="clearfix">Cosmetologist</span> -->
							</div>
						</div>
					</div>
					@endforeach
				
				</div>
			</div>
		</div>
		<!-- Our Professional Team End -->

    </div>
   
@endsection

 
 
@push('js')


<script type="text/javascript">
      $(document).on('click','#add_to_cart',function(){
              var text =$(this).text();
              text=text.toString();
                    var id= text;
                    

                      var xxxx= id;
var id = xxxx.substring(0, xxxx.length - 4);  

                     

        $.ajax({
            url:"{{url('/cart')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:text,
            qty:1,

           },
            dataType:"json",
            beforeSend:function(){
                      
                 $('.cart_sucess').html('');      
            },
            success:function(data)
            {
                  
                   

                
     $.notify("Added to cart", "success");
     $.notify("Added to cart", "info");
     $.notify("Added to cart", "warn");
      
                }
        });
             return false;
    
                 
    
                    
                     
                    });
  </script>
    
@endpush
