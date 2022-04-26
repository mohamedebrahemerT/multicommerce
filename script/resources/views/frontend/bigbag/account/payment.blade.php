@extends('frontend.bigbag.index')
@section('content')
      <section class="bg-light">
        <div class="container">
            <div class="row">

                    <div class="col-lg-3">
                    <div class="products-section accountDetails">
                        <div class="media border-bottom">
                   @if(Auth::user()->image == '0')
                   <img src="{{ url('/')}}/uploads/{{ Auth::user()->id }}/photo.png" class="mr-2" alt="photo here">
                     @else
 <img src="{{ url('/') }}/frontend/bigbag/images/profile.jpg" class="mr-2" alt="photo here">
                     @endif
                              <!--div class="media-body">
                                <h6 class="mt-0">{{ Auth::user()->name }}</h6>
                            <a href="/user/logout">{{__('logout')}}</a>
                            </div -->
                        </div>
                        <div class="accountDetailsList">
                            <ul>
                                <li ><a href="{{url('/')}}/user/dashboard"><span
                                            class="ti-user mr-2"></span>
                                            {{__('Account Details')}} </a></li>
                                <li><a href="{{url('/')}}/user/orders"><span class="ti-files mr-2"></span>
                                        {{__('Orders')}}</a></li>
                                <li><a href="{{url('/')}}/user/addresses"><span class="ti-location-pin mr-2"></span>
                                        {{__('Addresses')}}</a></li>
                                <li class="active"><a href="{{url('/')}}/user/payment"><i class="ti-credit-card mr-2"></i>{{__('Payment Cards')}}</a>
                                </li>
                                 <li><a href="{{url('/')}}/user/reviews"><i class="ti-credit-card mr-2"></i>{{__('reviews')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-lg-9">
                    <div class="wrap-account-details mt-30">
                        <div class="row profile-payment p-1">

                            <div class="tab-product w-100">
                                <ul class="nav nav-tabs nav-material">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                            href="#SavedCards"><span>{{__('Saved Cards')}}</span></a>
                                        <div class="material-border"></div>
                                    </li>
                                    <li class="nav-item"><a data-toggle="tab" href="#NewCard" class="nav-link"><span>{{__('New Card')}}</span></a>
                                        <div class="material-border"></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content tab-content nav-material content-payment">
                                <div id="SavedCards" class="tab-pane show fade in active mt-30">

 
                                    @foreach(App\Models\UserVisa::where('user_id',auth()->user()->id)->get() as $UserVisa)
                                    <div class="row card-box">

                                        <div class="mr-3"><img src="images/payment/mastercard.png" alt=""></div>
                                        <div>
                                            <p> **** **** ****{{substr ($UserVisa->CardNum, -3)}}
                                               </p>
                                            <p>MasterCard</p>
                                        </div>

                                        <div class="ml-auto">

                            <!--a href=""><span class="ti-pencil-alt mr-3"></span></a -->

                            <a href="{{url('/')}}/deleteUserVisa/{{$UserVisa->id}}"><span class="ti-trash mr-1"></span></a>
                                        </div>

                                    </div>
                                    @endforeach
                                    
                                </div>
                                <div id="NewCard" class="tab-pane show fade in">
                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="container mt-30 ">
                              <form action="{{url('/')}}/UserVisa" class="checkbox-form" method="post">
                                @csrf

                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="checkout-form-list">
                                        <label>{{__('Card Number')}} <span
                                                                        class="required">*</span></label>
                                          <input placeholder="" type="text" name="CardNum"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="checkout-form-list">
                                                           <label>
                                      {{__('Cardholder Name')}} <span
                                                                        class="required">*</span></label>
                                     <input placeholder="" type="text" name="CardName">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="checkout-form-list">
                              <label> {{__('Expire Date')}}<span
                                                                        class="required">*</span></label>
                                    <input placeholder="MM/YY" type="date" name="expir" name="expir">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="checkout-form-list">
                                                                <label>{{__('CVV')}} <span class="required">*</span></label>
                                                                <input placeholder="" type="text" name="code"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                                                            </div>
                                                        </div>
                                                    </div>
                                        


                   <button type="submit" >{{__('add card')}}</button>
                                                </form>


                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
    </section>

@endsection