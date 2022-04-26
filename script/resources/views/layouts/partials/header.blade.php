  
  
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
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
                                 

                 if($value->stock->stock_qty  <=  $value->stock->Alarm_quantity   or $value->stock->stock_qty  == 0 )
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



         <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">

@php
$user_id  = getUserId();
 

    $orderscount = App\Models\Review::
         where('shop_id',$user_id )->
     where('status','0')->

   count();

   $ordersget=  App\Models\Review::
     where('shop_id',$user_id )->
     where('status','0')->
    take(5)
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


        <a href="{{url('/')}}/seller/review/{{$row->id}}/edit" class="dropdown-item has-icon">
                            <i class="fa fa-bell"></i> 
            {{__('You have new reviews')}} .
            ( {{$row->comment}}).
           
                        
                        </a>
                 
                        @endforeach
                        @else
                         <a  class="dropdown-item has-icon" style="text-align:center;">
                        
{{__('No alert')}}
                         
                        </a>
 
                        @endif
                
                <a href="{{url('/')}}/seller/review" class="dropdown-item has-icon">
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

