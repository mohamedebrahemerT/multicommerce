<!doctype html>
@if(app()->getLocale() == 'ar')
    <html dir="rtl" direction="rtl" lang="ar">
@else
    <html lang="en">
@endif
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/ar-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/ar-all.min.css') }}">
        {{--                <link href="//fonts.googleapis.com/css?family=Nunito:400,600,700,800" rel="stylesheet">--}}
        <link rel="stylesheet" href="{{ asset('assets/css/ar-style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font/ar-flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/ar-components.css') }}">
        <!--<link href="https://fonts.googleapis.com/css2?family=Tajawal" rel="stylesheet">-->
    @else
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    @endif

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon.ico') }}"/>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/moment.min.js')}}"></script>

        
<body>
    
  @stack('style')

 

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
       
  
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="{{ url('/seller/dashboard') }}"  class="nav-link nav-link-lg">{{__('back')}}</a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>

        </ul>
    </form>
    <ul class="navbar-nav navbar-right">

  @if(Auth::user()->name !== 'Admin')


  @if(Auth::user()->shop_type == 2)

<li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">

@php
$auth_id = getUserId();
$type = 1;
 $mytime = Carbon\Carbon::now();

 $postnot =App\Term::where('type', 'product')->
                     where('ExpiryDate','>',$mytime)->
                      where('user_id', $auth_id)->get();

     
 
$postscount = App\Term::where('type', 'product')->
                     where('ExpiryDate','>',$mytime)->
                      where('user_id', $auth_id)->count();




@endphp
                   <i class="fa fa-bell"></i>

<span style="position: absolute;
background: #ff4c3b;
width: 16px;
height: 18px;
color: #fff;
border-radius: 20px;
text-align: center;
font-size: 12px;
line-height: 14px;
font-weight: 600;
right: 6%;
padding: 3px;
top: -19%;" class="  wishlist_qty_cls">{{$postscount}}  </span>

                <div class="d-sm-none d-lg-inline-block">

                   
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" style="width:400px;">
                


                       @if($postnot->count()  > 0)
                       @foreach($postnot as $row)


        <a href="{{url('/')}}/seller/product/{{$row->id}}/edit" class="dropdown-item has-icon">
                            <i class="fa fa-bell"></i> 

                         {{__('ExpiryDate reached limit')}}    {{ $row->title }}
                        </a>
                 
                        @endforeach
                        @else
                         <a  class="dropdown-item has-icon" style="text-align:center;">
                        
{{__('No alert')}}
                         
                        </a>
 
                        @endif
                
               

                 
            </div>
        </li>
@endif


  @if(Auth::user()->shop_type == 1)

        <!------------------------------------------------------------>

  <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">

@php
$auth_id = getUserId();
$type = 1;
 $posts = App\Term::where('type', 'product')
 ->with('preview')
 ->with('stock')
 ->withCount('order')
 ->where('status', $type)
 ->where('user_id', $auth_id)->get();
   

   $id_p_ides=[];
foreach ($posts as $key => $value) 
      {

          if($value->stock->stock_qty  <=  $value->stock->Alarm_quantity )
          {
               array_push($id_p_ides,$value->id);
          }


    
           
        }
   
$postscount = App\Term::where('type', 'product')
 ->with('preview')
 ->with('stock')
 ->withCount('order')
 ->where('status', $type)
 ->whereIn('id',$id_p_ides)
 ->where('user_id', $auth_id)->count();

 
$postnot = App\Term::where('type', 'product')
 ->with('preview')
 ->with('stock')
 ->withCount('order')
 ->where('status', $type)
 ->whereIn('id',$id_p_ides)
 ->where('user_id', $auth_id)->get();




@endphp
                   <i class="fa fa-bell"></i>

<span style="position: absolute;
background: #ff4c3b;
width: 16px;
height: 18px;
color: #fff;
border-radius: 20px;
text-align: center;
font-size: 12px;
line-height: 14px;
font-weight: 600;
right: 6%;
padding: 3px;
top: -19%;" class="  wishlist_qty_cls">{{$postscount}}  </span>

                <div class="d-sm-none d-lg-inline-block">

                   
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" style="width:400px;">
                


                       @if($postnot->count()  > 0)
                       @foreach($postnot as $row)


        <a href="{{url('/')}}/seller/product/{{$row->id}}/edit" class="dropdown-item has-icon">
                            <i class="fa fa-bell"></i> 

                         {{__('quantity reached limit')}}    {{ $row->title }}
                        </a>
                 
                        @endforeach
                        @else
                         <a  class="dropdown-item has-icon" style="text-align:center;">
                        
