 @php
$cart_count=Cart::instance('default')->count();
$cart_content=Cart::instance('default')->content();
$cart_subtotal=Cart::instance('default')->subtotal();
$cart_total=Cart::instance('default')->total();


 $wishlist=0;
             foreach (Cart::instance('saveForLater')->content() as $item1)
         {      
                
              if (Cart::instance('saveForLater')->count() > 0)

              {

                  
               $wishlist=$wishlist+1; 

            }

              }


 
@endphp


    @push('js')
      
    @endpush

  <header>
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col">
                       @php
         $user_id = domain_info('user_id');
 
                                        @endphp

            
                    <a data-trigger="#my_offcanvas1" href="#" class="mr-3"><i class="ti-menu"></i></a>

                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('/')}}/uploads/{{$user_id}}/logo.png" alt="" style="width:141px;height:49px"></a>

    
                </div>
                <div class="col">
                    <form action="{{url('/')}}/product_search" class="searchbox" method="get">
                       
    <input type="text" placeholder="{{__('What are you Looking For?')}}" 
    name="src">
                        <button  type="submit" class="li-btn" type="submit"><span class="ti-search"></span></button>
                    </form>
                </div>
                <div class="col head_icons">
                    <ul class="d-flex justify-content-end">
                        <li class="d-inline-block mr-5  onhover-dropdown"><a href="#"><i class="ti-settings"></i></a>
                            <ul class="onhover-show-div shopping-cart d-flex">
                                <div class="col p-0">
                                    <h6>{{__('Language')}}</h6>
                                    <div class="dropdown-divider"></div>

                                    <li><a href="{{url('/')}}/make_local?lang=ar">{{__('Arabic')}}</a> </li>

                                    <li><a href="{{url('/')}}/make_local?lang=en">{{__('English')}}</a></li>

                                   

                                </div>

                                <!--div class="col p-0 pl-2">
                                    <h6>{{__('Currency')}}</h6>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="index.html">EGP</a> </li>
                                    <li><a href="index.html">USD</a></li>
                                </div -->

                            </ul>
                        </li>
                         
            <li class="d-inline-block  onhover-dropdown">
                            <a href="#">
                                <i class="ti-shopping-cart"></i>
                                <span class="cart_qty_cls">{{ $cart_count }}</span>
                            </a>
                            <span class="append_new_cart">
                                
                            </span>
             <ul class="show-div onhover-show-div shopping-cart cartHhide">
                                        @if (Cart::instance('default')->count() > 0)

                 @foreach (Cart::instance('default')->content() as $item)

                                <li id="{{ $item->rowId }}">
                                    <div class="media"  >
                                        <a href="{{url('/')}}/product/{{$item->id}}"><img alt="" class="me-3"
                                                src="{{ $item->options->preview  }}"></a>
                                        <div class="media-body">
                                            <a href="{{url('/')}}/product/{{$item->id}}">
                                                <h4>
                                                     {{ $item->name  }}
                                                </h4>
                                            </a>
                        <h4><span>{{$item->qty}} x {{ $currency->currency_icon ?? '' }} {{ $item->price  }}</span></h4>
                                        </div>
                                    </div>


        <div class="close-circle">
  <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST" id="dellshop">
                           
                       <span>
                           
                                                     {{ csrf_field() }}
                         
                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
<a class="cart-options" id="RemoveCartFromHome"><span class="hidden">{{ $item->rowId }}</span><i class="fa fa-times"
                                                aria-hidden="true"></i></a>
                

                            </form>


                                            </div>
                                </li>
                @endforeach

                                 @else
                                        <span>{{__('No items in Cart!')}}</span>
            @endif


                                <li>
                                    <div class="total">
            <h5>{{ __('subtotal')}}: <span class="cart_total_top">{{$currency->currency_icon ?? ''}} {{$cart_total}}</span></h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="buttons"><a href="/cart" class="view-cart">
                                       {{ __('view cart')}} </a> <a href="/checkout" class="checkout">
                                       {{ __('checkout')}}</a></div>
                                </li>
                            </ul>
                        </li>
 

                    </ul>

                    <!--ul class="d-flex justify-content-end">
                       
                         
                        <li class="d-inline-block  onhover-dropdown">
                            <a href="{{url('/')}}/wishlist">
                               <i class="ti-heart"></i>
                                <span class="cart_qty_cls wishlist_qty_cls"  >{{ $wishlist }}</span>
                            </a>
                            
                        </li>
  <li class="d-inline-block  "> 
                        </li>

                    </ul  -->
                </div>

            </div>
        </div>
    </header>

    @php
  $user_id = domain_info('user_id');
 
                                    
      if(App\Useroption::where('user_id',$user_id)->where('key','theme_color_menue')->first())
      {
        $theme_color_menue= App\Useroption::where('user_id',$user_id)->where('key','theme_color_menue')->first()->value;
      }
         
     
@endphp
    
    <div class="header-bottom header-sticky"  @isset($theme_color_menue) style="background-color:{{$theme_color_menue}}"  @endisset
>
        <div class="container">
            <div class="row"   @isset($theme_color_menue) style="background-color:{{$theme_color_menue}}"  @endisset >
                <nav class="navbar navbar-expand-lg navbar-dark  w-100"  @isset($theme_color_menue) style="background-color:{{$theme_color_menue}}"  @endisset>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main_nav">

                        <ul class="navbar-nav">
                            <li class="nav-item active"> <a class="nav-link" href="/">{{__('Home')}} </a> </li>
                            <li class="nav-item"><a class="nav-link" href="/about"> {{__('About us')}} </a></li>
                            <li class="nav-item"><a class="nav-link" href="/offers">{{__('Offers')}}  </a></li>
                            <li class="nav-item dropdown has-megamenu">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{__('Categories')}}   </a>
                                <div class="dropdown-menu megamenu">

                                    <div class="row">
                                        
                                        @php
                                          $user_id = domain_info('user_id');

   $Categories=App\Category::where('user_id',$user_id)->where('type','category')->where('p_id',null)->get();
                                        @endphp
                                        @foreach($Categories as $category)
                                        <div class="col-lg-3">
                                            <div class="col-megamenu">
                                                <h6 class="title">
<a href="{{url('/')}}/category/super/{{$category->id}}" style="font-weight: bold;">
                                               {{ $category->name  }}
                                           </a>
                                            </h6>
                                                <ul class="list-unstyled">
                                        @foreach(App\Category::where('p_id',$category->id)->get() as $category)
                                                   
                             <li><a href="{{url('/')}}/category/{{$category->slug}}/{{$category->id}}"> {{ $category->name  }}  </a></li>
                                                    <li> 
                                        @endforeach
                                                        
                                                </ul>
                                            </div>
                                        </div>
                                        @endforeach
                                         
                                    </div>

                                </div> <!-- dropdown-mega-menu.// -->
                            </li>
                            <li class="nav-item"><a class="nav-link" href="/contact">{{__('Contact us')}} </a></li>
                        </ul>
                    </div> <!-- navbar-collapse.// -->
                </nav>
            </div>
        </div>

    </div>