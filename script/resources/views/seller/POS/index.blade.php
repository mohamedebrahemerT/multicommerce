@extends('layout.top-head') @section('content')

    
   
   


 @if($errors->has('phone_number'))

<div class="alert alert-danger alert-dismissible text-center">

    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('phone_number') }}</div>

@endif

@if(session()->has('message'))

    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div> 

@endif

@if(session()->has('not_permitted'))

  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 

@endif

<!-- Side Navbar -->

<nav class="side-navbar shrink">

    <div class="side-navbar-wrapper">

      <div class="sidebar-brand">
            <a href="#">
                <img src="{{ asset('uploads/w-logo.png') }}" width="100px">
               
            </a>

        </div>

      <!-- Sidebar Header    -->

      <!-- Sidebar Navigation Menus-->

      <div class="main-menu">
    @if(Auth::user()->role_id==3)
        <ul id="side-main-menu" class="side-menu list-unstyled">                  

          <li><a href="{{url('/')}}/dashboard"> <i class="dripicons-meter"></i><span>{{ __('dashboard') }}</span></a></li>

        

          

          <li><a href="#Orders" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>{{__('Orders')}}</span><span></a>

            <ul id="Orders" class="collapse list-unstyled ">

              <li id="category-menu"><a href="{{ url('/seller/orders/all') }}">
                {{ __('All Orders') }}
              </a></li>

                <li id="category-menu"><a href="{{ url('/seller/orders/canceled') }}">
                {{ __('Canceled') }}
              </a></li>
 

            </ul>

          </li>

                <li><a href="{{ route('seller.refund.status' , 'all') }}"> <i class="dripicons-meter"></i><span>{{ __('Refund') }}</span></a></li>



          <li><a href="#product" aria-expanded="false" data-toggle="collapse"> 
            <i class="dripicons-card"></i><span>{{__('Products')}}</span><span></a>

            <ul id="product" class="collapse list-unstyled ">

              <li id="category-menu"><a href="{{ route('seller.product.index') }}">
                {{ __('All Products') }}
              </a></li>

                <li id="category-menu"><a href="{{ route('seller.inventory.index') }}">
                {{ __('Inventory') }}
              </a></li>

               <li id="category-menu"><a href="{{ route('seller.category.index') }}">
                {{ __('Categories') }}
              </a></li>

                    <li id="category-menu"><a href="{{ route('seller.attribute.index') }}">
                {{ __('Attributes') }}
              </a></li>
              
               <li id="category-menu"><a href="{{ route('seller.brand.index') }}">
                {{ __('Brands') }}
              </a></li>
                  <li id="category-menu"><a href="{{ route('seller.coupon.index') }}">
                {{ __('Coupons') }}
              </a></li>
 
            </ul>

          </li>

   <li><a href="{{ route('seller.customer.index') }}"> <i class="dripicons-wallet"></i><span>{{ __('Customers') }}</span></a></li>

  <li><a href="{{ route('seller.transection.index') }}"> <i class="dripicons-document"></i><span>{{ __('Transactions') }}</span></a></li>


  <li><a href="{{ route('seller.report.index') }}"> <i class="dripicons-export"></i><span>{{ __('Reports') }}</span></a></li>

    <li><a href="{{ route('seller.review.index') }}"> <i class="dripicons-return"></i><span>{{ __('Review & Ratings') }}</span></a></li>




     <li><a href="#Shipping" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-briefcase"></i><span>{{__('Shipping')}}</span><span></a>

            <ul id="Shipping" class="collapse list-unstyled ">

              <li id="category-menu"><a href="{{ route('seller.location.index') }}">
         
             {{ __('locations') }}
              </a></li>

                <li id="category-menu"><a href="{{ route('seller.shipping.index') }}">
                 {{ __('Shipping Price') }}
              </a></li>
 

            </ul>

          </li>


    <li><a href="#Offer" aria-expanded="false" data-toggle="collapse"><i class="dripicons-user-group"></i><span>{{ __('Offer & Ads') }}</span><span></a>

            <ul id="Offer" class="collapse list-unstyled ">

              <li id="category-menu"><a href="{{ route('seller.ads.index') }}">
         
            {{ __('Bump Ads') }}
              </a></li>

                <li id="category-menu"><a href="{{ route('seller.ads.show','banner') }}">
                {{ __('Banner Ads') }}
              </a></li>
 

            </ul>

          </li>


    <li><a href="#Settings" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user"></i><span>{{ __('Settings') }}</span><span></a>

            <ul id="Settings" class="collapse list-unstyled ">

              <li id="category-menu"><a href="{{ route('seller.settings.show','shop-settings') }}">
         
            {{ __('Shop Settings') }}
              </a></li>

                <li id="category-menu"><a href="{{ route('seller.settings.show','payment') }}">
               {{ __('Payment Options') }}
              </a></li>

               <li id="category-menu"><a href="{{ route('seller.settings.show','plan') }}">
              {{ __('Subscriptions') }}
              </a></li>
 

            </ul>

          </li>


          <li><a href="#Analytics" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document-remove"></i><span>{{ __('Marketing Tools') }}</span><span></a>

            <ul id="Analytics" class="collapse list-unstyled ">

              <li id="category-menu"><a href="{{ route('seller.marketing.show','google-analytics') }}">
         
            {{ __('Google Analytics') }}
              </a></li>

                <li id="category-menu"><a href="{{ route('seller.marketing.show','tag-manager') }}">
         
           {{ __('Google Tag Manager') }}
              </a></li>

               <li id="category-menu"><a href="{{ route('seller.marketing.show','facebook-pixel') }}">
         
        {{ __('Facebook Pixel') }}
              </a></li>

                   <li id="category-menu"><a href="{{ route('seller.marketing.show','whatsapp') }}">
         
       {{ __('Whatsapp Api') }}
              </a></li>

           

            </ul>

          </li>
                <li class="menu-header">{{ __('SALES CHANNELS') }}</li>

             <li><a href="#CHANNELS" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document-remove"></i><span>{{ __('Online store') }}</span><span></a>

            <ul id="CHANNELS" class="collapse list-unstyled ">

              <li id="category-menu"><a href="{{ route('seller.menu.index') }}">
         
            {{ __('Menus') }}
              </a></li>

                <li id="category-menu"><a href="{{ route('seller.page.index') }}">
         
           {{ __('Pages') }}
              </a></li>

               <li id="category-menu"><a href="{{ route('seller.slider.index') }}">
         {{ __('Sliders') }}
     
              </a></li>

                   <li id="category-menu"><a href="{{ route('seller.seo.index') }}">
         
       {{ __('Seo') }}
              </a></li>

           

            </ul>

          </li>
<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                    <a href="{{ domain_info('full_domain') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                        <i class="fas fa-external-link-alt"></i>{{ __('Your Website') }}
                    </a>
                </div>


        </ul>
@endif

      </div>

    </div>

</nav>