{{__('No alert')}}
                         
                        </a>
 
                        @endif
                
               

                 
            </div>
        </li>



         <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">

@php
$user_id  = getUserId();
 

    $orderscount = App\Order::
    where('user_id', $user_id)
   ->with('customer')
   ->withCount('order_items')
   ->orderBy('id', 'DESC')->
    where('status','pending')
   ->count();

   $ordersget= App\Order::
    where('user_id', $user_id)
   ->with('customer')
   ->withCount('order_items')
   ->orderBy('id', 'DESC')->
    where('status','pending')
    ->take(5)
   ->get();

@endphp
                   <i class="fa fa-bell"></i>

<span style="position: absolute;
background: #ff4c3b;
width: 16px;
height: 18px;
color: #fff;
border-radius: 20px;
text-align: center;
font-size: 12px;
line-height: 14px;
font-weight: 600;
right: 6%;
padding: 3px;
top: -19%;" class="  wishlist_qty_cls">{{$orderscount}}  </span>

                <div class="d-sm-none d-lg-inline-block">

                   
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" style="width:400px;">
                


                       @if($ordersget->count()  > 0)
                       @foreach($ordersget as $row)


        <a href="{{url('/')}}/seller/order/{{$row->id}}" class="dropdown-item has-icon">
                            <i class="fa fa-bell"></i> 
            {{__('You have new order')}}.  {{$row->order_no}}  .
            ( {{$row->customer->name}}).
            {{ $row->total }}  {{__('SAR')}}
                        
                        </a>
                 
                        @endforeach
                        @else
                         <a  class="dropdown-item has-icon" style="text-align:center;">
                        
{{__('No alert')}}
                         
                        </a>
 
                        @endif
                
                <a href="{{url('/')}}/seller/orders/pending" class="dropdown-item has-icon">
                           <i class="fa fa-bell"></i>
            {{__('More')}} 
                        
                        </a>

                 
            </div>
        </li>
@endif

                        @endif

        <li>
            @if(Session::get('locale') == 'ar')
                <a href="{{ url('/admin/make_local') }}"></a>
            @else
            @endif
            <form class="translate_form" action="{{ url('/admin/make_local') }}">
                @if(Session::get('locale') == 'ar')
                    <input type="hidden" class="translate_option form-control" name="lang" value="en">
                    <button style="background: transparent;
                                    border: unset;
                                    color: white;
                                    cursor: pointer;
                                    outline: unset;
                                    font-weight: bold;">English
                    </button>
                @else
                    <input type="hidden" class="translate_option form-control" name="lang" value="ar">
                    <button style="background: transparent;
                                    border: unset;
                                    color: white;
                                    cursor: pointer;
                                    outline: unset;
                                    font-weight: bold;">عربي
                    </button>
                @endif
                {{--                <button type="submit">Change</button>--}}
            </form>
        </li>

 
                           
                            

                           
                      



        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @if(Auth::user()->role_id == 3)
                    @if(Auth::user()->status == 1)
                        <a href="{{ route('seller.seller.settings') }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> {{ __('Profile Settings') }}
                        </a>
                    @else
                        <a href="{{ route('merchant.profile.settings') }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> {{ __('Profile Settings') }}
                        </a>
                    @endif
                @else
                    <a href="{{ route('admin.profile.settings') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> {{ __('Profile Settings') }}
                    </a>

                @endif


                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="none">
                    @csrf
                </form>
            </div>
        </li>


    </ul>
