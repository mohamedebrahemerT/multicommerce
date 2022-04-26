@extends('frontend.beauty.layouts.app')

@section('content')
  <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary" style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('Thank you')}} </h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                                                        <li><a href="{{url('/')}}">{{__('Home')}} </a></li>

                            <li>{{__('Thank you')}}</li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
     <section class="bg-light">
        <div class="container">
            <div class="row justify-content-md-center text-center">
                <div class="col-md-5">
                    <div class="thanks">
                        <img src="{{url('/')}}/frontend/bigbag/images/thankful.png" alt="">
                        <h3 class="pt-2">{{ __('Thank you') }} </h3>
                        <h6 class="pb-5">
                        	{{ __('order data') }}
          
                        </h6>
                        <p   @if(Session::get('locale') == 'ar')  style="text-align:right;" @endif ><span>{{ __('Order Number') }}: </span> <strong>{{$order->order_no}}</strong></p>

 <p @if(Session::get('locale') == 'ar')  style="text-align:right;" @endif ><span>{{ __('Date') }}: </span> <strong> 
    {{ $order->order_date  }}
    
</strong></p>

<p @if(Session::get('locale') == 'ar')  style="text-align:right;" @endif ><span>{{ __('time') }}: </span> <strong> 
    {{ $order->order_time  }}
    
</strong></p>

                        <p @if(Session::get('locale') == 'ar')  style="text-align:right;" @endif ><span>{{ __('Total') }}: </span> <strong>{{$order->total}} {{ $currency->currency_icon ?? '' }}</strong></p>
                        <p @if(Session::get('locale') == 'ar')  style="text-align:right;" @endif ><span>{{ __('Payment Method') }}: </span> <strong> 
                        	{{ __('cash') }} 
                        </strong></p>
                        <a href="/" class="links">{{ __('shop MORE') }}</a>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