<section class="forms pos-section">

    <div class="container-fluid">

        <div class="row">

            <audio id="mysoundclip1" preload="auto">

                <source src="{{url('public/beep/beep-timber.mp3')}}"></source>

            </audio>

            <audio id="mysoundclip2" preload="auto">

                <source src="{{url('public/beep/beep-07.mp3')}}"></source>

            </audio>

            <div class="col-md-6">

                <div class="card">

                    <div class="card-body" style="padding-bottom: 0">

                       {!! Form::open(['route' => 'seller.POS.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}

                        @php

                            if($lims_pos_setting_data)

                                $keybord_active = $lims_pos_setting_data->keybord_active;

                            else

                                $keybord_active = 0;



                            $customer_active = DB::table('permissions')

                              ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')

                              ->where([

                                ['permissions.name', 'customers-add'],

                                ['role_id', \Auth::user()->role_id] ])->first();

                        @endphp

                        <div class="row">

                            <div class="col-md-12">

                                <div class="row">

                                   
                                 
                                     
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if($lims_pos_setting_data)
                                            <input type="hidden" name="customer_id_hidden" value="{{$lims_pos_setting_data->customer_id}}">
                                            @endif
                                            <div class="input-group pos">
                                                @if($customer_active)
                                                <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="{{__('Select customer...')}}" style="width: 100px">
                                                <?php $deposit = [] ?>
                                                @foreach($lims_customer_list as $customer)
                                                    @php $deposit[$customer->id] = $customer->deposit - $customer->expense; @endphp
                                                    <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->email . ')'}}</option>
                                                @endforeach
                                                </select>
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                                @else
                                                <?php $deposit = [] ?>
                                                <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="{{__('Select customer...')}}">
                                                @foreach($lims_customer_list as $customer)
                                                    @php $deposit[$customer->id] = $customer->deposit - $customer->expense; @endphp
                                                    <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->email . ')'}}</option>
                                                @endforeach
                                                </select>
                                                 <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="search-box form-group">

            <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="{{__('Scan/Search product by name/code')}}" class="form-control"  />

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="table-responsive transaction-list">

                                        <table id="myTable" class="table table-hover table-striped order-list table-fixed" @if(app()->getLocale() == 'ar') style="direction: rtl; "    @endif>

                                            <thead>

                                                <tr>

                                                    <th class="col-sm-4">{{trans('product')}}</th>

                                                    <th class="col-sm-2">{{trans('Price')}}</th>

                                                    <th class="col-sm-3">{{trans('Quantity')}}</th>

                                                    <th class="col-sm-3">{{trans('Subtotal')}}</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                <div class="row" style="display: none;">

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <input type="hidden" name="total_qty" />

                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <input type="hidden" name="total_discount" value="0.00" />

                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <input type="hidden" name="total_tax" value="0.00"/>

                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <input type="hidden" name="total_price" />

                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <input type="hidden" name="item" />

                                            <input type="hidden" name="order_tax" />

                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <input type="hidden" name="grand_total" />

                                            <input type="hidden" name="coupon_discount" />

                                            <input type="hidden" name="sale_status" value="1" />

                                            <input type="hidden" name="coupon_active">

                                            <input type="hidden" name="coupon_id">

                                            <input type="hidden" name="coupon_discount" />



                                            <input type="hidden" name="pos" value="1" />

                                            <input type="hidden" name="draft" value="0" />

                                        </div>

                                    </div>

                                </div>

                                <div class="col-12 totals" style="border-top: 2px solid #e4e6fc; padding-top: 10px;">

                                    <div class="row">

                                        <div class="col-sm-4">

                                            <span class="totals-title">{{trans('Items')}}</span><span id="item">0</span>

                                        </div>

                                        <div class="col-sm-4">

                                            <span class="totals-title">{{trans('Total')}}</span><span id="subtotal">0.00</span>

                                        </div>

                                        <div class="col-sm-4">

                                            <span class="totals-title">{{trans('Discount')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-discount"> <i class="dripicons-document-edit"></i></button></span><span id="discount">0.00</span>

                                        </div>

                                        <div class="col-sm-4">

                                            <span class="totals-title">{{trans('Coupon')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#coupon-modal"><i class="dripicons-document-edit"></i></button></span><span id="coupon-text">0.00</span>

                                        </div>

                                        <div class="col-sm-4">

                                            <span class="totals-title">{{trans('Tax')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#order-tax"><i class="dripicons-document-edit"></i></button></span><span id="tax">0.00</span>

                                        </div>

                                        <div class="col-sm-4">

                                            <span class="totals-title">{{trans('Shipping')}} <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#shipping-cost-modal"><i class="dripicons-document-edit"></i></button></span><span id="shipping-cost">0.00</span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>                        

                    </div>

                    <div class="payment-amount">

                        <h2>{{trans('grand total')}} <span id="grand-total">0.00</span></h2>

                    </div>

                    <div class="payment-options">

                        <div class="column-5">

                            <button style="background: #0984e3" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="credit-card-btn"><i class="fa fa-credit-card"></i> {{trans('Card')}}</button>   

                        </div>

                        <div class="column-5">

                            <button style="background: #00cec9" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cash-btn"><i class="fa fa-money"></i> {{trans('Cash')}}</button>

                        </div>

                        <div class="column-5">

                            <button style="background-color: #213170" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="paypal-btn"><i class="fa fa-paypal"></i> 
                            {{trans('Paypal')}}</button>

                        </div>

                        <div class="column-5">

                            <button style="background-color: #e28d02" type="button" class="btn btn-custom" id="draft-btn"><i class="dripicons-flag"></i> {{trans('Draft')}}</button>

                        </div>

                        <div class="column-5">

                            <button style="background-color: #fd7272" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cheque-btn"><i class="fa fa-money"></i> {{trans('Cheque')}}</button>

                        </div>

                        <div class="column-5">

                            <button style="background-color: #5f27cd" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="gift-card-btn"><i class="fa fa-credit-card-alt"></i> {{trans('GiftCard')}}</button>

                        </div>

                        <div class="column-5">

                            <button style="background-color: #b33771" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="deposit-btn"><i class="fa fa-university"></i> {{trans('Deposit')}}</button>

                        </div>

                        <div class="column-5">

                            <button style="background-color: #d63031;" type="button" class="btn btn-custom" id="cancel-btn" onclick="return confirmCancel()"><i class="fa fa-close"></i>{{trans('Cancel')}} </button>

                        </div>

                        

                    </div>

                </div>

            </div>

            <!-- payment modal -->

            <div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left"  @if(Session::get('locale') == 'ar') style="direction:initial; text-align: right;"  @endif>

                <div role="document" class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 id="exampleModalLabel" class="modal-title">{{trans('Finalize Sale')}}</h5>

                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                        </div>

                        <div class="modal-body">

                            <div class="row">

                                <div class="col-md-10">

                                    <div class="row">

                                        <div class="col-md-6 mt-1">

                                            <label>{{trans('Recieved Amount')}} *</label>

                                            <input type="text" name="paying_amount" class="form-control numkey" required step="any">

                                        </div>

                                        <div class="col-md-6 mt-1">

                                            <label>{{trans('Paying Amount')}} *</label>

                                            <input type="text" name="paid_amount" class="form-control numkey"  step="any" readonly="">

                                        </div>

                                        <div class="col-md-6 mt-1">

                                            <label>{{trans('Change')}} : </label>

                                            <p id="change" class="ml-2">0.00</p>

                                        </div>

                                        <div class="col-md-6 mt-1">

                                            <input type="hidden" name="paid_by_id">

                                            <label>{{trans('Paid By')}}</label>

                                            <select name="paid_by_id_select" class="form-control selectpicker">

                                                <option value="1">{{trans('Cash')}}</option>

                                                

                                            </select>

                                        </div>

                                        <div class="form-group col-md-12 mt-3">

                                            <div class="card-element form-control">

                                            </div>

                                            <div class="card-errors" role="alert"></div>

                                        </div>

                                        <div class="form-group col-md-12 gift-card">

                                            <label> {{trans('Gift Card')}} *</label>

                                            <input type="hidden" name="gift_card_id">

                                            <select id="gift_card_id_select" name="gift_card_id_select" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card..."></select>

                                        </div>

                                        <div class="form-group col-md-12 cheque">

                                            <label>{{trans('Cheque Number')}} *</label>

                                            <input type="text" name="cheque_no" class="form-control">

                                        </div>

                                        <div class="form-group col-md-12">

                                            <label>{{trans('Payment Note')}}</label>

                                            <textarea id="payment_note" rows="2" class="form-control" name="payment_note"></textarea>

                                        </div>

                                    </div>

                                    <div class="row">

                                       <div class="col-md-6 form-group">

                                            <label>{{trans('Sale Note')}}</label>

                                            <textarea rows="3" class="form-control" name="sale_note"></textarea>

                                        </div>

                                        <div class="col-md-6 form-group">

                                            <label>{{trans('Staff Note')}}</label>

                                            <textarea rows="3" class="form-control" name="staff_note"></textarea>

                                        </div>

                                    </div>

                                    <div class="mt-3">

                                        <button id="submit-btn" type="button" class="btn btn-primary">{{trans('submit')}}</button>

                                    </div>

                                </div>

                                <div class="col-md-2 qc" data-initial="1">

                                    <h4><strong>{{trans('Quick Cash')}}</strong></h4>

                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="10" type="button">10</button>

                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="20" type="button">20</button>

                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="50" type="button">50</button>

                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="100" type="button">100</button>

                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="500" type="button">500</button>

                                    <button class="btn btn-block btn-primary qc-btn sound-btn" data-amount="1000" type="button">1000</button>

                                    <button class="btn btn-block btn-danger qc-btn sound-btn" data-amount="0" type="button">{{trans('Clear')}}</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- order_discount modal -->

            <div id="order-discount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">{{trans('Order Discount')}}</h5>

                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                        </div>

                        <div class="modal-body">

                            <div class="form-group">

                                <input type="text" name="order_discount" class="form-control numkey">

                            </div>

                            <button type="button" name="order_discount_btn" class="btn btn-primary" data-dismiss="modal">{{trans('submit')}}</button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- coupon modal -->

            <div id="coupon-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">{{trans('Coupon Code')}}</h5>

                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                        </div>

                        <div class="modal-body">

                            <div class="form-group">

                                <input type="text" id="coupon-code" class="form-control" placeholder="Type Coupon Code...">

                            </div>

                            <button type="button" class="btn btn-primary coupon-check" data-dismiss="modal">{{trans('submit')}}</button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- order_tax modal -->

            <div id="order-tax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">{{trans('Order Tax')}}</h5>

                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                        </div>

                        <div class="modal-body">

                            <div class="form-group">

                                <input type="hidden" name="order_tax_rate">

                                <select class="form-control" name="order_tax_rate_select">

                                    <option value="0">No Tax</option>

                                    @foreach($lims_tax_list as $tax)

                                    <option value="{{$tax->rate}}">{{$tax->name}}</option>

                                    @endforeach

                                </select>

                            </div>

                            <button type="button" name="order_tax_btn" class="btn btn-primary" data-dismiss="modal">{{trans('submit')}}</button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- shipping_cost modal -->

            <div id="shipping-cost-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">{{trans('Shipping Cost')}}</h5>

                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                        </div>

                        <div class="modal-body">

                            <div class="form-group">

                                <input type="text" name="shipping_cost" class="form-control numkey" step="any">

                            </div>

                            <button type="button" name="shipping_cost_btn" class="btn btn-primary" data-dismiss="modal">{{trans('submit')}}</button>

                        </div>

                    </div>

                </div>

            </div>

            

            {!! Form::close() !!}

            <!-- product list -->

            <div class="col-md-6">

                <!-- navbar-->

                <header class="header">

                    <nav class="navbar">

                      <div class="container-fluid">

                        <div class="navbar-holder d-flex align-items-center justify-content-between">

                          <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>

                          <div class="navbar-header">

                          

                          <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                            <li class="nav-item"><a id="btnFullscreen" title="Full Screen"><i class="dripicons-expand"></i></a></li> 

                             

                       

           <li class="nav-item"><a class="dropdown-item" href="{{url('/')}}/seller/setting/pos_setting" title="{{trans('POS Setting')}}"><i class="dripicons-gear"></i></a> </li>

            

                     
                         
                       

                 

                            
                    

                            <li class="nav-item"> 

                                <a class="dropdown-item" href="{{ url('/') }}" target="_blank"><i class="dripicons-information"></i> {{trans('Help')}}</a>

                            </li>&nbsp;

                            <li class="nav-item">

                                  <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-user"></i> <span>{{ucfirst(Auth::user()->name)}}</span> <i class="fa fa-angle-down"></i>

                                  </a>

                                  <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">

                                      <li> 

                                        <a href="/seller/settings"><i class="dripicons-user"></i> {{trans('profile')}}</a>

                                      </li>
 
 

                                      <li>

                                        <a href="{{ route('logout') }}"

                                           onclick="event.preventDefault();

                                                         document.getElementById('logout-form').submit();"><i class="dripicons-power"></i>

                                            {{trans('logout')}}

                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                            @csrf

                                        </form>

                                      </li>

                                  </ul>

                            </li> 

                          </ul>

                        </div>

                      </div>

                    </nav>

                </header>

                <div class="filter-window">

                    <div class="category mt-3">

                        <div class="row ml-2 mr-2 px-2">

                            <div class="col-7">Choose category</div>

                            <div class="col-5 text-right">

                                <span class="btn btn-default btn-sm">

                                    <i class="dripicons-cross"></i>

                                </span>

                            </div>

                        </div>

                        <div class="row ml-2 mt-3">

                            @foreach($lims_category_list as $category)

                            <div class="col-md-3 category-img text-center" data-category="{{$category->id}}">

                            

                                    <img  src="{{ asset($row->preview->content ?? 'uploads/default.png') }}" />

                               

                                <p class="text-center">{{$category->name}}</p>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    <div class="brand mt-3">

                        <div class="row ml-2 mr-2 px-2">

                            <div class="col-7">Choose brand</div>

                            <div class="col-5 text-right">

                                <span class="btn btn-default btn-sm">

                                    <i class="dripicons-cross"></i>

                                </span>

                            </div>

                        </div>

                        <div class="row ml-2 mt-3">

                            @foreach($lims_brand_list as $brand)

               

                                <div class="col-md-3 brand-img text-center" data-brand="{{$brand->id}}">

                                    <img  src="{{ asset($brand->preview->content ?? 'uploads/default.png') }}" />

                                    <p class="text-center">{{$brand->title}}</p>

                                </div>

                            

                            @endforeach

                        </div>

                    </div>

                </div>

          <div class="row">

                    <div class="col-md-6">

                        <button class="btn btn-block btn-primary" id="category-filter">{{trans('category')}}</button>

                    </div>

                    <div class="col-md-6">

                        <button class="btn btn-block btn-info" id="brand-filter">{{trans('Brand')}}</button>

                    </div>

                   

                    <div class="col-md-12 mt-1 table-container">

                        <table id="product-table" class="table no-shadow product-list">

                            <thead class="d-none">

                                <tr>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody>

                            @for ($i=0; $i < ceil($product_number/5); $i++)

                                <tr>

                                    <td class="product-img sound-btn" title="{{$lims_product_list[0+$i*5]->title}}" data-product ="{{$lims_product_list[0+$i*5]->id. ' (' . $lims_product_list[0+$i*5]->title . ')'}}">

                     <img  src="{{ asset($lims_product_list[0+$i*5]->preview->media->url ?? 'uploads/default.png') }}" width="100%" />
                                    

                                        <p>{{$lims_product_list[0+$i*5]->title}}  </p>

                                        <span>{{$lims_product_list[0+$i*5]->id}}</span>

                                    </td>

                                    @if(!empty($lims_product_list[1+$i*5]))

                                    <td class="product-img sound-btn" title="{{$lims_product_list[1+$i*5]->id}}" data-product ="{{$lims_product_list[1+$i*5]->id . ' (' . $lims_product_list[1+$i*5]->id . ')'}}">
                                      <img  src="{{ asset($lims_product_list[1+$i*5]->preview->media->url ?? 'uploads/default.png') }}" width="100%" />

                                        <p>{{$lims_product_list[1+$i*5]->title}}</p>

                                        <span>{{$lims_product_list[1+$i*5]->id}}</span>

                                    </td>

                                    @else

                                    <td style="border:none;"></td>

                                    @endif

                                    @if(!empty($lims_product_list[2+$i*5]))

                                    <td class="product-img sound-btn" title="{{$lims_product_list[2+$i*5]->title}}" data-product ="{{$lims_product_list[2+$i*5]->id . ' (' . $lims_product_list[2+$i*5]->title . ')'}}">

                                     <img  src="{{ asset($lims_product_list[2+$i*5]->preview->media->url ?? 'uploads/default.png') }}" width="100%" />
                                        <p>{{$lims_product_list[2+$i*5]->title}}</p>

                                        <span>{{$lims_product_list[2+$i*5]->id}}</span>

                                    </td>

                                    @else

                                    <td style="border:none;"></td>

                                    @endif

                                    @if(!empty($lims_product_list[3+$i*5]))

                                    <td class="product-img sound-btn" title="{{$lims_product_list[3+$i*5]->title}}" data-product ="{{$lims_product_list[3+$i*5]->id . ' (' . $lims_product_list[3+$i*5]->title . ')'}}">

                                      <img  src="{{ asset($lims_product_list[3+$i*5]->preview->media->url ?? 'uploads/default.png') }}" width="100%" />

                                        <p>{{$lims_product_list[3+$i*5]->title}}</p>

                                        <span>{{$lims_product_list[3+$i*5]->id}}</span>

                                    </td>

                                    @else

                                    <td style="border:none;"></td>

                                    @endif

                                    @if(!empty($lims_product_list[4+$i*5]))

                                    <td class="product-img sound-btn" title="{{$lims_product_list[4+$i*5]->title}}" data-product ="{{$lims_product_list[4+$i*5]->id . ' (' . $lims_product_list[4+$i*5]->title . ')'}}">

                                    <img  src="{{ asset($lims_product_list[4+$i*5]->preview->media->url ?? 'uploads/default.png') }}" width="100%" />

                                        <p>{{$lims_product_list[4+$i*5]->title}}</p>

                                        <span>{{$lims_product_list[4+$i*5]->id}}</span>

                                    </td>

                                    @else

                                    <td style="border:none;"></td>

                                    @endif

                                </tr>

                            @endfor

                            </tbody>

                        </table>

                    </div>

              </div>

            </div>

            <!-- product edit modal -->

            <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 id="modal_header" class="modal-title"></h5>

                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                        </div>

                        <div class="modal-body">

                            <form>

                                <div class="form-group">

                                    <label>{{trans('Quantity')}}</label>

                                    <input type="text" name="edit_qty" class="form-control numkey">

                                </div>

                                <div class="form-group">

                                    <label>{{trans('Unit Discount')}}</label>

                                    <input type="text" name="edit_discount" class="form-control numkey">

                                </div>

                                <div class="form-group">

                                    <label>{{trans('Unit Price')}}</label>

                                    <input type="text" name="edit_unit_price" class="form-control numkey" step="any">

                                </div>

                                <?php

                        $tax_name_all[] = 'No Tax';

                        $tax_rate_all[] = 0;

                        foreach($lims_tax_list as $tax) {

                            $tax_name_all[] = $tax->name;

                            $tax_rate_all[] = $tax->rate;

                        }

                    ?>

                                    <div class="form-group">

                                        <label>{{trans('Tax Rate')}}</label>

                                        <select name="edit_tax_rate" class="form-control selectpicker">

                                            @foreach($tax_name_all as $key => $name)

                                            <option value="{{$key}}">{{$name}}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <div id="edit_unit" class="form-group">

                                        <label>{{trans('Product Unit')}}</label>

                                        <select name="edit_unit" class="form-control selectpicker">

                                        </select>

                                    </div>

                                    <button type="button" name="update_btn" class="btn btn-primary">{{trans('update')}}</button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <!-- add customer modal -->

            <div id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                  <div class="modal-content">

                     

                    <form class="basicform_with_reset" action="{{ route('seller.customer.store') }}" method="post" @if(Session::get('locale') == 'ar') style="direction:rtl;"  @endif>
          @csrf  

                    <div class="modal-header">

                      <h5 id="exampleModalLabel" class="modal-title">{{trans('Add Customer')}}</h5>

                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                    </div>

                    <div class="modal-body">

                     

                       
<div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Name') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="name">
          </div>
        </div>

         <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Email') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="email" class="form-control" required="" name="email">
          </div>
        </div>

        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Password') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="password" class="form-control" required="" name="password">
          </div>
        </div>
                       
 

                       
<div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
          <div class="col-sm-12 col-md-7">
            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
          </div>
        </div>

                    </div>

                    {{ Form::close() }}

                  </div>

                </div>

            </div>

            <!-- recent transaction modal -->

         

            <!-- add cash register modal -->

            <div id="cash-register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                  <div class="modal-content">

                    {!! Form::open(['cashRegister.store', 'method' => 'post']) !!}

                    <div class="modal-header">

                      <h5 id="exampleModalLabel" class="modal-title">{{trans('Add Cash Register')}}</h5>

                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                    </div>

                    <div class="modal-body">

                      <p class="italic"><small>{{trans('The field labels marked with * are required input fields')}}.</small></p>

                        <div class="row">

                          <div class="col-md-6 form-group warehouse-section">

                              <label>{{trans('Warehouse')}} *</strong> </label>

                              <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">

                                 

                              </select>

                          </div>

                          <div class="col-md-6 form-group">

                              <label>{{trans('Cash in Hand')}} *</strong> </label>

                              <input type="number" name="cash_in_hand" required class="form-control">

                          </div>

                          <div class="col-md-12 form-group">

                              <button type="submit" class="btn btn-primary">{{trans('submit')}}</button>

                          </div>

                        </div>

                    </div>

                    {{ Form::close() }}

                  </div>

                </div>

            </div>

            <!-- cash register details modal -->

            <div id="register-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                  <div class="modal-content">

                    <div class="modal-header">

                      <h5 id="exampleModalLabel" class="modal-title">{{trans('Cash Register Details')}}</h5>

                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                    </div>

                    <div class="modal-body">

                      <p>{{trans('Please review the transaction and payments.')}}</p>

                        <div class="row">

                            <div class="col-md-12">

                                <table class="table table-hover">

                                    <tbody>

                                        <tr>

                                          <td>{{trans('Cash in Hand')}}:</td>

                                          <td id="cash_in_hand" class="text-right">0</td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Total Sale Amount')}}:</td>

                                          <td id="total_sale_amount" class="text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Total Payment')}}:</td>

                                          <td id="total_payment" class="text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Cash Payment')}}:</td>

                                          <td id="cash_payment" class="text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Credit Card Payment')}}:</td>

                                          <td id="credit_card_payment" class="text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Cheque Payment')}}:</td>

                                          <td id="cheque_payment" class="text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Gift Card Payment')}}:</td>

                                          <td id="gift_card_payment" class="text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Paypal Payment')}}:</td>

                                          <td id="paypal_payment" class="text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Total Sale Return')}}:</td>

                                          <td id="total_sale_return" class="text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Total Expense')}}:</td>

                                          <td id="total_expense" class="text-right"></td>

                                        </tr>

                                        <tr>

                                          <td><strong>{{trans('Total Cash')}}:</strong></td>

                                          <td id="total_cash" class="text-right"></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-md-6" id="closing-section">

                              <form action="cashRegister.close" method="POST">

                                  @csrf

                                  <input type="hidden" name="cash_register_id">

                                  <button type="submit" class="btn btn-primary">{{trans('Close Register')}}</button>

                              </form>

                            </div>

                        </div>

                    </div>

                  </div>

                </div>

            </div>

            <!-- today sale modal -->

            <div id="today-sale-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                  <div class="modal-content">

                    <div class="modal-header">

                      <h5 id="exampleModalLabel" class="modal-title">{{trans('Today Sale')}}</h5>

                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                    </div>

                    <div class="modal-body">

                      <p>{{trans('Please review the transaction and payments.')}}</p>

                        <div class="row">

                            <div class="col-md-12">

                                <table class="table table-hover">

                                    <tbody>

                                        <tr>

                                          <td>{{trans('Total Sale Amount')}}:</td>

                                          <td class="total_sale_amount text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Cash Payment')}}:</td>

                                          <td class="cash_payment text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Credit Card Payment')}}:</td>

                                          <td class="credit_card_payment text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Cheque Payment')}}:</td>

                                          <td class="cheque_payment text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Gift Card Payment')}}:</td>

                                          <td class="gift_card_payment text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Paypal Payment')}}:</td>

                                          <td class="paypal_payment text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Total Payment')}}:</td>

                                          <td class="total_payment text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Total Sale Return')}}:</td>

                                          <td class="total_sale_return text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Total Expense')}}:</td>

                                          <td class="total_expense text-right"></td>

                                        </tr>

                                        <tr>

                                          <td><strong>{{trans('Total Cash')}}:</strong></td>

                                          <td class="total_cash text-right"></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                  </div>

                </div>

            </div>

            <!-- today profit modal -->

            <div id="today-profit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">

                <div role="document" class="modal-dialog">

                  <div class="modal-content">

                    <div class="modal-header">

                      <h5 id="exampleModalLabel" class="modal-title">{{trans('Today Profit')}}</h5>

                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>

                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6">

                                <select required name="warehouseId" class="form-control">

                                    <option value="0">{{trans('All Warehouse')}}</option>

                              

                                    <option value="warehouse">warehouse</option>

                               

                                </select>

                            </div>

                            <div class="col-md-12 mt-2">

                                <table class="table table-hover">

                                    <tbody>

                                        <tr>

                                          <td>{{trans('Product Revenue')}}:</td>

                                          <td class="product_revenue text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Product Cost')}}:</td>

                                          <td class="product_cost text-right"></td>

                                        </tr>

                                        <tr>

                                          <td>{{trans('Expense')}}:</td>

                                          <td class="expense_amount text-right"></td>

                                        </tr>

                                        <tr>

                                          <td><strong>{{trans('Profit')}}:</strong></td>

                                          <td class="profit text-right"></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                  </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Button trigger modal -->
<button   style="display:none" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"  id="control-qid13228">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('please select variant')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
             <span class="cart_sucess"></span>
                
               </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button> &nbsp; &nbsp;
        <button type="button" class="btn btn-primary">{{__('Save changes')}}</button>
      </div>
    </div>
  </div>
</div>

</section>
  

 <script type="text/javascript">

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-pos-menu").addClass("active");

    var public_key = <?php echo json_encode($lims_pos_setting_data->stripe_public_key) ?>;
    var alert_product = <?php echo json_encode($alert_product) ?>;
    var currency = <?php echo json_encode($currency) ?>;
    var valid;

// array data depend on warehouse
var lims_product_array = [];
var product_code = [];
var product_name = [];
var product_qty = [];
var product_type = [];
var product_id = [];
var product_list = [];
var qty_list = [];

// array data with selection
var product_price = [];
var product_discount = [];
var tax_rate = [];
var tax_name = [];
var tax_method = [];
var unit_name = [];
var unit_operator = [];
var unit_operation_value = [];
var gift_card_amount = [];
var gift_card_expense = [];

// temporary array
var temp_unit_name = [];
var temp_unit_operator = [];
var temp_unit_operation_value = [];

var deposit = <?php echo json_encode($deposit) ?>;
var product_row_number = <?php echo json_encode($lims_pos_setting_data->product_number) ?>;
var rowindex;
var customer_group_rate;
var row_product_price;
var pos;
var keyboard_active = <?php echo json_encode($keybord_active); ?>;
var role_id = <?php echo json_encode(\Auth::user()->role_id) ?>;
var warehouse_id = <?php echo json_encode(\Auth::user()->warehouse_id) ?>;
var biller_id = <?php echo json_encode(\Auth::user()->biller_id) ?>;
var coupon_list = <?php echo json_encode($lims_coupon_list) ?>;
var currency = <?php echo json_encode($currency) ?>;

$('.selectpicker').selectpicker({
    style: 'btn-link',
});

if(keyboard_active==1){

    $("input.numkey:text").keyboard({
        usePreview: false,
        layout: 'custom',
        display: {
        'accept'  : '&#10004;',
        'cancel'  : '&#10006;'
        },
        customLayout : {
          'normal' : ['1 2 3', '4 5 6', '7 8 9','0 {dec} {bksp}','{clear} {cancel} {accept}']
        },
        restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
        preventPaste : true,  // prevent ctrl-v and right click
        autoAccept : true,
        css: {
            // input & preview
            // keyboard container
            container: 'center-block dropdown-menu', // jumbotron
            // default state
            buttonDefault: 'btn btn-default',
            // hovered button
            buttonHover: 'btn-primary',
            // Action keys (e.g. Accept, Cancel, Tab, etc);
            // this replaces "actionClass" option
            buttonAction: 'active'
        },
    });

    $('input[type="text"]').keyboard({
        usePreview: false,
        autoAccept: true,
        autoAcceptOnEsc: true,
        css: {
            // input & preview
            // keyboard container
            container: 'center-block dropdown-menu', // jumbotron
            // default state
            buttonDefault: 'btn btn-default',
            // hovered button
            buttonHover: 'btn-primary',
            // Action keys (e.g. Accept, Cancel, Tab, etc);
            // this replaces "actionClass" option
            buttonAction: 'active',
            // used when disabling the decimal button {dec}
            // when a decimal exists in the input area
            buttonDisabled: 'disabled'
        },
        change: function(e, keyboard) {
                keyboard.$el.val(keyboard.$preview.val())
                keyboard.$el.trigger('propertychange')        
              }
    });

    $('textarea').keyboard({
        usePreview: false,
        autoAccept: true,
        autoAcceptOnEsc: true,
        css: {
            // input & preview
            // keyboard container
            container: 'center-block dropdown-menu', // jumbotron
            // default state
            buttonDefault: 'btn btn-default',
            // hovered button
            buttonHover: 'btn-primary',
            // Action keys (e.g. Accept, Cancel, Tab, etc);
            // this replaces "actionClass" option
            buttonAction: 'active',
            // used when disabling the decimal button {dec}
            // when a decimal exists in the input area
            buttonDisabled: 'disabled'
        },
        change: function(e, keyboard) {
                keyboard.$el.val(keyboard.$preview.val())
                keyboard.$el.trigger('propertychange')        
              }
    });

    $('#lims_productcodeSearch').keyboard().autocomplete().addAutocomplete({
        // add autocomplete window positioning
        // options here (using position utility)
        position: {
          of: '#lims_productcodeSearch',
          my: 'top+18px',
          at: 'center',
          collision: 'flip'
        }
    });
}

  $("li#notification-icon").on("click", function (argument) {
      $.get('notifications/mark-as-read', function(data) {
          $("span.notification-number").text(alert_product);
      });
  });

  $("#register-details-btn").on("click", function (e) {
      e.preventDefault();
      $.ajax({
          url: 'cash-register/showDetails/'+warehouse_id,
          type: "GET",
          success:function(data) {
              $('#register-details-modal #cash_in_hand').text(data['cash_in_hand']);
              $('#register-details-modal #total_sale_amount').text(data['total_sale_amount']);
              $('#register-details-modal #total_payment').text(data['total_payment']);
              $('#register-details-modal #cash_payment').text(data['cash_payment']);
              $('#register-details-modal #credit_card_payment').text(data['credit_card_payment']);
              $('#register-details-modal #cheque_payment').text(data['cheque_payment']);
              $('#register-details-modal #gift_card_payment').text(data['gift_card_payment']);
              $('#register-details-modal #paypal_payment').text(data['paypal_payment']);
              $('#register-details-modal #total_sale_return').text(data['total_sale_return']);
              $('#register-details-modal #total_expense').text(data['total_expense']);
              $('#register-details-modal #total_cash').text(data['total_cash']);
              $('#register-details-modal input[name=cash_register_id]').val(data['id']);
          }
      });
      $('#register-details-modal').modal('show');
  });

  $("#today-sale-btn").on("click", function (e) {
      e.preventDefault();
      $.ajax({
          url: 'sales/today-sale/',
          type: "GET",
          success:function(data) {
              $('#today-sale-modal .total_sale_amount').text(data['total_sale_amount']);
              $('#today-sale-modal .total_payment').text(data['total_payment']);
              $('#today-sale-modal .cash_payment').text(data['cash_payment']);
              $('#today-sale-modal .credit_card_payment').text(data['credit_card_payment']);
              $('#today-sale-modal .cheque_payment').text(data['cheque_payment']);
              $('#today-sale-modal .gift_card_payment').text(data['gift_card_payment']);
              $('#today-sale-modal .paypal_payment').text(data['paypal_payment']);
              $('#today-sale-modal .total_sale_return').text(data['total_sale_return']);
              $('#today-sale-modal .total_expense').text(data['total_expense']);
              $('#today-sale-modal .total_cash').text(data['total_cash']);
          }
      });
      $('#today-sale-modal').modal('show');
  });

  $("#today-profit-btn").on("click", function (e) {
      e.preventDefault();
      calculateTodayProfit(0);
  });

  $("#today-profit-modal select[name=warehouseId]").on("change", function() {
      calculateTodayProfit($(this).val());
  });

  function calculateTodayProfit(warehouse_id) {
      $.ajax({
            url: 'sales/today-profit/' + warehouse_id,
            type: "GET",
            success:function(data) {
                $('#today-profit-modal .product_revenue').text(data['product_revenue']);
                $('#today-profit-modal .product_cost').text(data['product_cost']);
                $('#today-profit-modal .expense_amount').text(data['expense_amount']);
                $('#today-profit-modal .profit').text(data['profit']);
            }
        });
      $('#today-profit-modal').modal('show');
  }

if(role_id > 2){
    $('#biller_id').addClass('d-none');
    $('#warehouse_id').addClass('d-none');
    $('select[name=warehouse_id]').val(warehouse_id);
    $('select[name=biller_id]').val(biller_id);
    isCashRegisterAvailable(warehouse_id);
}
else{
    warehouse_id = $("input[name='warehouse_id_hidden']").val();
    $('select[name=warehouse_id]').val($("input[name='warehouse_id_hidden']").val());
    $('select[name=biller_id]').val($("input[name='biller_id_hidden']").val());
}

$('select[name=customer_id]').val($("input[name='customer_id_hidden']").val());
$('.selectpicker').selectpicker('refresh');

var id = $("#customer_id").val();
$.get('sales/getcustomergroup/' + id, function(data) {
    customer_group_rate = (data / 100);
});

var id = $("#warehouse_id").val();
$.get('sales/getproduct/' + id, function(data) {
    lims_product_array = [];
    product_code = data[0];
    product_name = data[1];
    product_qty = data[2];
    product_type = data[3];
    product_id = data[4];
    product_list = data[5];
    qty_list = data[6];
    product_warehouse_price = data[7];
    $.each(product_code, function(index) {
        lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
    });
});

isCashRegisterAvailable(id);

function isCashRegisterAvailable(warehouse_id) {
    $.ajax({
        url: 'cash-register/check-availability/'+warehouse_id,
        type: "GET",
        success:function(data) {
            if(data == 'false') {
              $("#register-details-btn").addClass('d-none');
              $('#cash-register-modal select[name=warehouse_id]').val(warehouse_id);

              if(role_id <= 2)
                $("#cash-register-modal .warehouse-section").removeClass('d-none');
              else
                $("#cash-register-modal .warehouse-section").addClass('d-none');

              $('.selectpicker').selectpicker('refresh');
              $("#cash-register-modal").modal('show');
            }
            else
              $("#register-details-btn").removeClass('d-none');
        }
    });
}

if(keyboard_active==1){
    $('#lims_productcodeSearch').bind('keyboardChange', function (e, keyboard, el) {
        var customer_id = $('#customer_id').val();
        var warehouse_id = $('select[name="warehouse_id"]').val();
        temp_data = $('#lims_productcodeSearch').val();
        if(!customer_id){
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            alert('Please select Customer!');
        }
        
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
             
        
    });
}
else{
    $('#lims_productcodeSearch').on('input', function(){
        var customer_id = $('#customer_id').val();
        var warehouse_id = $('#warehouse_id').val();
        temp_data = $('#lims_productcodeSearch').val();
        if(!customer_id){
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            alert('Please select Customer!');
        }
       
            $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
            
        

    });
}

$("#print-btn").on("click", function(){
      var divToPrint=document.getElementById('sale-details');
      var newWin=window.open('','Print-Window');
      newWin.document.open();
      newWin.document.write('<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
      newWin.document.close();
      setTimeout(function(){newWin.close();},10);
});

$('body').on('click', function(e){
    $('.filter-window').hide('slide', {direction: 'right'}, 'fast');
});

$('#category-filter').on('click', function(e){
    e.stopPropagation();
    $('.filter-window').show('slide', {direction: 'right'}, 'fast');
    $('.category').show();
    $('.brand').hide();
});

$('.category-img').on('click', function(){
    var category_id = $(this).data('category');
    var brand_id = 0;

    $(".table-container").children().remove();
    $.get('sales/getproduct/' + category_id + '/' + brand_id, function(data) {
        populateProduct(data);
    });
});

$('#brand-filter').on('click', function(e){
    e.stopPropagation();
    $('.filter-window').show('slide', {direction: 'right'}, 'fast');
    $('.brand').show();
    $('.category').hide();
});

$('.brand-img').on('click', function(){
    var brand_id = $(this).data('brand');
    var category_id = 0;

    $(".table-container").children().remove();
    $.get('sales/getproduct/' + category_id + '/' + brand_id, function(data) {
        populateProduct(data);
    });
});

$('#featured-filter').on('click', function(){
    $(".table-container").children().remove();
    $.get('sales/getfeatured', function(data) {
        populateProduct(data);
    });
});

function populateProduct(data) {
    var tableData = '<table id="product-table" class="table no-shadow product-list"> <thead class="d-none"> <tr> <th></th> <th></th> <th></th> <th></th> <th></th> </tr></thead> <tbody><tr>';

    if (Object.keys(data).length != 0) {
        $.each(data['name'], function(index) {
            var product_info = data['code'][index]+' (' + data['name'][index] + ')';
            if(index % 5 == 0 && index != 0)
                tableData += '</tr><tr><td class="product-img sound-btn" title="'+data['name'][index]+'" data-product = "'+product_info+'"><img  src="public/images/product/'+data['image'][index]+'" width="100%" /><p>'+data['name'][index]+'</p><span>'+data['code'][index]+'</span></td>';
            else
                tableData += '<td class="product-img sound-btn" title="'+data['name'][index]+'" data-product = "'+product_info+'"><img  src="public/images/product/'+data['image'][index]+'" width="100%" /><p>'+data['name'][index]+'</p><span>'+data['code'][index]+'</span></td>';
        });

        if(data['name'].length % 5){
            var number = 5 - (data['name'].length % 5);
            while(number > 0)
            {
                tableData += '<td style="border:none;"></td>';
                number--;
            }
        }

        tableData += '</tr></tbody></table>';
        $(".table-container").html(tableData);
        $('#product-table').DataTable( {
          "order": [],
          'pageLength': product_row_number,
           'language': {
              'paginate': {
                  'previous': '<i class="fa fa-angle-left"></i>',
                  'next': '<i class="fa fa-angle-right"></i>'
              }
          },
          dom: 'tp'
        });
        $('table.product-list').hide();
        $('table.product-list').show(500);
    }
    else{
        tableData += '<td class="text-center">No data avaialable</td></tr></tbody></table>'
        $(".table-container").html(tableData);
    }
}

$('select[name="customer_id"]').on('change', function() {
    var id = $(this).val();
    $.get('sales/getcustomergroup/' + id, function(data) {
        customer_group_rate = (data / 100);
    });
});

$('select[name="warehouse_id"]').on('change', function() {
    warehouse_id = $(this).val();
    $.get('sales/getproduct/' + warehouse_id, function(data) {
        lims_product_array = [];
        product_code = data[0];
        product_name = data[1];
        product_qty = data[2];
        product_type = data[3];
        $.each(product_code, function(index) {
            lims_product_array.push(product_code[index] + ' (' + product_name[index] + ')');
        });
    });

    isCashRegisterAvailable(warehouse_id);
});

var lims_productcodeSearch = $('#lims_productcodeSearch');

lims_productcodeSearch.autocomplete({
    source: function(request, response) {
        var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
        response($.grep(lims_product_array, function(item) {
            return matcher.test(item);
        }));
    },
    response: function(event, ui) {
        if (ui.content.length == 1) {
            var data = ui.content[0].value;
            $(this).autocomplete( "close" );
            productSearch(data);
        };
    },
    select: function(event, ui) {
        var data = ui.item.value;
        productSearch(data);
    },
});

$('#myTable').keyboard({
        accepted : function(event, keyboard, el) {
            checkQuantity(el.value, true);
      }
    });

$("#myTable").on('click', '.plus', function() {
    rowindex = $(this).closest('tr').index();
    var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();

    if(!qty)
      qty = 1;
    else
      qty = parseFloat(qty) + 1;

    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
    checkQuantity(String(qty), true);
});

$("#myTable").on('click', '.minus', function() {
    rowindex = $(this).closest('tr').index();
    var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) - 1;
    if (qty > 0) {
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
    } else {
        qty = 1;
    }
    checkQuantity(String(qty), true);
});

//Change quantity
$("#myTable").on('input', '.qty', function() {
    rowindex = $(this).closest('tr').index();
    if($(this).val() < 1 && $(this).val() != '') {
      $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
      alert("Quantity can't be less than 1");
    }
    checkQuantity($(this).val(), true);
});

$("#myTable").on('click', '.qty', function() {
    rowindex = $(this).closest('tr').index();
});

$(document).on('click', '.sound-btn', function() {
    var audio = $("#mysoundclip1")[0];
    audio.play();
});

$(document).on('click', '.product-img', function() {



    var customer_id = $('#customer_id').val();



    var warehouse_id = $('select[name="warehouse_id"]').val();




    if(!customer_id)

        alert('Please select Customer!');

  

    else{

        var data = $(this).data('product');



        data = data.split(" ");



        pos = product_code.indexOf(data[0]);



         productSearch(data[0]);

    }

});
//Delete product
$("table.order-list tbody").on("click", ".ibtnDel", function(event) {
    var audio = $("#mysoundclip2")[0];
    audio.play();
    rowindex = $(this).closest('tr').index();
    product_price.splice(rowindex, 1);
    product_discount.splice(rowindex, 1);
    tax_rate.splice(rowindex, 1);
    tax_name.splice(rowindex, 1);
    tax_method.splice(rowindex, 1);
    unit_name.splice(rowindex, 1);
    unit_operator.splice(rowindex, 1);
    unit_operation_value.splice(rowindex, 1);
    $(this).closest("tr").remove();
    calculateTotal();
});

//Edit product
$("table.order-list").on("click", ".edit-product", function() {
    rowindex = $(this).closest('tr').index();
    edit();
});

//Update product
$('button[name="update_btn"]').on("click", function() {
    var edit_discount = $('input[name="edit_discount"]').val();
    var edit_qty = $('input[name="edit_qty"]').val();
    var edit_unit_price = $('input[name="edit_unit_price"]').val();

    if (parseFloat(edit_discount) > parseFloat(edit_unit_price)) {
        alert('Invalid Discount Input!');
        return;
    }

    if(edit_qty < 1) {
        $('input[name="edit_qty"]').val(1);
        edit_qty = 1;
        alert("Quantity can't be less than 1");
    }
    
    var tax_rate_all = <?php echo json_encode($tax_rate_all) ?>;

    tax_rate[rowindex] = parseFloat(tax_rate_all[$('select[name="edit_tax_rate"]').val()]);
    tax_name[rowindex] = $('select[name="edit_tax_rate"] option:selected').text();

    product_discount[rowindex] = $('input[name="edit_discount"]').val();
    if(product_type[pos] == 'standard'){
        var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
        var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));
        if (row_unit_operator == '*') {
            product_price[rowindex] = $('input[name="edit_unit_price"]').val() / row_unit_operation_value;
        } else {
            product_price[rowindex] = $('input[name="edit_unit_price"]').val() * row_unit_operation_value;
        }
        var position = $('select[name="edit_unit"]').val();
        var temp_operator = temp_unit_operator[position];
        var temp_operation_value = temp_unit_operation_value[position];
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sale-unit').val(temp_unit_name[position]);
        temp_unit_name.splice(position, 1);
        temp_unit_operator.splice(position, 1);
        temp_unit_operation_value.splice(position, 1);

        temp_unit_name.unshift($('select[name="edit_unit"] option:selected').text());
        temp_unit_operator.unshift(temp_operator);
        temp_unit_operation_value.unshift(temp_operation_value);

        unit_name[rowindex] = temp_unit_name.toString() + ',';
        unit_operator[rowindex] = temp_unit_operator.toString() + ',';
        unit_operation_value[rowindex] = temp_unit_operation_value.toString() + ',';
    }
    checkQuantity(edit_qty, false);
});

$('button[name="order_discount_btn"]').on("click", function() {
    calculateGrandTotal();
});

$('button[name="shipping_cost_btn"]').on("click", function() {
    calculateGrandTotal();
});

$('button[name="order_tax_btn"]').on("click", function() {
    calculateGrandTotal();
});

$(".coupon-check").on("click",function() {
    couponDiscount();
});

$(".payment-btn").on("click", function() {
    var audio = $("#mysoundclip2")[0];
    audio.play();
    $('input[name="paid_amount"]').val($("#grand-total").text());
    $('input[name="paying_amount"]').val($("#grand-total").text());
    $('.qc').data('initial', 1);
});

$("#draft-btn").on("click",function(){
    var audio = $("#mysoundclip2")[0];
    audio.play();
    $('input[name="sale_status"]').val(3);
    $('input[name="paying_amount"]').prop('required',false);
    $('input[name="paid_amount"]').prop('required',false);
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        alert("Please insert product to order table!")
    }
    else
        $('.payment-form').submit();
});

$("#submit-btn").on("click", function() {
    $('.payment-form').submit();
});

$("#gift-card-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(2);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    giftCard();
});

$("#credit-card-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(3);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    creditCard();
});

$("#cheque-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(4);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    cheque();
});

