@extends('frontend.beauty.layouts.app')
@section('content')

     <!-- Content -->
     <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary bg-pt" style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg') }});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('beauty.login')}}</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="{{route('beauty.home')}}">{{__('beauty.home')}}</a></li>
							<li>{{__('beauty.login')}}</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
					<div class="col-md-12 text-center">
						<h3 class="font-weight-700 m-t0 m-b20">{{__('beauty.loginYourAccount')}}</h3>
					</div>
				</div>
                <div>
					<div class="max-w500 m-auto m-b30">
						<div class="p-a30 border-1 seth">
							<div class="tab-content nav">
								<form id="login" action="{{route('beauty.login_post')}}" method="post" class="tab-pane active col-12 p-a0 ">
									@csrf
									@method('POST')
									@if ($errors->any())
                                        <div class="alert alert-danger">
                                          <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                          </ul>
                                        </div>
									@endif
									
									@if(Session::has('error'))
                                        <div class="alert alert-danger">
											<ul>
												<li>{{ Session::get('error') }}</li>
											</ul>
										</div>
                                    @endif
									<h4 class="font-weight-700">{{__('beauty.LOGIN')}}</h4>
									<p class="font-weight-600">{{__('beauty.dontHaveAccount')}}.</p>
									<div class="form-group">
										<label class="font-weight-700">{{__('beauty.Email')}} *</label>
										<input name="email" required="" class="form-control" placeholder="{{__('beauty.email')}}" type="email" old="{{old('email')}}">
									</div>
									<div class="form-group">
										<label class="font-weight-700">{{__('beauty.password')}} *</label>
										<input name="password" required="" class="form-control " placeholder="{{__('beauty.password')}}" type="password" >
									</div>
									<div class="text-left">
										<button type="submit" class="site-button m-r5 button-lg radius-no">{{__('beauty.login')}}</button>
										<a data-toggle="tab" href="#forgot-password" class="m-l5"><i class="fa fa-unlock-alt"></i> {{__('beauty.ForgotPassword')}}</a> 
									</div>
								</form>
								<form id="forgot-password" class="tab-pane fade  col-12 p-a0">
									<h4 class="font-weight-700"> {{__('beauty.ForgotPassword?')}} </h4>
									<p class="font-weight-600">{{__('beauty.WeWillSendEmail')}}. </p>
									<div class="form-group">
										<label class="font-weight-700">{{__('beauty.Email')}} *</label>
										<input name="email" required="" class="form-control" placeholder="{{__('beauty.Email')}}" type="email">
									</div>
									<div class="text-left"> 
										<a class="site-button outline gray button-lg radius-no" data-toggle="tab" href="#login">{{__('beauty.Back')}}</a>
										<button class="site-button pull-right button-lg radius-no">{{__('beauty.login')}}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- Product END -->
		</div>
		
    </div>
 
@endsection
