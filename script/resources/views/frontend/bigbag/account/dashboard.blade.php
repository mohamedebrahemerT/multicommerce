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
                                <li class="active"><a href="{{url('/')}}/user/dashboard"><span
                                            class="ti-user mr-2"></span>
                                            {{__('Account Details')}} </a></li>
                                <li><a href="{{url('/')}}/user/orders"><span class="ti-files mr-2"></span>
                                        {{__('Orders')}}</a></li>
                                <li><a href="{{url('/')}}/user/addresses"><span class="ti-location-pin mr-2"></span>
                                        {{__('Addresses')}}</a></li>
                                <li><a href="{{url('/')}}/user/payment"><i class="ti-credit-card mr-2"></i>{{__('Payment Cards')}}</a>
                                </li>
                                 <li><a href="{{url('/')}}/user/reviews"><i class="ti-credit-card mr-2"></i>{{__('reviews')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-lg-9">
                    <div class="wrap-account-details mt-30">
                        <p>{{__('Hello')}} <span>{{ Auth::user()->name }}</span> </p>
                        <p>{{__('From your account dashboard')}}
                          </p>
                        <form action="{{ url('/user/settings/update') }}" class="pt-40 basicform"   method="post"  >
                            @csrf
                            <div class="chekbox-form">
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>{{__('Name')}}<span class="required">*</span></label>
                                            <input placeholder="" type="text" value="{{ Auth::user()->name }}" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>{{__('Email Address')}} <span class="required">*</span></label>
                                            <input placeholder="" type="text" value="{{ Auth::user()->email }}" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>{{__('Phone')}} <span class="required">*</span></label>
                                            <input placeholder="" type="text" value="{{ Auth::user()->mobile }}"   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="mobile"  id="myInput">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>{{__('photo')}} <span class="required">*</span></label>
                                            <input type="file" name="image" accept="image/*" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-20">
                                        <h6>{{__('Password change')}}</h6>
                                    </div>
                                    <div class="row change-password p-20">
                                        <div class="col-md-8">
                                            <div class="checkout-form-list">
                                                <label>{{__('Current password (leave blank to leave unchanged)')}}</label>
                                                <input placeholder="" type="password" name="password_current">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="checkout-form-list">
                                                <label>{{__('New password (leave blank to leave unchanged)')}}</label>
                                                <input placeholder="" type="password" name="password" >
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="checkout-form-list">
                                                <label>{{__('Confirm new password')}}</label>
                                                <input placeholder="" type="password" name="password_confirmation" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <button style="background: #ee5d33;color: #fff" type="submit" class="bigbag-Button button btn basicbtn " name="save_account_details" value="Save changes">{{ __('Save change') }}
            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('js')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>


<script type="text/javascript">
 
</script>
@endpush

@endsection