$("#cash-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(1);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').show();
    hide();
});

$("#paypal-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(5);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    hide();
});

$("#deposit-btn").on("click",function() {
    $('select[name="paid_by_id_select"]').val(6);
    $('.selectpicker').selectpicker('refresh');
    $('div.qc').hide();
    hide();
    deposits();
});

$('select[name="paid_by_id_select"]').on("change", function() {       
    var id = $(this).val();
    $(".payment-form").off("submit");
    if(id == 2) {
        $('div.qc').hide();
        giftCard();
    }
    else if (id == 3) {
        $('div.qc').hide();
        creditCard();
    } else if (id == 4) {
        $('div.qc').hide();
        cheque();
    } else {
        hide();
        if(id == 1)
            $('div.qc').show();
        else if(id == 6) {
            $('div.qc').hide();
            deposits();
        }
    }
});

$('#add-payment select[name="gift_card_id_select"]').on("change", function() {
    var balance = gift_card_amount[$(this).val()] - gift_card_expense[$(this).val()];
    $('#add-payment input[name="gift_card_id"]').val($(this).val());
    if($('input[name="paid_amount"]').val() > balance){
        alert('Amount exceeds card balance! Gift Card balance: '+ balance);
    }
});

$('#add-payment input[name="paying_amount"]').on("input", function() {
    change($(this).val(), $('input[name="paid_amount"]').val());
});

