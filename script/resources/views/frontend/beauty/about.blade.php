   
@extends('frontend.beauty.layouts.app')

@section('content')


 
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary" style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('About Us')}} </h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
														<li><a href="{{url('/')}}">{{__('Home')}} </a></li>

							<li>{{__('About Us')}}</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
		
		<div class="section-full bg-white content-inner-2 spa-about-bx">
			<div class="container">
				<div class="row d-flex align-item wow slideInUps-center">
					<div class="col-lg-6 col-md-6  wow slideInLeft">
						<div class="spa-bx-img">
							  @php
  $user_id = domain_info('user_id');
 @endphp
							<img src="{{url('/')}}/uploads/{{$user_id}}/about_photo.png">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 spa-about-content wow slideInRight">
						<h2>{{__('About us')}} </h2>
						<p>
							 
                                    

            

            



            @if(Session::get('locale') == 'ar')  

                 @if(App\Useroption::where('user_id',$user_id)->where('key','about_ar')->first())

                              {!! $about_ar= App\Useroption::where('user_id',$user_id)->where('key','about_ar')->first()->value !!}
            @endif

            @else

            @if(App\Useroption::where('user_id',$user_id)->where('key','about_en')->first())

                              {!! $about_en= App\Useroption::where('user_id',$user_id)->where('key','about_en')->first()->value !!}
            @endif

            @endif
                      
						</p>
						 
					</div>
				</div>
			</div>
		</div>
        <!-- inner page banner END -->
	
		<!-- Why Chose Us -->
		
		<!-- Our Professional Team -->
		<div class="section-full bg-white content-inner">
			<div class="container">
				<div class="section-head text-black text-center wow slideInDown">
					<h2 class="text-primary m-b10">{{__('Our Professional Team')}}</h2>
					<div class="dlab-separator-outer m-b0">
						<div class="dlab-separator text-primary style-icon"><i class="flaticon-spa text-primary"></i></div>
					</div>
					<!--p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the.</p -->
				</div>
				<div class="row">
					@foreach($employees as $employee)

					<div class="col-lg-3 col-md-6 col-sm-6 m-b30">
						<div class="service-box text-center wow zoomIn">
							<div class="service-images m-b15">
								<img src="{{ asset($employee->image)}}" alt=""/>
							</div>
							<div class="service-content">
								<h6 class="text-uppercase"><a href="#" class="text-primary">{{$employee->name}}</a></h6>
								<!--p class="m-b0">It is a long established fact that a reader will be distracted by the readable content of a page.</p-->
							</div>
						</div>
					</div>
					@endforeach

					       
				 
					 
				</div>
			</div>
		</div>
		<!-- Our Professional Team -->
		<!-- Testimonials Of Our Clients -->
		<!--div class="section-full content-inner" style="background-image:url({{asset('frontend/beauty/images/background/bg4.jpg')}}); background-position: bottom; background-size:cover;">
			<div class="container">
				<div class="section-head text-black text-center wow slideInDown wow slideInDown">
					<h2 class="text-primary m-b10">Testimonials Of Our Clients</h2>
					<div class="dlab-separator-outer m-b0">
						<div class="dlab-separator text-primary style-icon"><i class="flaticon-spa text-primary"></i></div>
					</div>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the.</p>
				</div>
				<div class="testimonial-two-dots owl-carousel owl-theme owl-dots-primary-full owl-btn-center-lr owl-btn-3 wow slideInDown">
					<div class="item p-a5">
						<div class="testimonial-9">
							<div class="testimonial-pic radius style1"><img src="{{ asset('frontend/beauty/images/testimonials/pic1.jpg') }}" width="100" height="100" alt=""></div>
							<div class="testimonial-text">
								<p>BeautyZone was extremely creative and forward thinking. They are also very quick and efficient when executing changes for us.</p>
							</div>
							<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
						</div>
					</div>
					<div class="item p-a5">
						<div class="testimonial-9">
							<div class="testimonial-pic radius style1"><img src="{{ asset('frontend/beauty/images/testimonials/pic2.jpg') }}" width="100" height="100" alt=""></div>
							<div class="testimonial-text">
								<p>BeautyZone was extremely creative and forward thinking. They are also very quick and efficient when executing changes for us.</p>
							</div>
							<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
						</div>
					</div>
					<div class="item p-a5">
						<div class="testimonial-9">
							<div class="testimonial-pic radius style1"><img src="{{ asset('frontend/beauty/images/testimonials/pic3.jpg') }}" width="100" height="100" alt=""></div>
							<div class="testimonial-text">
								<p>I think it is awesome and I can't thank you enough for working so closely with me. The entire team has been great to work.</p>
							</div>
							<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
						</div>
					</div>
					<div class="item p-a5">
						<div class="testimonial-9">
							<div class="testimonial-pic radius style1"><img src="{{ asset('frontend/beauty/images/testimonials/pic1.jpg') }}" width="100" height="100" alt=""></div>
							<div class="testimonial-text">
								<p>BeautyZone was extremely creative and forward thinking. They are also very quick and efficient when executing changes for us.</p>
							</div>
							<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
						</div>
					</div>
					<div class="item p-a5">
						<div class="testimonial-9">
							<div class="testimonial-pic radius style1"><img src="{{ asset('frontend/beauty/images/testimonials/pic2.jpg') }}" width="100" height="100" alt=""></div>
							<div class="testimonial-text">
								<p>BeautyZone was extremely creative and forward thinking. They are also very quick and efficient when executing changes for us.</p>
							</div>
							<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
						</div>
					</div>
					<div class="item p-a5">
						<div class="testimonial-9">
							<div class="testimonial-pic radius style1"><img src="{{ asset('frontend/beauty/images/testimonials/pic3.jpg') }}" width="100" height="100" alt=""></div>
							<div class="testimonial-text">
								<p>I think it is awesome and I can't thank you enough for working so closely with me. The entire team has been great to work.</p>
							</div>
							<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
						</div>
					</div>
					<div class="item p-a5">
						<div class="testimonial-9">
							<div class="testimonial-pic radius style1"><img src="{{ asset('frontend/beauty/images/testimonials/pic1.jpg') }}" width="100" height="100" alt=""></div>
							<div class="testimonial-text">
								<p>BeautyZone was extremely creative and forward thinking. They are also very quick and efficient when executing changes for us.</p>
							</div>
							<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
						</div>
					</div>
					<div class="item p-a5">
						<div class="testimonial-9">
							<div class="testimonial-pic radius style1"><img src="{{ asset('frontend/beauty/images/testimonials/pic2.jpg') }}" width="100" height="100" alt=""></div>
							<div class="testimonial-text">
								<p>BeautyZone was extremely creative and forward thinking. They are also very quick and efficient when executing changes for us.</p>
							</div>
							<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
						</div>
					</div>
					<div class="item p-a5">
						<div class="testimonial-9">
							<div class="testimonial-pic radius style1"><img src="{{ asset('frontend/beauty/images/testimonials/pic3.jpg') }}" width="100" height="100" alt=""></div>
							<div class="testimonial-text">
								<p>I think it is awesome and I can't thank you enough for working so closely with me. The entire team has been great to work.</p>
							</div>
							<div class="testimonial-detail"> <strong class="testimonial-name">David Matin</strong> <span class="testimonial-position">Student</span> </div>
						</div>
					</div>
				</div>
			</div>
		</div -->
		<!-- Testimonials Of Our Clients -->
			
        </div>
		<!-- contact area END -->
    </div>
    <!-- Content END-->
@endsection

@push('js')
   
@endpush
