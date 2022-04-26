	<!-- Footer -->
    <footer class="site-footer text-uppercase footer-white">
		
        <div class="footer-top">
            <div class="container wow fadeIn" data-wow-delay="0.5s">
                <div class="row">
					<div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-5">
                        <div class="widget widget_services border-0">
                            <h6 class="m-b20">{{__('beauty.company')}}</h6>
                            <ul>
                                <li><a href="{{route('beauty.home')}}">{{__('beauty.home')}} </a></li>
                                <li><a href="{{route('beauty.about')}}">{{__('beauty.aboutUs')}} </a></li>
                                <li><a href="{{url('/')}}/beauty/team">{{__('beauty.ourTeam')}}</a></li>
                                <li><a href="booking.html">{{__('beauty.booking')}}</a></li>
                                <li><a href="{{route('beauty.contact')}}">{{__('beauty.contactUs')}}</a></li>
                            </ul>
                        </div>
                    </div>
					<div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-7">
                        <div class="widget widget_services border-0">
                            <h6 class="m-b20">{{__('beauty.usefulLinks')}}</h6>
                            <ul>
                               <li><a href="{{url('/')}}/beauty/shop">{{__('beauty.shop')}} </a></li>
                                <li><a href="{{route('beauty.cart')}}">{{__('beauty.cart')}}</a></li>
                                <li><a href="{{route('beauty.login')}}">{{__('beauty.login')}}</a></li>
                                <li><a href="{{route('beauty.register')}}">{{__('beauty.register')}}</a></li>
                            </ul>
                        </div>
                    </div>
					<div class="col-xl-4 col-lg-4  wow zoomIn col-md-6 col-sm-5">
                        <div class="widget widget_getintuch">
                            <h6 class="m-b30">{{__('beauty.contactUs')}}</h6>
                            <ul>


                                <?php $location = json_decode(getUserOptionWithKey('location')) ; ?>
                                @if($location && isset($location->address))
                                <li><i class="ti-location-pin"></i><strong>{{__('beauty.address')}}</strong>
                                 {{$location->address}} 
                                 {{$location->city ? ' - ' .$location->city : ''}}  
                                 {{$location->state ? ' - ' .$location->state : ''}}  
                                 {{$location->zip_code ? ' - ' .$location->zip_code : ''}} 
                                </li>
                                @endif
                                @if($location && isset($location->phone))
                                <li><i class="ti-mobile"></i><strong>{{__('beauty.phone')}}</strong>{{$location->phone}}</li>
                                @endif
                                @if($location && isset($location->email))
								<li><i class="ti-email"></i><strong>{{__('beauty.email')}}</strong>{{$location->email}}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4  wow zoomIn col-md-12 col-sm-12">
                        <div class="widget">
                            <h6 class="m-b30">{{__('beauty.SubscribeTitle')}}</h6>
							<p class="text-capitalize m-b20">{{__('beauty.SubscribeDesc')}}</p>
                            <!-- <div class="subscribe-form m-b20">
								<form class="dzSubscribe" action="" method="post">
									<div class="dzSubscribeMsg"></div>
									<div class="input-group">
										<input name="dzEmail" required="required"  class="form-control" placeholder="Your Email Address" type="email">
										<span class="input-group-btn">
											<button name="submit" value="Submit" type="submit" class="site-button radius-xl">Subscribe</button>
										</span> 
									</div>
								</form>
							</div> -->
							<ul class="list-inline m-a0">
                                @php
                $user_id = domain_info('user_id');
    $user_options = App\Useroption::where('user_id',$user_id)->where('key','socials')->count();
                 

                            @endphp
                                                         @if($user_options > 0)


                                @foreach(json_decode(getUserOptionWithKey('socials')) as $social)
								<li><a href="{{$social->url}}" class="site-button {{str_replace('fa fa-','',$social->icon) }} circle "><i class="{{$social->icon}}"></i></a></li>
								@endforeach

                                                            @endif

                                
                             
							</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer bottom part -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                   <div class="col-lg-6 col-md-6 col-sm-6 text-center text-md-left"> <span>{!! __('beauty.copyRight') !!}</span> </div>
                   <div class="col-lg-6 col-md-6 col-sm-6 text-center text-md-right ">  
						<div class="widget-link "> 
							<ul>
								<li><a href="#"> {{__('beauty.helpDesk')}}</a></li> 
								<li><a href="#"> {{__('beauty.privacyPolicy')}}</a></li> 
							</ul>
						</div>
					</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END-->
    <button class="scroltop fa fa-chevron-up" ></button>