$('input[name="paid_amount"]').on("input", function() {
    if( $(this).val() > parseFloat($('input[name="paying_amount"]').val()) ) {
        alert('Paying amount cannot be bigger than recieved amount');
        $(this).val('');
    }
    else if( $(this).val() > parseFloat($('#grand-total').text()) ){
        alert('Paying amount cannot be bigger than grand total');
        $(this).val('');
    }

    change( $('input[name="paying_amount"]').val(), $(this).val() );
    var id = $('select[name="paid_by_id_select"]').val();
    if(id == 2){
        var balance = gift_card_amount[$("#gift_card_id_select").val()] - gift_card_expense[$("#gift_card_id_select").val()];
        if($(this).val() > balance)
            alert('Amount exceeds card balance! Gift Card balance: '+ balance);
    }
    else if(id == 6){
        if( $('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()] )
            alert('Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
    }
});

$('.transaction-btn-plus').on("click", function() {
    $(this).addClass('d-none');
    $('.transaction-btn-close').removeClass('d-none');
});

$('.transaction-btn-close').on("click", function() {
    $(this).addClass('d-none');
    $('.transaction-btn-plus').removeClass('d-none');
});

$('.coupon-btn-plus').on("click", function() {
    $(this).addClass('d-none');
    $('.coupon-btn-close').removeClass('d-none');
});

$('.coupon-btn-close').on("click", function() {
    $(this).addClass('d-none');
    $('.coupon-btn-plus').removeClass('d-none');
});

$(document).on('click', '.qc-btn', function(e) {
    if($(this).data('amount')) {
        if($('.qc').data('initial')) {
            $('input[name="paying_amount"]').val( $(this).data('amount').toFixed(2) );
            $('.qc').data('initial', 0);
        }
        else {
            $('input[name="paying_amount"]').val( (parseFloat($('input[name="paying_amount"]').val()) + $(this).data('amount')).toFixed(2) );
        }
    }
    else
        $('input[name="paying_amount"]').val('0.00');
    change( $('input[name="paying_amount"]').val(), $('input[name="paid_amount"]').val() );
});

function change(paying_amount, paid_amount) {
    $("#change").text( parseFloat(paying_amount - paid_amount).toFixed(2) );
}

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}


function productSearch(data) {



    $.ajax({

        type: 'GET',

        url: 'sales/lims_product_search',

        data: {

            data: data

        },

        success: function(data) {





            var flag = 1;

            $(".product-code").each(function(i) {
                 

            

                if ($(this).val() == data[1]) {



                    rowindex = i;

                    var pre_qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val();

                    if(pre_qty)

                        var qty = parseFloat(pre_qty) + 1;

                    else

                        var qty = 1;

                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);

                    flag = 0;

                    checkQuantity(String(qty), true);

                    flag = 0;

                }

            });

            $("input[name='product_code_name']").val('');


            if(flag){

                addNewProduct(data);

               


                  CallVariant(data[0]);


                

            }

        }

    });

}

        function CallVariant(id) 
        {
             $.ajax({
            url:"{{url('/seller/get_variant')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:id,

           },
            dataType:"html",
            beforeSend:function(){
             $('.cart_sucess').html('');  
                      
                      
            },
            success:function(data)
            {
                   
             
             $('.cart_sucess').html(data);  

                $("#control-qid13228").click();


                 
            }
        });
             return false;
        }

