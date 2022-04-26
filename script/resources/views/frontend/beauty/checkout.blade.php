@extends('frontend.beauty.layouts.app')

@section('content')
  <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary bg-pt" style="background-image:url(images/banner/bnr1.jpg);">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('Checkout')}}</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="{{url('/')}}">{{__('Home')}}</a></li>
							<li>{{__('Checkout')}}</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner">
            <!-- Product -->
            <div class="container">
              
				<div class="dlab-divider bg-gray-dark text-gray-dark icon-center"><i class="fa fa-circle bg-white text-gray-dark"></i></div>
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<h4> <h5>{{__('Your Order')}}</h5></h4>
                                      @if (Cart::count() > 0)

						<table class="table-bordered check-tbl">
							<thead class="text-center">
								<tr>
									 <th class="li-product-thumbnail">{{__('images')}}</th>
                                            <th class="cart-product-name">{{__('Product')}}</th>
                                            <th class="li-product-price">{{__('Unit Price')}}</th>
                                            
                                            <th class="li-product-subtotal">{{__('Total')}}</th>
								</tr>
							</thead>
							<tbody>
                @foreach (Cart::content() as $item)

								<tr>
									<td><img src="{{ $item->options->preview  }}" alt=""></td>
									<td>{{ $item->name  }}   *  {{$item->qty}}</td>
									<td class="product-price">{{ $item->price  }} {{ $currency->currency_icon ?? '' }}</td>
									 
									<td class="product-price">{{ $item->subtotal }} {{ $currency->currency_icon ?? '' }} </td>
								</tr>
                @endforeach

								 
							</tbody>
						</table>
						@else
                                        <h3> {{__('No items in Cart!')}}</h3>
            @endif
					</div>
					<div class="col-lg-6 col-md-6">
						 

	 <form action="{{ url('/beauty/make_order') }}" class="shop-form" method="post">
        @csrf
							<h4>{{__('Order Total')}}</h4>
							<table class="table-bordered check-tbl">
								<tbody>

								 
                                @if(Session::get('month') and Session::get('time') and Session::get('day') )
									 
									<tr>
										<td>{{__('Date')}}</td>
					<td>{{Session::get('day')}}-{{Session::get('month')}}-{{date('Y')}}</td>
									</tr>
									<tr>
										<td>{{__('Time')}}</td>
										<td>{{Session::get('time')}}</td>
									</tr>
									@endif


									 <tr>
									<td>{{__('Price Total')}}</td>
						<td class="cart_total_top">{{  Cart::priceTotal() }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>
								<tr>
									<td>{{__('Discount')}}</td>
						<td>{{ Cart::discount() }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>
								<tr>
									<td>{{__('Subtotal')}}</td>
						<td class="cart_total_top" >{{ Cart::subtotal() }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>
								<tr>
									 @php
             $totltax=0;
                foreach (Cart::content() as $item)
                {
                    $product_id=$item->id;
        $term = App\Term::where('user_id',domain_info('user_id'))->findorFail($product_id);
          
       
        $totltax= $totltax + $term->tax_value ;

                }

                   @endphp
									<td>{{__('Tax')}} </td>
						<td> {{ $totltax }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>

								<tr>
									<td>{{__('Total')}} </td>
						<td class="cart_total_top">  {{ Cart::total()  }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>
								</tbody>
							</table>

							<div class="form-group">
					 <input class="form-control" placeholder="{{__('name')}}" type="text" value="{{ Auth::user()->name  ?? '' }}" name="name" required="" readonly>
							</div>

							<div class="form-group">
					 <input class="form-control" placeholder="{{__('email')}}" type="text" value="{{ Auth::user()->email  ?? '' }}" name="email" required="" readonly>
							</div>

							<div class="form-group">
					 <input class="form-control" placeholder="{{__('phone')}}" type="text" value="{{ Auth::user()->phone  ?? '' }}" name="phone" required=""  >
							</div>
							<input type="hidden" name="Time" value="{{Session::get('time')}}">
		<input type="hidden" name="date" value="{{Session::get('day')}}-{{Session::get('month')}}- {{date('Y')}}">
							<!--h5>Payment Method</h5>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Name on Card">
							</div>
							<div class="form-group">
								<select>
									<option value="">Credit Card Type</option>
									<option value="">Another option</option>
									<option value="">A option</option>
									<option value="">Potato</option>
								</select>	
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Credit Card Number">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Card Verification Number">
							</div -->
                             @if(Session('branch'))
							<input type="hidden" name="branche_id" value="{{Session('branch')}}">
							@endif

							<div class="form-group">
								<button class="site-button button-lg btn-block" type="submit">{{__('Place Order Now')}} </button>
							</div>
						</form>
					</div>
				</div>
		   </div>
            <!-- Product END -->
		</div>
@endsection

@push('js')
    
@endpush
