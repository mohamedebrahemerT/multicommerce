@extends('frontend.beauty.layouts.app')
@section('content')
 
     <section class="bg-light">
        <div class="container">
            <div class="row">
                   <div class="col-lg-3">
                    <div class="products-section accountDetails">
                        <div class="media border-bottom">
                    <img src="{{url('/')}}/frontend/bigbag/images/profile.jpg" class="mr-2" alt="...">
                            <!--div class="media-body">
                                <h6 class="mt-0">{{ Auth::user()->name }}</h6>
                            <a href="/user/logout">{{__('logout')}}</a>
                            </div -->
                        </div>
                        <div class="accountDetailsList">
                            <ul>
                                <li><a href="{{url('/')}}/user/dashboard"><span
                                            class="ti-user mr-2"></span>
                                            {{__('Account Details')}} </a></li>
                                <li><a href="{{url('/')}}/user/orders"><span class="ti-files mr-2"></span>
                                        {{__('Orders')}}</a></li>
                                <!--li  class="active"><a href="{{url('/')}}/user/addresses"><span class="ti-location-pin mr-2"></span>
                                        {{__('Addresses')}}</a></li -->
                                <li><a href="{{url('/')}}/user/payment"><i class="ti-credit-card mr-2"></i>{{__('Payment Cards')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="wrap-account-details mt-30">
                        <div class="row profile-address">

                             @foreach(App\Models\Useraddresses::where('user_id',Auth::user()->id)->get() as $addresse)
                            <div class="col-md-3">
                                <div class="border py-2 p-3 rounded">
                                    <h5> {{$addresse->Address}}</h5>
                                    <p>{{$addresse->Country}} ,{{$addresse->City}}  </p>
                                    <p>PO. {{$addresse->PO}}</p>
                                    <p> {{$addresse->CountryCode}}{{$addresse->Phone}}</p>
                                    <div class="pt-3">
                                        <a href=""><span class="ti-pencil-alt mr-3"></span></a>

         <a href="{{url('/')}}/user/addresses_delate/?id={{$addresse->id}}"><span class="ti-trash mr-1"></span></a>


                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="col-md-3">
                                <div class="border py-2 p-3 rounded text-center add-new-address" data-toggle="modal"
                                    data-target="#exampleModaladdresses">
                                    <a href="#">
                                        <i class="fa fa-plus fa-3x"></i>
                                        <h6>Add New Address</h6>
                                    </a>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
    </section>

     <!-- Modal -->
    <div class="modal fade" id="exampleModaladdresses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <h3 class="text-center">{{__('Add New Address')}}</h3>
                            <hr>
                            <form action="{{url('/')}}/user/addresses" method="post">
                                @csrf
                                <div class="checkbox-form">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="checkout-form-list">
                                                <label>{{__('Phone')}} <span class="required">*</span></label>
                         <input placeholder="" type="text" name="Phone">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="country-select clearfix">
                                                <label>{{__('Country code')}}<span class="required">*</span></label>
                                                <select class="nice-select wide" name="CountryCode">
                                                    <option data-display="+20">+20</option>
                                                    <option value="+30">+30</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="checkout-form-list">
                                                <label>{{__('PO')}} <span class="required">*</span></label>
                                                <input placeholder="" type="text" name="PO">
                                            </div>
                                        </div>
                                         
                                        <div class="col-md-6">
                                            <div class="country-select clearfix">
                                                <label>{{__('Country')}}<span class="required">*</span></label>
                                                <select class="nice-select wide" name="Country">
                                                    <option data-display="Egypt">Egypt</option>
                                                    <option value="uk">London</option>
                                                    <option value="rou">Romania</option>
                                                    <option value="fr">French</option>
                                                    <option value="de">Germany</option>
                                                    <option value="aus">Australia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="country-select clearfix">
                                                <label>{{__('Town / City')}}<span class="required">*</span></label>
                                                <select class="nice-select wide" name="City">
                                                    <option data-display="Bangladesh">Giza</option>
                                                    <option value="uk">Cairo</option>
                                                    <option value="rou">Alex</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>{{__('Address')}} <span class="required">*</span></label>
                                                <input placeholder="" type="text" name="Address">
                                            </div>
                                        </div>

    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                    </div>
                                    <button  type="submit">{{__('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('js')
           <script type="text/javascript">
              // alert('test');
           </script>
    @endpush

@endsection