function addNewProduct(data){

    var newRow = $("<tr>");

    var cols = '';

    temp_unit_name = (data[6]).split(',');

    cols += '<td class="col-sm-4 product-title"><button type="button" class="edit-product btn btn-link" data-toggle="modal" data-target="#editModal"><strong>' + data[0] + '</strong></button> [' + data[1] + '] <p>In Stock: <span class="in-stock"></span></p></td>';

    cols += '<td class="col-sm-2 product-price"></td>';

    cols += '<td class="col-sm-3"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default minus"><span class="dripicons-minus"></span></button></span><input type="text" name="qty[]" class="form-control qty numkey input-number" value="1" step="any" required><span class="input-group-btn"><button type="button" class="btn btn-default plus"><span class="dripicons-plus"></span></button></span></div></td>';

    cols += '<td class="col-sm-2 sub-total"></td>';

    cols += '<td class="col-sm-1"><button type="button" class="ibtnDel btn btn-danger btn-sm"><i class="dripicons-cross"></i></button></td>';

    cols += '<input type="hidden" class="product-code" name="product_code[]" value="' + data[1] + '"/>';

    cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[8] + '"/>';

    cols += '<input type="hidden" class="sale-unit" name="sale_unit[]" value="' + temp_unit_name[0] + '"/>';

    cols += '<input type="hidden" class="net_unit_price" name="net_unit_price[]" />';

    cols += '<input type="hidden" class="discount-value" name="discount[]" />';

    cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="' + data[3] + '"/>';

    cols += '<input type="hidden" class="tax-value" name="tax[]" />';

    cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';



    newRow.append(cols);

    if(keyboard_active==1){

        $("table.order-list tbody").append(newRow).find('.qty').keyboard({usePreview: false, layout: 'custom', display: { 'accept'  : '&#10004;', 'cancel'  : '&#10006;' }, customLayout : {

          'normal' : ['1 2 3', '4 5 6', '7 8 9','0 {dec} {bksp}','{clear} {cancel} {accept}']}, restrictInput : true, preventPaste : true, autoAccept : true, css: { container: 'center-block dropdown-menu', buttonDefault: 'btn btn-default', buttonHover: 'btn-primary',buttonAction: 'active', buttonDisabled: 'disabled'},});

    }

    else

        $("table.order-list tbody").append(newRow);



    pos = product_code.indexOf(data[1]);

   product_price.push(parseFloat(data[2] ));

    product_discount.push('0.00');

    tax_rate.push(parseFloat(data[3]));

    tax_name.push(data[4]);

    tax_method.push(data[5]);

    unit_name.push(data[6]);

    unit_operator.push(data[7]);

    unit_operation_value.push(data[8]);

    rowindex = newRow.index();

    checkQuantity(1, true);

         

}