</nav>


      
      <!-- Main Content -->
            @if(Session::get('locale') == 'ar')  

      <div class="main-content" style="padding-right: 15px;">
           @else
      <div class="main-content"  style="padding-left: 28px;">
      
           @endif

        <section class="section">
         @yield('head')
         <div class="section-body">
         </div>
       </section>
       

  <div class="row">
        <div class="col-md-7">
            <form id="filter-form" class="ajax-form" method="GET">
                <div class="card card-light">
                    <div class="card-header">

                        <div class="col-lg-4 categoryFilter">
                                <label class="col-sm-12 col-form-label">
                                   
                                {{ __('Filter Type') }} 
                                </label>
                                <div class="form-group row">

                                    <div class="col-sm-12">
 
                          

         <select id="Filter-Type" name="POSBeautyType" class="form-control POSBeautyType">

                        <option value="0">--</option>
                            
    <option value="POSBeautyservice">{{__('POSBeautyservice')}} </option>
    <option value="POSBeautyProduct">{{__('POSBeautyProduct')}}</option>
                                          
                                               
                                    </select>
                                    </div>
                                </div>


                            </div>
                  
                       
                            <div class="col-lg-4 categoryFilter">
                                <label class="col-sm-12 col-form-label">
                                   
                                {{ __('Category Filter') }} 
                                </label>
                                <div class="form-group row">

                                    <div class="col-sm-12">
@php
  $posts= App\Category::where('user_id',getUserId())->where('type','category')->with('preview')->latest()->get();
@endphp
                          

         <select id="category-filter" name="category_id" class="form-control category_id">

                        <option value="0">--</option>
                             @foreach($posts as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                                           @endforeach
                                               
                                    </select>
                                    </div>
                                </div>


                            </div>

                             <i id="spinner5" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i> 
              @php       
$locations=App\Category::where('user_id',getUserId())->where('type','branches')->latest()->get();
@endphp

                            <div class="col-lg-4">
             <label class="col-sm-12 col-form-label"> {{ __('Location Filter') }}   </label>
                                <div class="form-group row">
                                    <div class="col-sm-12">

                                        <select id="location-filter" name="location_id" class="form-control location_id">
                                            <option value="0">--</option>
                             @foreach($locations as $location)
                <option value="{{$location->id}}">
                    
                    @if(app()->getLocale() == 'ar')

                    {{ $location->name_ar  }}
    @else
                    {{ $location->name_en  }}

    @endif
                </option>
                                           @endforeach
                                               
                                            </select>
                                    </div>
                                </div>
                            </div>
         

            
 
                         
                       
                    </div>



  

                    <!-- /.card-header -->
                    <div class="card-body" id="pos-services"  >

                          <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="text" id="posSearch" name="search_key" class="form-control" placeholder="{{ __('Search') }}">
                                </div>
                            </div>

@php
  $posts= App\Category::where('user_id',getUserId())->where('type','category')->with('preview')->latest()->paginate(20);
@endphp
 <div id="hidemainsec"> 
                            @foreach($posts as $row)

                                                    <div class="row" >
                              
@php

$user_id = domain_info('user_id');
 
         $attributes=App\Postcategory::where('category_id',$row->id)->get();

         

    $cats_ids=[];
   foreach ($attributes as $key => $Postcat) 
   {
    
         array_push($cats_ids,$Postcat->term_id);
   }
          

            $products = App\Term::where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
                 -> whereIn('id',$cats_ids)
           ->withCount('reviews')->inRandomOrder()->paginate(6);
@endphp

                              @if($products->count() > 0)
                              <div class="col-md-12 mt-2">
                        
                                        <h5>
                                            <button class="btn btn-light"  style="width: 247px;">
                                                {{$row->name}}
                                            </button>
                                        </h5>

                                    </div>
                                    @endif


 

@foreach($products as $product)

                                            <div class="col-md-6 col-lg-3">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ asset($product->preview->media->url ?? 'uploads/default.png') }}" height="100em">
                                            <div class="card-body p-2">
                                                <p class="font-weight-normal">
                                                    {{ $product->title }}
                                                </p>
                                {{$product->price->price}} {{__('SAR')}}
                                            </div>
                                            <div class="card-footer p-1">

 

                                                
                                                <a  id="Removeshop" href="javascript:;"
                                                 class="btn btn-block btn-dark add-to-cart"><span  style="display:none;">{{ $product->id }}</span><i class="fa fa-plus"></i>{{ __('Add') }} </a>


                                            </div>
                                        </div>
                                    </div>
                                                                  
                                           @endforeach
                                                                   
                                                            </div>



                                           @endforeach
                                           </div>

          <span class="filter-services"></span>

                                                    <div class="row">
                                                                                            </div>
                                            </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </form>
        </div>
        <div class="col-md-5">
            <form id="pos-form" class="ajax-form" method="POST" autocomplete="off" method="{{url('/')}}/seller/POSbeauty">

                @csrf


                 

                                <div class="card card-dark">
                    <!-- /.card-header -->
                    <div class="card-body">

