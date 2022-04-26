   
@extends('frontend.beauty.layouts.app')

@section('content')
   <!-- Content -->
   <div class="page-content bg-white">
		<!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr overlay-primary bg-pt" style="background-image:url({{asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('Contact Us') }}</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
						<li><a href="{{url('/')}}">{{__('Home')}} </a></li>
							<li>{{__('Contact Us')}}</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
		<!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
			<div class="container">
                <div class="row">
					<!-- right part start -->
					<div class="col-lg-4 col-md-6 d-flex">
                        <div class="p-a30 border m-b30 contact-area border-1 align-self-stretch ">
                       <?php $location = json_decode(getUserOptionWithKey('location')) ; ?>

							<h4 class="m-b10">{{__('How may we help you?')}}</h4>
							 
                            <ul class="no-margin">
                                <li class="icon-bx-wraper left m-b30">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="ti-location-pin"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dlab-tilte">{{__('address')}}:</h6>
                                        <p>
                                             @if($location && isset($location->address))
                              
                                 {{$location->address}} 
                                 {{$location->city ? ' - ' .$location->city : ''}}  
                                 {{$location->state ? ' - ' .$location->state : ''}}  
                                 {{$location->zip_code ? ' - ' .$location->zip_code : ''}} 
                               
                                @endif
                                        </p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left  m-b30">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="ti-email"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dlab-tilte">{{__('email')}}:</h6>
                                        <p>
                                            @if($location && isset($location->email))
                                {{$location->email}} 
                                @endif
                                        </p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="ti-mobile"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dlab-tilte">{{__('phone')}}</h6>
                                        <p>
                                            @if($location && isset($location->phone))
                                {{$location->phone}}
                                @endif
                                        </p>
                                    </div>
                                </li>
                            </ul>
							<div class="m-t20">


    @php
                $user_id = domain_info('user_id');
    $user_options = App\Useroption::where('user_id',$user_id)->where('key','socials')->count();
                 

                            @endphp

                             @if($user_options > 0)

                             								<ul class="dlab-social-icon dlab-social-icon-lg">
									 @foreach(json_decode(getUserOptionWithKey('socials')) as $social)
                                <li><a href="{{$social->url}}" class="site-button {{str_replace('fa fa-','',$social->icon) }} circle "><i class="{{$social->icon}}"></i></a></li>
                                @endforeach
								</ul>
                                @endif
                                
							</div>
                        </div>
                    </div>
                    <!-- right part END -->
                    <!-- Left part start -->
					<div class="col-lg-4 col-md-6 m-b30">
                        <div class="p-a30 bg-gray clearfix">
							<h4>{{__('Send Message Us')}}</h4>
							<div class="dzFormMsg"></div>
							<form     action="{{url('/')}}/sent-mail" method="post" >
                                @csrf
							<input type="hidden" value="Contact" name="dzToDo" >
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="name" type="text" required class="form-control" placeholder="{{__('Your Name')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group"> 
											    <input name="email" type="email" class="form-control" required  placeholder="{{__('Your Email')}} " >
                                            </div>
                                        </div>
                                    </div>

                                     
                                     <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea name="message" rows="4" class="form-control" required placeholder="{{__('Subject')}}"></textarea>
                                            </div>
                                        </div>
                                    </div>
									 
                                    <div class="col-lg-12">
                                        <button  name="submit" type="submit" value="Submit" class="site-button "> <span>{{__('Submit')}}</span> </button>
                                         
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Left part END -->
					<div class="col-lg-4 col-md-12 d-flex m-b30">
                         @php
  $user_id = domain_info('user_id');
if(App\Useroption::where('user_id',$user_id)->where('key','google_map_link')->first())
{ 
              $google_map_link= App\Useroption::where('user_id',$user_id)->where('key','google_map_link')->first()->value;
}
@endphp
                        <iframe src="@isset($google_map_link){{$google_map_link}}@endisset" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>					
                    </div>
                </div>
            </div>
        </div>
        <!-- contact area  END -->
    </div>
    <!-- Content END-->
   
@endsection

@push('js')
   
@endpush