function edit(){
    var row_product_name_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1)').text();
    $('#modal_header').text(row_product_name_code);

    var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
    $('input[name="edit_qty"]').val(qty);

    $('input[name="edit_discount"]').val(parseFloat(product_discount[rowindex]).toFixed(2));

    var tax_name_all = <?php echo json_encode($tax_name_all) ?>;
    pos = tax_name_all.indexOf(tax_name[rowindex]);
    $('select[name="edit_tax_rate"]').val(pos);

    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
    pos = product_code.indexOf(row_product_code);
    if(product_type[pos] == 'standard'){
        unitConversion();
        temp_unit_name = (unit_name[rowindex]).split(',');
        temp_unit_name.pop();
        temp_unit_operator = (unit_operator[rowindex]).split(',');
        temp_unit_operator.pop();
        temp_unit_operation_value = (unit_operation_value[rowindex]).split(',');
        temp_unit_operation_value.pop();
        $('select[name="edit_unit"]').empty();
        $.each(temp_unit_name, function(key, value) {
            $('select[name="edit_unit"]').append('<option value="' + key + '">' + value + '</option>');
        });
        $("#edit_unit").show();
    }
    else{
        row_product_price = product_price[rowindex];
        $("#edit_unit").hide();
    }
    $('input[name="edit_unit_price"]').val(row_product_price.toFixed(2));
    $('.selectpicker').selectpicker('refresh');
}