@if(Session::has('success'))
<div class="alert alert-success" style="text-align: center;">
    <p>{{ Session('success') }}</p>
</div>
@endif
@if(Session::has('danger'))
<div class="alert alert-danger" style="text-align: center;">
    <p>{{ Session('danger') }}</p>
</div>
@endif
                        <div class="row">

                            <input type="hidden" class="form-control" name="posTime" id="posTime" value="04:49 am">

                            <div class="col-md-10">
                                <label for="">{{ __('Date') }} </label>
                                <div class="input-group form-group">

            <input type="date" class="form-control posDateTime" name="date" id="datepicker" value="{{date('Y-m-d')}}">
                                    <span class="input-group-append input-group-addon">
                                        <button type="button" class="btn btn-info"><span class="fa fa-calendar-o"></span></button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <label for="">{{ __('time') }}</label>
                                <div class="input-group form-group">

                                    <input type="time" class="form-control posDateTime" name="time" id="timepicker" value="{{date('H:i:s')}}">
                                    <span class="input-group-append input-group-addon">
                                        <button type="button" class="btn btn-info"><span class="fa fa-clock-o"></span></button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">
                           {{ __(' Search a customer by name, email or mobile') }}
                                   
                                </label>

                                    @php
       $lims_customer_list=App\User::where('created_by',getUserId())->withCount('orders')->where('role_id',2)->get();
                                    @endphp

 

             <select  name="customer_id[]" data-placeholder=" {{ __(' Search a customer by name, email or mobile') }}" multiple class="chosen-select form-control">
                                                @foreach($lims_customer_list as $customer)
                                                    @php $deposit[$customer->id] = $customer->deposit - $customer->expense; @endphp
                                                    <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->email . ')'}}

                                                  {{$customer->phone }}
                                                    </option>
                                                @endforeach
                                                </select>
                                                 <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mt-2">&nbsp;</div>
                                <button class="btn btn-success btn-rounded" id="select-customer" type="button"
data-toggle="modal" data-target="#exampleModal"
                                >
                                    <i class="fa fa-plus"></i>  </button>



                            </div>

                            <div class="col-md-10" id="employee_list">
                                <div class="form-group">

                                    @php
                                    $users = App\User::where('user_id',getUserId())->latest()->get();
                                    @endphp
                                    <label for="">   {{ __('Assign Employee') }}</label>
                                     <select name="emp_id[]"  data-placeholder="{{ __('Begin typing a name to filter...') }}" multiple class="chosen-select2 form-control">
                                                @foreach($users as $customer)
                                                    @php $deposit[$customer->id] = $customer->deposit - $customer->expense; @endphp
                                                    <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->email . ')'}}

                                                  {{$customer->phone }}
                                                    </option>
                                                @endforeach
                                                </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mt-3">&nbsp;</div>
                                <span class="fa fa-users availableEmp" data-trigger="hover" data-toggle="popover" data-html="true" title="" data-content="" data-original-title="Following employees are available :"></span>
                            </div>

                            <div class="col-md-12 mt-2 mb-2 p-2" id="pos-customer-details"></div>

                        </div>

                        <div class="row">
                            <table class="table myTable " id="myTable"  style="color: inherit;
font-size: 16px;
font-weight: 700;
font-style: oblique;
font-weight: bold;">
                                <thead>
                                    <tr>
                                        <th  >{{ __('service') }}</th>
                                        <th  >{{ __('Price') }}</th>
                                        <th  >{{ __('Quantity') }}</th>
                                        <th  >{{ __('SubTotal') }}</th>
                                        <th><i class="fa fa-gear"></i></th>
                                    </tr>
                                </thead>
                     <tbody   class="success"></tbody>

                                <tbody  id="tbody" >
                @foreach (Cart::content() as $item)
 

       <tr class="{{ $item->id  }}" id="{{ $item->id  }}">

        <td>
        <input type='hidden' name='cart_services[]'  value="{{ $item->id  }}">
        {{ $item->name  }}
    </td>

        <td>
            <input type='hidden' name='cart_prices[]' class='cart-price-3'  value="{{ $item->price  }}"> {{ $item->price  }}
        </td>

        <td> 
            <input type='hidden' readonly name='cart_quantity[]'  class='form-control cart-service-3' value="{{ $item->qty }}"> {{ $item->qty }}
        </td>
        <td> {{ $item->subtotal }}</td>
        <td>
            <a href="javascript:;" class="btn btn-danger btn-sm btn-circle delete-cart-row"  id="Removeservices"><i class="fa fa-times" aria-hidden="true"></i> <span  style="display: none;">'.$term->id .'</span>   <i id="spinner3" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i></a>
        </td>
    </tr>
                @endforeach



                                    <tr id="no-service">
                                        <td colspan="5" class="text-center text-danger">
                                            {{ __('Please select services to continue') }}
                                             <i id="spinner" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i>
                                        
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!--div class="row">
                            <table class="table table-condensed" id="product-table" style="color: inherit;
