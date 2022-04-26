 <!-- header -->
 <header class="site-header header mo-left">
		
		<!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
		<div class="top-bar bg-primary text-white">
			<div class="container">
				<div class="row d-flex justify-content-between">
					<div class="dlab-topbar-left">
						  @php
  $user_id = domain_info('user_id');
 @endphp
						@php
						 $branches=App\Category::where('user_id',$user_id)->where('type','branches')->latest()->get();
						@endphp
						<ul>
							<li>

 

							<select class="branch">
		<option value="all" @if(Session('all')) selected @endif>{{__('all')}}</option>
		<br>
								 
                @foreach($branches as $branch)

								<option @if(Session('branch') == $branch->id) selected @endif value="{{ $branch->id  }}"> 

									@if(app()->getLocale() == 'ar')

                    {{ $branch->name_ar  }}
    @else
                    {{ $branch->name_en  }}

    @endif
</option> 
                @endforeach
               
								 
							</select>
							</li>
							@if(Auth::check())
                                 <li>
                                    <a href="{{ url('/user/dashboard') }}"> <span>{{ __('Account') }}</span></a>
                                 </li>
                                 <li>
                                    <a href="/" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fas fa-lock-open u-s-m-r-6"></i>
                                    <span>{{ __('beauty.logout') }}</span></a>
                                 </li>
                                 <form action="{{ route('beauty.logout') }}" method="POST" class="d-none" id="logout-form">
                                    @csrf
                                  </form>
                            @else
								 <li><a href="/user/login"> {{__('beauty.login')}}</a></li>
								<li> / </li><li><a href="/user/register"> {{__('beauty.register')}} </a></li>
                            @endif

							
							@isset($locale)
							<li><a href="{{$locale == 'en' ? route('beauty.make_local',['lang'=>'ar']) : route('beauty.make_local',['lang'=>'en'])}}">  {{$locale == 'en' ? 'العربية' : 'English' }}   </a></li>
							@endisset
						</ul>
					</div>
					<div class="dlab-topbar-right topbar-social">
						<ul>

							@php
				$user_id = domain_info('user_id');
	$user_options = App\Useroption::where('user_id',$user_id)->where('key','socials')->count();
				 

							@endphp

							 @if($user_options > 0)


							 
							 
                           @foreach(json_decode(getUserOptionWithKey('socials')) as $social)
								<li><a href="{{$social->url}}" class="site-button-link facebook hover"><i class="{{$social->icon}}"></i></a></li>
								@endforeach

								@endif

								 
 
								

							 
						</ul>
					</div>
				</div>
			</div>
		</div>
            <div class="main-bar clearfix ">
                <div class="container clearfix">
                    <!-- website logo -->
                    <div class="logo-header mostion">
						<a href="/" class="dez-page"><img src="{{ asset('frontend/beauty/images/logo-2.png')}}" alt=""></a>
					</div>
                    <!-- nav toggle button -->
                    <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="nav navbar-nav">	
							<li ><a href="/">{{__('beauty.home')}}</a>
									
							</li>
							<li><a href="/about">{{__('beauty.aboutUs')}} </a>
								
							</li>
							<li><a href="{{url('/')}}/team">{{__('beauty.ourTeam')}}</a>
								
							</li>
						
							
							<li><a href="{{url('/')}}/ourShop">{{__('beauty.ourShop')}} </a>
								
							</li>
							<li><a href="{{url('/')}}/contact">{{__('beauty.contact')}} </a>
								
							</li>
							<li><a href="{{url('/')}}/cart"><i class="ti-shopping-cart"></i></a></li>
							<li><a href="{{url('/')}}/wishlist"><i class="ti-heart"></i></a></li>
						</ul>		
                    </div>
					 
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->