function couponDiscount() {
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        alert("Please insert product to order table!")
    }
    else if($("#coupon-code").val() != ''){
        valid = 0;
        $.each(coupon_list, function(key, value) {
            if($("#coupon-code").val() == value['code']){
                valid = 1;
                todyDate = <?php echo json_encode(date('Y-m-d'))?>;
                if(parseFloat(value['quantity']) <= parseFloat(value['used']))
                    alert('This Coupon is no longer available');
                else if(todyDate > value['expired_date'])
                    alert('This Coupon has expired!');
                else if(value['type'] == 'fixed'){
                    if(parseFloat($('input[name="grand_total"]').val()) >= value['minimum_amount']) {
                        $('input[name="grand_total"]').val($('input[name="grand_total"]').val() - value['amount']);
                        $('#grand-total').text(parseFloat($('input[name="grand_total"]').val()).toFixed(2));
                        if(!$('input[name="coupon_active"]').val())
                            alert('Congratulation! You got '+value['amount']+' '+currency+' discount');
                        $(".coupon-check").prop("disabled",true);
                        $("#coupon-code").prop("disabled",true);
                        $('input[name="coupon_active"]').val(1);
                        $("#coupon-modal").modal('hide');
                        $('input[name="coupon_id"]').val(value['id']);
                        $('input[name="coupon_discount"]').val(value['amount']);
                        $('#coupon-text').text(parseFloat(value['amount']).toFixed(2));
                    }
                    else
                        alert('Grand Total is not sufficient for discount! Required '+value['minimum_amount']+' '+currency);
                }
                else{
                    var grand_total = $('input[name="grand_total"]').val();
                    var coupon_discount = grand_total * (value['amount'] / 100);
                    grand_total = grand_total - coupon_discount;
                    $('input[name="grand_total"]').val(grand_total);
                    $('#grand-total').text(parseFloat(grand_total).toFixed(2));
                    if(!$('input[name="coupon_active"]').val())
                            alert('Congratulation! You got '+value['amount']+'% discount');
                    $(".coupon-check").prop("disabled",true);
                    $("#coupon-code").prop("disabled",true);
                    $('input[name="coupon_active"]').val(1);
                    $("#coupon-modal").modal('hide');
                    $('input[name="coupon_id"]').val(value['id']);
                    $('input[name="coupon_discount"]').val(coupon_discount);
                    $('#coupon-text').text(parseFloat(coupon_discount).toFixed(2));
                }
            }
        });
        if(!valid)
            alert('Invalid coupon code!');
    }
}