font-size: 16px;
font-weight: 700;
font-style: oblique;
font-weight: bold;">
                                <thead>
                                    <tr>
                                        <th  >{{ __('service') }}</th>
                                        <th  >{{ __('Price') }}</th>
                                        <th  >{{ __('Quantity') }}</th>
                                        <th  >{{ __('SubTotal') }}</th>
                                        <th><i class="fa fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="no-product">
                                        <td colspan="5" class="text-center text-danger">
                                                {{ __('No product selected yet') }}
                                        
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div -->

                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-body">
                            <div class="col-md-12 border-bottom" id="CouponBox">
                       <div class="col-md-12 border-bottom" id="CouponBox">
  <span class="success2"></span>
    </div>
    </div>
                        <div class="row pos-calculations">
                            <div class="col-md-6 border-bottom">
                                

             {{ __('Price Total') }}                            </div>
                            <div class="col-md-6 border-bottom" id="cart-sub-total">
                             
                                <span class="PriceTotal">{{ Cart::priceTotal() }} {{__('SAR')}}</span>
                            </div>

                                 


                            <div class="col-md-6 border-bottom">
                                <h6> {{ __('Discount') }}  (%)</h6>
                            </div>
                            <div class="col-md-6 border-bottom">
                                 <span class="Discount">{{ Cart::discount() }} {{__('SAR')}}</span>
                            </div>

                            <div class="col-md-6 border-bottom">
                                <h6>{{ __('Tax') }}</h6>
                            </div>
                            <div class="col-md-6 border-bottom">
                                <h5 id="cart-tax-amount">
                                    <span class="Tax"> 

                                     @php
             $totltax=0;
                foreach (Cart::content() as $item)
                {
                    $product_id=$item->id;
        $term = App\Term::where('user_id',domain_info('user_id'))->findorFail($product_id);
          
       
        $totltax= $totltax + $term->tax_value ;

                }

                   @endphp 

                   {{$totltax}}

                                {{__('SAR')}}</span>
                                </h5>
                            </div>

                        
                            <div class="col-md-12 border-bottom" id="CouponBox">
                                <div class="row">
                                    <div class="col-md-6 ">

                                        <h6>{{ __('Apply Coupon') }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="coupon_code" name="coupon" class="form-control" style=" width:70%; display: inline">
                                        <button type="button" id="apply_coupon" style="" class="btn btn-success "><i class="fa fa-check"></i><i id="spinner4" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i> </button>
                                    </div>
                                </div>

                            </div>


                            <!--div class="col-md-12 py-3 border-bottom" id="removeCouponBox" style="display:none">
                                <h5>{{ __('Coupons') }}</h5>

                                <div class="coupons-base-content justify-content-between d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="fa fa-tag"></i>
                                        </div>
                                        <div>
                                            <h5 class="coupons-name mb-0" id="couponCode"> </h5>
                                            <p class="mb-0 text-success">
                                                Bingo!! You saved <span id="couponCodeAmonut"> $0.00 </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" onclick="removeCoupon();" class="btn btn-success btn-outline-danger remove-button"> Remove                                        </button>
                                    </div>
                                </div>
                            </div -->



                            <div class="col-md-6 border-bottom">
                             {{ __('Subtotal') }}                               </div>
                            <div class="col-md-6 border-bottom" id="cart-total">
                               <span class="Subtotal">   {{ Cart::subtotal() }} {{__('SAR')}}</span>
                            </div>

                           

                            <div class="col-md-6" id="totalAmountBox">
                                <h4>{{ __('Grand Total') }}   </h4>
                            </div>
                            <div class="col-md-6">
                                <h4 id="total-cart">
                                    <span class="Total">  {{ Cart::total() }} {{__('SAR')}}</span>
                                </h4>
                                <input type="hidden" id="cart-total-input">
                                <input type="hidden" id="product-total-input">
                                <input type="hidden" id="coupon_id" name="coupon_id">
                                <input type="hidden" id="coupon_amount" name="coupon_amount">
                            </div>

                            <div class="col-md-6 mt-2">
                                <button type="button" id="empty-cart" class="btn btn-danger p-3 btn-lg btn-block">{{ __('Empty Cart') }}
  <i id="spinner2" class="fa fa-spin fa-spinner loading-save-c2" style="display: none;"></i>
                                </button>
                                <div id="cart-item-error" class="invalid-feedback">
                                    

                                </div>

                            </div>
                            <div class="col-md-6 mt-2">
      

     <input type="submit" name="{{ __('Pay') }}"  class="btn btn-success p-3 btn-lg btn-block" value="{{ __('Pay') }}">
                                <div id="cart-item-error" class="invalid-feedback"></div>
                            </div>


                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="card-body">
        <form class="basicform_with_reset" action="{{ route('seller.customer.store') }}" method="post">
          @csrf
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
        </form>
      </div>
      </div>
      
    </div>
  </div>
</div>


     </div>
     <footer class="main-footer">
      <div class="footer-left">
        Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Powered By <a href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
      </div>

    </footer>
  </div>
</div>
<!-- General JS Scripts -->
<!-- <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script> -->
<script src="{{ asset('assets/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.min.js')}}"></script>
<!-- <script src="{{ asset('assets/js/moment.min.js')}}"></script> -->
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
@stack('js')
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts.js') }}"></script>

  
    <script src="{{url('/')}}/assets/ckeditor/ckeditor/ckeditor.js"></script>
  <script src="{{url('/')}}/assets/ckeditor/ckeditor/samples/js/sample.js"></script>
  <!--<link rel="stylesheet" href="{{url('/')}}/assets/ckeditor/ckeditor/samples/css/samples.css">-->
<script>
  initSample();
</script>


@if(app()->getLocale() == 'ar')
    <style>
                
         * {
            font-family: 'Tajawal', sans-serif;
        }
        
         h1 {
            font-family: 'Tajawal', sans-serif;
        }
    </style>
@endif
               

<script type="text/javascript">
 function add_new_row(table, rowcontent) {
    if ($(table).length > 0) {
        if ($(table + ' > tbody').length == 0) $(table).append('<tbody />');
        ($(table + ' > tr').length > 0) ? $(table).children('tbody:last').children('tr:last').append(rowcontent): $(table).children('tbody:last').append(rowcontent);
    }
}
</script>



  <script type="text/javascript">
      $(document).on('click','#Removeshop',function(){

              var text =$(this).text();

              text=text.toString();

                    var xxxx= text;
var newStr = xxxx.substring(0, xxxx.length - 6);  
       
        $.ajax({
            url:"{{url('/seller/addservice')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:newStr,

           },
            dataType:"json",
            beforeSend:function(){
                      $('.success2').html('');
      document.getElementById("spinner").style.display = "block";
              

                  ///////////////////////////////

                  //////////////////////////////////
                      
            },
            success:function(data)
            {
             $('.PriceTotal').html(data.PriceTotal);  
             $('.Discount').html(data.Discount);  
             $('.Tax').html(data.Tax);  
             $('.Subtotal').html(data.Subtotal);  
             $('.Total').html(data.Total);  
 
  $('#myTable').append(data.success);
            
      document.getElementById("spinner").style.display = "none";
      
           

            

         

            }
        });
             return false;
    
                    
                     
                    });
  </script>



  <script type="text/javascript">
   

       $(document).on('click','#empty-cart',function(){

       
        $.ajax({
            url:"{{url('/seller/EmptyCart')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
          

           },
            dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner2").style.display = "block";       
            },
            success:function(data)
            {
             $('.PriceTotal').html(data.PriceTotal);  
             $('.Discount').html(data.Discount);  
             $('.Tax').html(data.Tax);  
             $('.Subtotal').html(data.Subtotal);  
             $('.Total').html(data.Total);  
 
        
      document.getElementById("spinner2").style.display = "none";

    $("#myTable > tbody").empty();
     
          
             $('.success').html(data.success);  
        

            }
        });
             return false;
    
                    
                     
                    });

  </script>





  <script type="text/javascript">
   

       $(document).on('click','#Removeservices',function(){
              
              var text =$(this).text();

              text=text.toString();
                  

    //  document.getElementById(this).style.display = "none";

           //  $(this).closest('tr').remove();   
          // $(this).parent().parent().remove(); 

        $.ajax({
            url:"{{url('/seller/Removeservices')}}",
            method:"POST",
           data :{
          _token:'{{ csrf_token() }}',
            id:text,
          

           },
            dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner3").style.display = "block"; 

            },
            success:function(data)
            {
             $('.PriceTotal').html(data.PriceTotal);  
             $('.Discount').html(data.Discount);  
             $('.Tax').html(data.Tax);  
             $('.Subtotal').html(data.Subtotal);  
             $('.Total').html(data.Total);  
              
 var b = data.id;
document.getElementById(b).innerHTML = '';

 
        
      document.getElementById("spinner3").style.display = "none";

    
        

            }
        });
             return false;
    
                    
                     
                    });

  </script>


   <script type="text/javascript">
      $(document).on('click','#apply_coupon',function(){

    
    var code =$('#coupon_code').val();
 
        $.ajax({
            url:"{{url('/seller/apply_coupon')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            code:code,

           },
            dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner4").style.display = "block"; 
                 
                      
            },
            success:function(data)
            {
                   
         $('.PriceTotal').html(data.PriceTotal);  
             $('.Discount').html(data.Discount);  
             $('.Tax').html(data.Tax);  
             $('.Subtotal').html(data.Subtotal);  
             $('.Total').html(data.Total);  
             $('.success2').html(data.success);  

      document.getElementById("spinner4").style.display = "none";
 

$.notify('{{__("Coupon Applied!")}}', "success");
             
             


            }
        });
             return false;
    
                    
                     
                    });
  </script>


  
 <script type="text/javascript">
            $('.POSBeautyType').on('change',function() {
    
    var newval = $(this).val();

   
     $.ajax({
            url:"{{url('/seller/filter-POSBeautyType')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:newval,

           },
            dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner5").style.display = "block"; 
                 
                      
            },
            success:function(data)
            {
                   
        
             $('.filter-services').html(data.success);  

      document.getElementById("spinner5").style.display = "none";
 
     document.getElementById("hidemainsec").style.display = "none";


            }
        });
});
        </script>


 <script type="text/javascript">
            $('.category_id').on('change',function() {
    
    var newval = $(this).val();

   
     $.ajax({
            url:"{{url('/seller/filter-services')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:newval,

           },
            dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner5").style.display = "block"; 
                 
                      
            },
            success:function(data)
            {
                   
        
             $('.filter-services').html(data.success);  

      document.getElementById("spinner5").style.display = "none";
 
     document.getElementById("hidemainsec").style.display = "none";


            }
        });
});
        </script>


 <script type="text/javascript">
            $('.location_id').on('change',function() {
    
    var newval = $(this).val();

   
     $.ajax({
            url:"{{url('/seller/location-filter')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            location_id:newval,

           },
            dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner5").style.display = "block"; 
                 
                      
            },
            success:function(data)
            {
                   
        
             $('.filter-services').html(data.success);  

      document.getElementById("spinner5").style.display = "none";
 
     document.getElementById("hidemainsec").style.display = "none";


            }
        });
});
        </script>

        

<script>
$(document).ready(function(){



 $('#posSearch').keyup(function(){ 

  
        var query = $(this).val();
        
         
         $.ajax({
          url:"{{url('/')}}/seller/search_key",
          method:"POST",
          data:
          {
            query:query,
        _token:'{{ csrf_token() }}',
               
            },
        dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner5").style.display = "block"; 
                 
                      
            },
            success:function(data)
            {
                   
        
             $('.filter-services').html(data.success);  

      document.getElementById("spinner5").style.display = "none";
 
     document.getElementById("hidemainsec").style.display = "none";


            }
         });
        
    });

   

});


 
</script>

        

 <!-- notify bootstrap-->
    <script src="{{url('/')}}/frontend/bigbag/js/bootstrap-notify.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>

<script type="text/javascript">
    $(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})
</script>

<script type="text/javascript">
    $(".chosen-select2").chosen({
  no_results_text: "Oops, nothing found!"
})
</script>
<script src="{{ asset('assets/js/form.js') }}"></script>
</body>
</html>




