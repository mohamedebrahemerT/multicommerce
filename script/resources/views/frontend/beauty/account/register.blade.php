@extends('frontend.beauty.layouts.app')
@section('content')

     <!-- Content -->
	 <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary bg-pt" style="background-image:url({{asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('beauty.register')}}</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="{{route('beauty.home')}}">{{__('beauty.home')}}</a></li>
							<li>{{__('beauty.register')}}</li>
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
						<h3 class="font-weight-700 m-t0 m-b20">{{__('beauty.createAnAccount')}}</h3>
					</div>
				</div>
                <div class="row">
					<div class="col-md-12 m-b30">
						<div class="p-a30 border-1  max-w500 m-auto">
							<div class="tab-content">
								<form action="{{route('beauty.register_user')}}" method="post" id="login" class="tab-pane active">
									@csrf
									@if ($errors->any())
                                        <div class="alert alert-danger">
                                          <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                          </ul>
                                        </div>
                                        @endif
                                        @if(Session::has('user_limit'))
                                        <div class="alert alert-danger">
											<ul>
												
												<li>{{ Session::get('user_limit') }}</li>
												
											</ul>
										</div>
                                    @endif
									<h4 class="font-weight-700">{{__('beauty.PERSONALINFORMATION')}}</h4>
									<p class="font-weight-600">{{__('beauty.dontHaveAccount')}}</p>
									<div class="form-group">
										<label class="font-weight-700">{{__('beauty.name')}} *</label>
										<input name="name" required="" class="form-control" placeholder="{{__('beauty.name')}}" type="text" value="{{old('name')}}">
									</div>
								 
									<div class="form-group">
										<label class="font-weight-700">{{__('beauty.Email')}} *</label>
										<input name="email" required="" class="form-control" placeholder="{{__('beauty.Email')}}" type="email" value="{{old('email')}}">
									</div>
								
									<div class="form-group">
										<label class="font-weight-700">{{__('beauty.password')}} *</label>
										<input name="password" required="" class="form-control " placeholder="{{__('beauty.password')}}" type="password">
									</div>
									<div class="text-left">
										<button class="site-button button-lg radius-no outline outline-2">{{__('beauty.create')}}</button>
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