function checkQuantity(sale_qty, flag) {
    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
    pos = product_code.indexOf(row_product_code);
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.in-stock').text(product_qty[pos]);
    if(product_type[pos] == 'standard'){
        var operator = unit_operator[rowindex].split(',');
        var operation_value = unit_operation_value[rowindex].split(',');
        if(operator[0] == '*')
            total_qty = sale_qty * operation_value[0];
        else if(operator[0] == '/')
            total_qty = sale_qty / operation_value[0];
        if (total_qty > parseFloat(product_qty[pos])) {
            alert('Quantity exceeds stock quantity!');
            if (flag) {
                sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                checkQuantity(sale_qty, true);
            } else {
                edit();
                return;
            }
        }
    }
    else if(product_type[pos] == 'combo'){
        child_id = product_list[pos].split(',');
        child_qty = qty_list[pos].split(',');
        $(child_id).each(function(index) {
            var position = product_id.indexOf(parseInt(child_id[index]));
            if( parseFloat(sale_qty * child_qty[index]) > product_qty[position] ) {
                alert('Quantity exceeds stock quantity!');
                if (flag) {
                    sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                }
                else {
                    edit();
                    flag = true;
                    return false;
                }
            }
        });
    }

    if(!flag){
        $('#editModal').modal('hide');
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
    }
    calculateRowProductData(sale_qty);

}

function calculateRowProductData(quantity) {
    if(product_type[pos] == 'standard')
        unitConversion();
    else
        row_product_price = product_price[rowindex];

    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val((product_discount[rowindex] * quantity).toFixed(2));
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-rate').val(tax_rate[rowindex].toFixed(2));

    if (tax_method[rowindex] == 1) {
        var net_unit_price = row_product_price - product_discount[rowindex];
        var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
        var sub_total = (net_unit_price * quantity) + tax;
        
        if(parseFloat(quantity))
            var sub_total_unit = sub_total / quantity;
        else
            var sub_total_unit = sub_total;

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text(sub_total_unit.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(sub_total.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));
    } else {
        var sub_total_unit = row_product_price - product_discount[rowindex];
        var net_unit_price = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
        var tax = (sub_total_unit - net_unit_price) * quantity;
        var sub_total = sub_total_unit * quantity;

        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.net_unit_price').val(net_unit_price.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax-value').val(tax.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text(sub_total_unit.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(4)').text(sub_total.toFixed(2));
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.subtotal-value').val(sub_total.toFixed(2));
    }

    calculateTotal();
}

function unitConversion() {
    var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
    var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

    if (row_unit_operator == '*') {
        row_product_price = product_price[rowindex] * row_unit_operation_value;
    } else {
        row_product_price = product_price[rowindex] / row_unit_operation_value;
    }
}

function calculateTotal() {
    //Sum of quantity
    var total_qty = 0;
    $("table.order-list tbody .qty").each(function(index) {
        if ($(this).val() == '') {
            total_qty += 0;
        } else {
            total_qty += parseFloat($(this).val());
        }
    });
    $('input[name="total_qty"]').val(total_qty);

    //Sum of discount
    var total_discount = 0;
    $("table.order-list tbody .discount-value").each(function() {
        total_discount += parseFloat($(this).val());
    });

    $('input[name="total_discount"]').val(total_discount.toFixed(2));

    //Sum of tax
    var total_tax = 0;
    $(".tax-value").each(function() {
        total_tax += parseFloat($(this).val());
    });

    $('input[name="total_tax"]').val(total_tax.toFixed(2));

    //Sum of subtotal
    var total = 0;
    $(".sub-total").each(function() {
        total += parseFloat($(this).text());
    });
    $('input[name="total_price"]').val(total.toFixed(2));

    calculateGrandTotal();
}

function calculateGrandTotal() {
    var item = $('table.order-list tbody tr:last').index();
    var total_qty = parseFloat($('input[name="total_qty"]').val());
    var subtotal = parseFloat($('input[name="total_price"]').val());
    var order_tax = parseFloat($('select[name="order_tax_rate_select"]').val());
    var order_discount = parseFloat($('input[name="order_discount"]').val());
    if (!order_discount)
        order_discount = 0.00;
    $("#discount").text(order_discount.toFixed(2));

    var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
    if (!shipping_cost)
        shipping_cost = 0.00;

    item = ++item + '(' + total_qty + ')';
    order_tax = (subtotal - order_discount) * (order_tax / 100);
    var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;
    $('input[name="grand_total"]').val(grand_total.toFixed(2));

    couponDiscount();
    var coupon_discount = parseFloat($('input[name="coupon_discount"]').val());
    if (!coupon_discount)
        coupon_discount = 0.00;
    grand_total -= coupon_discount;

    $('#item').text(item);
    $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
    $('#subtotal').text(subtotal.toFixed(2));
    $('#tax').text(order_tax.toFixed(2));
    $('input[name="order_tax"]').val(order_tax.toFixed(2));
    $('#shipping-cost').text(shipping_cost.toFixed(2));
    $('#grand-total').text(grand_total.toFixed(2));
    $('input[name="grand_total"]').val(grand_total.toFixed(2));
}

function hide() {
    $(".card-element").hide();
    $(".card-errors").hide();
    $(".cheque").hide();
    $(".gift-card").hide();
    $('input[name="cheque_no"]').attr('required', false);
}

function giftCard() {
    $(".gift-card").show();
    $.ajax({
        url: 'sales/get_gift_card',
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#add-payment select[name="gift_card_id_select"]').empty();
            $.each(data, function(index) {
                gift_card_amount[data[index]['id']] = data[index]['amount'];
                gift_card_expense[data[index]['id']] = data[index]['expense'];
                $('#add-payment select[name="gift_card_id_select"]').append('<option value="'+ data[index]['id'] +'">'+ data[index]['card_no'] +'</option>');
            });
            $('.selectpicker').selectpicker('refresh');
            $('.selectpicker').selectpicker();
        }
    });
    $(".card-element").hide();
    $(".card-errors").hide();
    $(".cheque").hide();
    $('input[name="cheque_no"]').attr('required', false);
}

function cheque() {
    $(".cheque").show();
    $('input[name="cheque_no"]').attr('required', true);
    $(".card-element").hide();
    $(".card-errors").hide();
    $(".gift-card").hide();
}

function creditCard() {
    $.getScript( "public/vendor/stripe/checkout.js" );
    $(".card-element").show();
    $(".card-errors").show();
    $(".cheque").hide();
    $(".gift-card").hide();
    $('input[name="cheque_no"]').attr('required', false);
}

function deposits() {
    if($('input[name="paid_amount"]').val() > deposit[$('#customer_id').val()]){
        alert('Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
    }
    $('input[name="cheque_no"]').attr('required', false);
    $('#add-payment select[name="gift_card_id_select"]').attr('required', false);
}

function cancel(rownumber) {
    while(rownumber >= 0) {
        product_price.pop();
        product_discount.pop();
        tax_rate.pop();
        tax_name.pop();
        tax_method.pop();
        unit_name.pop();
        unit_operator.pop();
        unit_operation_value.pop();
        $('table.order-list tbody tr:last').remove();
        rownumber--;
    }
    $('input[name="shipping_cost"]').val('');
    $('input[name="order_discount"]').val('');
    $('select[name="order_tax_rate_select"]').val(0);
    calculateTotal();
}

function confirmCancel() {
    var audio = $("#mysoundclip2")[0];
    audio.play();
    if (confirm("Are you sure want to cancel?")) {
        cancel($('table.order-list tbody tr:last').index());
    }
    return false;
}

$(document).on('submit', '.payment-form', function(e) {
    var rownumber = $('table.order-list tbody tr:last').index();
    if (rownumber < 0) {
        alert("Please insert product to order table!")
        e.preventDefault();
    }
    else if( parseFloat( $('input[name="paying_amount"]').val() ) < parseFloat( $('input[name="paid_amount"]').val() ) ){
        alert('Paying amount cannot be bigger than recieved amount');
        e.preventDefault();
    }
    $('input[name="paid_by_id"]').val($('select[name="paid_by_id_select"]').val());
    $('input[name="order_tax_rate"]').val($('select[name="order_tax_rate_select"]').val());

});

$('#product-table').DataTable( {
    "order": [],
    'pageLength': product_row_number,
     'language': {
        'paginate': {
            'previous': '<i class="fa fa-angle-left"></i>',
            'next': '<i class="fa fa-angle-right"></i>'
        }
    },
    dom: 'tp'
});
</script>


@endsection

@section('scripts')

<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
 


   <script>
    $("#myid li").click(function() 
    {
    alert(this.id); // get id of clicked li
});
</script>



<script type="text/javascript">


    $(".ul li").click(function ()
{       
var a = $(this).attr("value");
  
   
      alert(a);

      return 0;
    


 
});
</script>




@endsection
