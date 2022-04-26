 @php
 
 $wishlist=0;
             foreach (Cart::instance('saveForLater')->content() as $item1)
         {      
                
              if (Cart::instance('saveForLater')->count() > 0)

              {

                  
               $wishlist=$wishlist+1; 

            }

              }

@endphp
@php
  $user_id = domain_info('user_id');
 
                                    
      if(App\Useroption::where('user_id',$user_id)->where('key','theme_color')->first())
      {
        $theme_color= App\Useroption::where('user_id',$user_id)->where('key','theme_color')->first()->value;
      }
              
@endphp
    <b class="screen-overlay"></b>

    <!-- offcanvas panel -->
    <aside class="offcanvas" id="my_offcanvas1">
        <header class="p-4 bg-light border-bottom">
            <button class="btn btn-outline-danger btn-close"> &times {{__('Close')}}  </button>
        </header>
        <nav>
            <ul id="sub-menu" class="sm sm-vertical sm-clean">
     @php
         $user_id = domain_info('user_id');
   $Categories=App\Category::where('user_id', $user_id)->where('type','category')->where('p_id',null)->get();
                                        @endphp
                                        @foreach($Categories as $category)
                <li><a class="has-submenu" href="{{url('/')}}/category/{{$category->slug}}/{{$category->id}}">
                  {{ $category->name  }}
            </a>
                    <ul class="mega-menu sm-nowrap">
                             @foreach(App\Category::where('p_id',$category->id)->get() as $category)
                        <li><a href="{{url('/')}}/category/{{$category->slug}}/{{$category->id}}">{{ $category->name  }} </a></li>
                                        @endforeach
                        
                    </ul>
                </li>
                                        @endforeach

                
            </ul>
        </nav>
    </aside>
    <!-- offcanvas panel .end -->
    <div class="top-header" @isset($theme_color) style="background-color:{{$theme_color}}"  @endisset>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact">
                        <ul>
                            <li> {{__('Welcome to Our store MYkart')}}  

            @if(Session::get('locale') == 'ar') 
              @if(App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name_ar')->first())
                                {{
                                App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name_ar')->first()->value
                             }}
                             

                               @endif 
                             
                             @else
                               @if(App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name')->first())
                                {{
                                App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name')->first()->value
                             }}
                             

                               @endif

                             @endif

                         </li>
                            <li><i class="ti-mobile"></i>{{__('Call Us')}} : 

                                              @php
  $locations=Cache::get(domain_info('user_id').'location',''); 

   $locations = json_decode($locations, true);
    
 @endphp
 @isset($locations)
{{$locations['phone']}}
@endisset
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-right">
                    <ul class="header-dropdown">
                        <li class="mobile-wishlist"><a href="{{url('/')}}/wishlist">
                             <span @if(Session::get('locale') == 'en') style="position: absolute;
background: #ff4c3b;
width: 16px;
height: 18px;
color: #fff;
border-radius: 20px;
text-align: center;
font-size: 12px;
line-height: 14px;
font-weight: 600;
right: 111px;
padding: 3px;
top: 8px;"  @else style="position: absolute;
background: #ff4c3b;
width: 16px;
height: 18px;
color: #fff;
border-radius: 20px;
text-align: center;
font-size: 12px;
line-height: 14px;
font-weight: 600;
left: 104px;
padding: 3px;
top: 8px;"  @endif  class="  wishlist_qty_cls"  >{{ $wishlist }}</span><i class="ti-heart"></i></a>
                        </li>
                        <li class="onhover-dropdown mobile-account">
                            <a href="#"><i class="ti-user"></i> {{__('My Account')}} </a>
                            <ul class="onhover-show-div">
                                @if(Auth::check())
                                <li><a href="{{url('/')}}/user/logout">{{__('logout')}}</a></li>
                                 <li><a href="{{url('/')}}/user/dashboard">{{__('Account Details')}}</a></li>
                                <li><a href="{{url('/')}}/user/orders">{{__('Orders')}}</a></li>
                                <li><a href="{{url('/')}}/user/addresses">{{__('Addresses')}}</a></li>
@else
 <li><a href="{{url('/')}}/user/login">
                                {{__('Login/Register')}}</a></li>
@endif
                               

                               

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
