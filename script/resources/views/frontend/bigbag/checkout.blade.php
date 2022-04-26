@extends('frontend.bigbag.index')
@section('content')
        <section class="wrap-header-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="cart-header border-right active">
                        <h1><span>01</span><br>{{ __('Shopping Cart') }}</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-header border-right active">
                        <h1><span>02</span><br>{{__('BILLING & SHIPPING')}}</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-header">
                        <h1><span>03</span><br>{{__('Payment Options')}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <!--Shopping Cart Area Strat-->
        <div class="Shopping-cart-area pt-4 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 order-2 order-lg-1">
                        <div class="billing-section">
                          <form action="{{ url('/make_order') }}" class="checkout_form" method="post">
        @csrf
                                <div class="checkbox-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>{{__('Name')}}<span class="required">*</span></label>
                  <input placeholder="" type="text" value="{{ Auth::user()->name  ?? '' }}" name="name" required="">
                                            </div>
                                        </div>
                                         
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>{{__('Email Address')}} <span class="required">*</span></label>
                                                <input placeholder="" type="text" value="{{ Auth::user()->email ?? '' }}" name="email" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>{{__('Phone')}} <span class="required">*</span></label>
        <input placeholder="" type="text" name="phone" required=""  onkeypress='validate(event)' value="{{ Auth::user()->mobile  ?? '' }}" >
                                            </div>
                                        </div>


                                  
 <div class="col-lg-12">
                   
                            
 <br>
                             @foreach(App\Models\Useraddresses::where('user_id',Auth::user()->id)->get() as $addresse)

             <input type="radio" id="{{$addresse->id}}" name="address_id" value="{{$addresse->id}}" required="">
             <label for="{{$addresse->id}}">{{__('usersadress')}}</label> 

                        
                                <div class="border py-2 p-3 rounded">
                                    <h5> {{$addresse->Country}} ,{{$addresse->City}} </h5>
                                    <p> {{$addresse->Address}} </p>
                                    <p>PO. {{$addresse->PO}}</p>
                                    <p> {{$addresse->CountryCode}}{{$addresse->Phone}}</p>
                                    
                                </div>
                          

 <hr>
                            @endforeach
                            
                           

                     

                  
                </div>

 

                                        <!--div class="col-md-3">
                                            <div class="country-select clearfix">
                                                <label>{{__('Country code')}}<span class="required">*</span></label>
                                                <select class="nice-select wide" name="CountryCode" required="">
                                                    <option data-display="+20">+20</option>
                                                    <option value="+966">+966</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="checkout-form-list">
                                                <label>{{__('mobile number')}} <span class="required">*</span></label>
                                                <input placeholder="" type="text" name="MobileNumber" required=""  onkeypress='validate(event)' value="{{ Auth::user()->mobile  ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="country-select clearfix">
                                                <label>{{__('Country')}}<span class="required">*</span></label>
                                                <select class="nice-select wide" name="Country" required="">
                                                    <option data-display="Egypt">{{__('Egypt')}}</option>
                                                    
                                                     
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="country-select clearfix">
                                                <label>{{__('Town / City')}}<span class="required">*</span></label>
                                                <select class="nice-select wide" name="City" required="">
                                                     
                                                    <option value="uk">{{__('Cairo')}}</option>
                                                    

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>{{__('Address')}} <span class="required">*</span></label>
                                                <input placeholder="" type="text" name="Address" required="">
                                            </div>
                                        </div -->
                                        <div class="col-md-12">
                                            <div class="order-notes">
                                                <div class="checkout-form-list">
                                                    <label>{{__('Order notes (optional)')}} </label>
                                                    <textarea id="checkout-mess" cols="30" rows="10"
                                                        placeholder="{{__('Notes about your order, e.g. special notes for delivery.')}}" name="OrderNotes"></textarea>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    

                                    <button type="submit">{{__('Save & Continue')}}</button>


                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-lg-6 col-12  order-1 order-lg-2">
                            <div class="your-order">
                                <h3>{{__('Your order')}}</h3>
                                <div class="your-order-table table-responsive">
                                      @if (Cart::count() > 0)

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="cart-product-name">{{__('Products')}}
                                                </th>
                                                <th class="cart-product-total">{{__('Total')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                @foreach (Cart::content() as $item)


                                            <tr class="cart_item">
                                                <td class="cart-product-name">{{ $item->name  }}<strong
                                                        class="product-quantity"> ×
{{$item->qty}}
                                                    </strong>

                                                      @foreach ($item->options->options as $op)

                                        <p>{{ $op->name }}</p>
                                       @endforeach
                                      
                                       @foreach ($item->options->attribute as $attribute)
                                            <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                        @endforeach


                                                </td>
                                                <td class="cart-product-total"><span class="amount">
                                                	{{ $item->subtotal }} {{ $currency->currency_icon ?? '' }}
                                                </span></td>
                                            </tr>
                @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                    <th>{{ __('Price Total') }}</th>
                                    <td data-title="Subtotal"><span class="bigbag-Price-amount amount">{{  Cart::priceTotal() }} {{ $currency->currency_icon ?? '' }}</span></td>
                                </tr>


                                <tr class="cart-subtotal">
                                    <th>{{ __('Discount') }}</th>
                                    <td data-title="Subtotal"><span class="bigbag-Price-amount amount">- {{ Cart::discount() }} {{ $currency->currency_icon ?? '' }}</span></td>
                                </tr>

                                <tr class="cart-subtotal">
                                    <th>{{ __('Subtotal') }}</th>
                                    <td data-title="Subtotal"><span class="bigbag-Price-amount amount">{{ Cart::subtotal() }} {{ $currency->currency_icon ?? '' }}</span></td>
                                </tr>

                                 @php
             $totltax=0;
                foreach (Cart::content() as $item)
                {
                    $product_id=$item->id;
        $term = App\Term::where('user_id',domain_info('user_id'))->findorFail($product_id);
          
       
        $totltax= $totltax + $term->tax_value ;

                }

                   @endphp

                                <tr class="cart-subtotal">
                                    <th>{{ __('Tax') }}</th>
                                    <td data-title="Subtotal"><span class="bigbag-Price-amount amount">  {{  $totltax }} {{ $currency->currency_icon ?? '' }}</span></td>
                                </tr>
                                 
                                <tr class="order-total">
                                    <th>{{ __('Total') }}</th>
                                    <td data-title="Total"><strong><span class="bigbag-Price-amount amount text-dark">{{  Cart::total() }} {{ $currency->currency_icon ?? '' }}</span></strong>
                                    </td>
                                </tr>
                                        </tfoot>
                                    </table>
                                     @else
                                    {{__('No items in Cart!')}} 
            @endif
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
    </section>

   
    @push('js')
    
 <script type="text/javascript">
     function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
 </script>

    @endpush

@endsection
