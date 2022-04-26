@extends('frontend.bigbag.index')
@section('content')
 
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
    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}
    
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
