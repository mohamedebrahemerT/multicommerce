@extends('frontend.bigbag.index')
@section('content')


        
 
    <section class="hero_slider" >
        <div class="home-slider">
          


                                        @foreach($sliders as $slider)
            <div >
                <img src="{{$slider['slider']}}" alt=""   >
            </div>

                                        @endforeach

            

        </div>
    </section>



    @php
    $posts=App\Category::where('type','offer_ads')->where('user_id', domain_info('user_id'))->latest()->get();
    @endphp

    <section class="offers_banners">
        <div class="container">
            <div class="row">

                    @foreach($posts as $row)

                <div class="col-md-6">
                    <a href="{{ $row->slug }}">
                        <div class="collection-banner p-right text-center">
                            <div class="img-part bg-size">
                               
                                <img src="{{ asset($row->src) }}" class="img-fluid bg-img" alt="">

                            </div>
                            <div class="contain-banner">
                                <div>
                                    <h4>save 30%</h4>
                                    <h2>men</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                 
  @endforeach

            </div>
        </div>
    </section >




@if($trending_products->count() > 4 )
    <section class="products my-5">
        <div class="container">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
     <h2 class="title-inner1">{{__('Trending products')}} </h2>
                </div>
            </div>
            <div class="row slider">
        @foreach($trending_products as $trend)

                

                  @php
                   $Attributecount=App\Attribute::where('term_id',$trend->id)->groupBy('category_id')->count();

                     $countoptions=$trend->options->count()
                     @endphp



               
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="{{url('/')}}/product/{{$trend->slug}}/{{$trend->id}}">
                                <img class="pic-1" src="{{ asset($trend->preview->media->url ?? 'uploads/default.png') }}">
                                <img class="pic-2" src="{{ asset($trend->preview->media->url ?? 'uploads/default.png') }}">
                            </a>
 @if($trend->stock->stock_status == 1 and  $trend->stock->stock_qty !== 0 )
  <ul class="social">
                                 <li><a href="javascript:void(0)" data-tip="{{__('Quick View')}}"   id="QuickView"><i
                                            class="ti-eye"></i>
<span class="hidden">{{ $trend->id }}</span>
                                        </a></li>
                                  @if($Attributecount  > 0 or $countoptions >0 )
<li><a href="{{url('/')}}/product/{{$trend->slug}}/{{$trend->id}}" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
</a>
</li>
                   
                  @else
<li><a id="add_to_Wishlist" href="javascript:void(0)" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
<span class="hidden">{{ $trend->id }}</span>
</a>
</li>

                 @endif

                              @if($Attributecount  > 0 or $countoptions >0 )
                              <li>

                  <a href="{{url('/')}}/product/{{$trend->slug}}/{{$trend->id}}" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i></a>
</li>
                  
                  @else
                              <li>

                   <a  id="add_to_cart" href="javascript:void(0)" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i>
<span class="hidden">{{ $trend->id }}</span>

                   </a>

</li>
                  

                  


                 @endif


                            </ul>
                               

         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  

                          

  @if($trend->price->special_price !== null )
                            <span class="product-new-label">{{ __('Sale') }}</span>
                            <span class="product-discount-label">
                            @if($trend->price->price_type == 1)
                               {{__('Discount')}}
                            {{$trend->price->special_price}} 

                         {{ $currency->currency_icon ?? '' }}
                           @else
                              {{$trend->price->special_price}}  {{__('Discount')}}%
                           @endif
                            </span>
                                @endif

                        </div>
                        <ul class="rating">
                               @php
        $count=App\Models\Review::where('term_id',$trend->id)->count(); 
   if($count == 0)
        {
        $count = 1;
        }


       $rating=0;
        foreach(App\Models\Review::where('term_id',$trend->id)->get() as $R)
        {
            $rating=$R->rating +$rating;
        }

       

           $finalrate=$rating/$count;

                                @endphp
                            

                                @if($finalrate >= 1 and $finalrate  < 2)
                                <i class="fa fa-star"></i> 
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                                @endif

                                 @if($finalrate >= 2 and $finalrate < 3)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                             

                                @endif

                                 @if($finalrate >= 3  and  $finalrate< 4)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                                @endif

                                 @if($finalrate >= 4 and $finalrate <= 5)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                                @endif
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{url('/')}}/product/{{$trend->slug}}/{{$trend->id}}"> 
                                 {{$trend->title}}
                            </a></h3>
                            <div class="price"> 

                         @if($trend->price->special_price !== null )
               {{$trend->price->price}}  {{ $currency->currency_icon ?? '' }} 
                 <span>
                  {{$trend->price->regular_price}} {{ $currency->currency_icon ?? '' }}
                 </span>
                   @else
 {{$trend->price->price}} {{ $currency->currency_icon ?? '' }}
                  @endif
                            </div>


                             @if($trend->stock->stock_status == 1 and  $trend->stock->stock_qty !== 0 )


                           @if($Attributecount  > 0 or $countoptions >0 )

                  <a   class="add-to-cart"  href="{{url('/')}}/product/{{$trend->slug}}/{{$trend->id}}">+ {{__('Add To Cart')}}</a>

                  @else

                   <a   class="add-to-cart"  href="{{url('/')}}/add_to_cartforent/{{$trend->id}}">+ {{__('Add To Cart')}}</a>

                  


                 @endif


         @else
         <span style="color: red"> {{ __('out of stock') }} </span>
        
                 @endif  
  




                        </div>
                    </div>
                </div>
                 

                   @endforeach
             
                
                 
            </div>
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <a href="{{url('/')}}/more?more=trending_products" class="btn btn-secondary">{{__('More')}}</a>
                </div>
            </div>
        </div>
    </section>
 @endif






 @php
  $user_id = domain_info('user_id');
 
                                    
      if(App\Useroption::where('user_id',$user_id)->where('key','Available_Offer')->first())
      {
        $Available_Offer= App\Useroption::where('user_id',$user_id)->where('key','Available_Offer')->first()->value;
      }
         
     
@endphp




@if($random_products->count()  >=   4 )
    <section class="products my-5 pt-4 offers_section" @isset($Available_Offer) style="background-color:{{$Available_Offer}}"  @endisset>
        <div class="container">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <h2 class="title-inner1">{{__('Available Offer')}}</h2>
                </div>
            </div>
            <div class="row slider">
                
                   @foreach($random_products as $random)
 


 @if($random->price->special_price !== null )

   @php
                     $Attributecount=App\Attribute::where('term_id',$random->id)->groupBy('category_id')->count();

                     $countoptions=$random->options->count()
                     @endphp
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="{{url('/')}}/product/{{$random->slug}}/{{$random->id}}">
                                <img class="pic-1" src="{{ asset($random->preview->media->url ?? 'uploads/default.png') }}">
                                <img class="pic-2" src="{{ asset($random->preview->media->url ?? 'uploads/default.png') }}">
                            </a>

 @if($random->stock->stock_status == 1 and  $random->stock->stock_qty !== 0 )
  <ul class="social">
                                 <li><a href="javascript:void(0)" data-tip="{{__('Quick View')}}"   id="QuickView"><i
                                            class="ti-eye"></i>
<span class="hidden">{{ $random->id }}</span>
                                        </a>

                                    </li>


                                  @if($Attributecount  > 0 or $countoptions >0 )
<li><a href="{{url('/')}}/product/{{$random->slug}}/{{$random->id}}" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
</a>
</li>
                   
                  @else
<li><a id="add_to_Wishlist" href="javascript:void(0)" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
<span class="hidden">{{ $random->id }}</span>
</a>
</li>

                 @endif

                                <li>
                                   @if($Attributecount  > 0 or $countoptions >0 )

                  <a href="{{url('/')}}/product/{{$random->slug}}/{{$random->id}}" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i></a>
                  @else

                   <a  id="add_to_cart" href="javascript:void(0)" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i>
<span class="hidden">{{ $random->id }}</span>

                   </a>

                  

                  


                 @endif
                                   

                                </li>
                            </ul>



         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  

                          
                              

  @if($random->price->special_price !== null )
                            <span class="product-new-label">{{ __('Sale') }}</span>
                            <span class="product-discount-label">
                               @if($random->price->price_type == 1)
                               {{__('Discount')}}
                            {{$random->price->special_price}} 

                         {{ $currency->currency_icon ?? '' }}
                           @else
                         %     {{$random->price->special_price}}  {{__('Discount')}}
                           @endif
                            </span>
                            @endif

                        </div>
                        <ul class="rating">
                              @php
        $count=App\Models\Review::where('term_id',$random->id)->count(); 
   if($count == 0)
        {
        $count = 1;
        }


       $rating=0;
        foreach(App\Models\Review::where('term_id',$random->id)->get() as $R)
        {
            $rating=$R->rating +$rating;
        }

       

           $finalrate=$rating/$count;

                                @endphp
                            

                                @if($finalrate >= 1 and $finalrate  < 2)
                                <i class="fa fa-star"></i> 
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                                @endif

                                 @if($finalrate >= 2 and $finalrate < 3)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                             

                                @endif

                                 @if($finalrate >= 3  and  $finalrate< 4)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                                @endif

                                 @if($finalrate >= 4 and $finalrate <= 5)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                                @endif
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{url('/')}}/product/{{$random->slug}}/{{$random->id}}">    {{$random->title}}
                            </a></h3>
                            <div class="price">
  @if($random->price->special_price !== null )
                  {{$random->price->price}}{{ $currency->currency_icon ?? '' }}
                 <span>{{$random->price->regular_price}}{{ $currency->currency_icon ?? '' }}</span>
                   @else
   {{$random->price->price}}{{ $currency->currency_icon ?? '' }}
                  @endif

                            </div>
                 
               
                 <input type="hidden" name="qty" value="1"> 

                   
             @if($random->stock->stock_status == 1 and  $random->stock->stock_qty !== 0 )
 @if($Attributecount  > 0 or $countoptions >0 )

                  <a href="{{url('/')}}/product/{{$random->slug}}/{{$random->id}}" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i></a>
                  @else

                   <a  id="add_to_cart" href="javascript:void(0)" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i>
<span class="hidden">{{ $random->id }}</span>

                   </a>
                 @endif

         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
                  

                

       


                            </form>
                        </div>
                    </div>
                </div>
                    @endif
                 
                   @endforeach
                
            </div>
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <a href="{{url('/')}}/more?more=Available_Offer" class="btn btn-secondary">{{__('More')}}</a>
                </div>
            </div>
        </div>
    </section>
 @endif


   <br>

    @php
    $posts=App\Category::where('type','banner_ads')->where('user_id', domain_info('user_id'))->latest()->get();
    @endphp

    <section class="offers_banners">
        <div class="container">
            <div class="row">

                    @foreach($posts as $row)

                <div class="col-md-12">
                    <a href="{{ $row->slug }}">
                        <div class="collection-banner p-right text-center">
                            <div class="img-part bg-size">
                                <img src="{{ asset($row->src) }}" class="img-fluid bg-img" alt="">
                            </div>
                            <div class="contain-banner">
                                <div>
                                    <h4>save 30%</h4>
                                    <h2>men</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                 
  @endforeach

            </div>
        </div>
    </section >


@if($best_selling_product->count() > 4 )

    <section class="products my-5">
        <div class="container">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <h2 class="title-inner1">{{__('Best selling products')}}</h2>
                </div>
            </div>
            <div class="row slider">
                
                   @foreach($best_selling_product as $best_selling)
  
                   @php
                   $Attributecount=App\Attribute::where('term_id',$best_selling->id)->groupBy('category_id')->count();

                     $countoptions=$best_selling->options->count()
                     @endphp

                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="{{url('/')}}/product/{{$best_selling->slug}}/{{$best_selling->id}}">
                                <img class="pic-1" src="{{ asset($best_selling->preview->media->url ?? 'uploads/default.png') }}">
                                <img class="pic-2" src="{{ asset($best_selling->preview->media->url ?? 'uploads/default.png') }}">
                            </a>

 @if($best_selling->stock->stock_status == 1 and  $best_selling->stock->stock_qty !== 0 )
 <ul class="social">
                                 <li><a href="javascript:void(0)" data-tip="{{__('Quick View')}}"   id="QuickView"><i
                                            class="ti-eye"></i>
<span class="hidden">{{ $best_selling->id }}</span>
                                        </a></li>
                                @if($Attributecount  > 0 or $countoptions >0 )
<li><a href="{{url('/')}}/product/{{$best_selling->slug}}/{{$best_selling->id}}" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
</a>
</li>
                   
                  @else
<li><a id="add_to_Wishlist" href="javascript:void(0)" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
<span class="hidden">{{ $best_selling->id }}</span>
</a>
</li>

                 @endif
                                   
           @if($Attributecount  > 0 or $countoptions >0 )

                  <a href="{{url('/')}}/product/{{$best_selling->slug}}/{{$best_selling->id}}" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i></a>
                  @else

                   <a  id="add_to_cart" href="javascript:void(0)" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i>
<span class="hidden">{{ $best_selling->id }}</span>

                   </a>

                  

                  


                 @endif
                                </li>

                            </ul>
                             

         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  

                           

 @if($best_selling->price->special_price !== null )
                            <span class="product-new-label">{{ __('Sale') }}</span>
                            <span class="product-discount-label">
                         @if($best_selling->price->price_type == 1)
                               {{__('Discount')}}
                            {{$best_selling->price->special_price}} 

                         {{ $currency->currency_icon ?? '' }}
                           @else
                              {{$best_selling->price->special_price}}  {{__('Discount')}}%
                           @endif
                            </span>
                                @endif

                        </div>
                         <ul class="rating">
                              @php
        $count=App\Models\Review::where('term_id',$best_selling->id)->count(); 
   if($count == 0)
        {
        $count = 1;
        }


       $rating=0;
        foreach(App\Models\Review::where('term_id',$best_selling->id)->get() as $R)
        {
            $rating=$R->rating +$rating;
        }

       

           $finalrate=$rating/$count;

                                @endphp
                            

                                @if($finalrate >= 1 and $finalrate  < 2)
                                <i class="fa fa-star"></i> 
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                                @endif

                                 @if($finalrate >= 2 and $finalrate < 3)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                             

                                @endif

                                 @if($finalrate >= 3  and  $finalrate< 4)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                                @endif

                                 @if($finalrate >= 4 and $finalrate <= 5)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                                @endif
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{url('/')}}/product/{{$best_selling->slug}}/{{$best_selling->id}}"> 
                            {{$best_selling->title}}</a></h3>
                            <div class="price">
  @if($best_selling->price->special_price !== null )
         {{$best_selling->price->price}} {{ $currency->currency_icon ?? '' }}
  <span>{{$best_selling->price->regular_price}} {{ $currency->currency_icon ?? '' }}</span>
    @else
 {{$best_selling->price->price}} {{ $currency->currency_icon ?? '' }}
                  @endif
                            </div>

 @if($best_selling->stock->stock_status == 1 and  $best_selling->stock->stock_qty !== 0 )
  @if($Attributecount  > 0 or $countoptions >0 )
                  <a   class="add-to-cart"  href="{{url('/')}}/product/{{$best_selling->slug}}/{{$best_selling->id}}">+ {{__('Add To Cart')}}</a>
                  @else
                   <a   class="add-to-cart"  href="{{url('/')}}/add_to_cartforent/{{$best_selling->id}}">+ {{__('Add To Cart')}}</a>
                 @endif

         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  


                          



                        </div>
                    </div>
                </div>
               

                   @endforeach
              
            </div>
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <a href="{{url('/')}}/more?more=best_selling_product" class="btn btn-secondary">{{__('More')}}</a>
                </div>
            </div>
        </div>
    </section>
 @endif


@if($latest_products->count() > 4 )
    <section class="products my-5">
        <div class="container">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <h2 class="title-inner1">{{__('New arrival products')}}</h2>
                </div>
            </div>
            <div class="row slider">
                   @foreach($latest_products as $latest_product)
              

                   @php
                   $Attributecount=App\Attribute::where('term_id',$latest_product->id)->groupBy('category_id')->count();

                     $countoptions=$latest_product->options->count()
                     @endphp

                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}">
                                <img class="pic-1" src="{{ asset($latest_product->preview->media->url ?? 'uploads/default.png') }}">
                                <img class="pic-2" src="{{ asset($latest_product->preview->media->url ?? 'uploads/default.png') }}">
                            </a>

 @if($latest_product->stock->stock_status == 1 and  $latest_product->stock->stock_qty !== 0 )
  <ul class="social">
                                 <li><a href="javascript:void(0)" data-tip="{{__('Quick View')}}"   id="QuickView"><i
                                            class="ti-eye"></i>
<span class="hidden">{{ $latest_product->id }}</span>
                                        </a></li>
                               @if($Attributecount  > 0 or $countoptions >0 )
<li><a href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
</a>
</li>
                   
                  @else
<li><a id="add_to_Wishlist" href="javascript:void(0)" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
<span class="hidden">{{ $latest_product->id }}</span>
</a>
</li>

                 @endif
                                
                                <li>
                                   @if($Attributecount  > 0 or $countoptions >0 )

                  <a href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i></a>
                  @else

                   <a  id="add_to_cart" href="javascript:void(0)" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i>
<span class="hidden">{{ $latest_product->id }}</span>

                   </a>

                  

                  


                 @endif
                                </li>

                            </ul>
                               

         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  

                          

  @if($latest_product->price->special_price !== null )
                            <span class="product-new-label">{{ __('Sale') }}</span>
                            <span class="product-discount-label">
                         @if($latest_product->price->price_type == 1)
                               {{__('Discount')}}
                            {{$latest_product->price->special_price}} 

                         {{ $currency->currency_icon ?? '' }}
                           @else
                             %  {{$latest_product->price->special_price}}  {{__('Discount')}}
                           @endif
                            </span>
                            @endif

                        </div>
                          <ul class="rating">
                              @php
        $count=App\Models\Review::where('term_id',$latest_product->id)->count(); 
   if($count == 0)
        {
        $count = 1;
        }


       $rating=0;
        foreach(App\Models\Review::where('term_id',$latest_product->id)->get() as $R)
        {
            $rating=$R->rating +$rating;
        }

       

           $finalrate=$rating/$count;

                                @endphp
                            

                                @if($finalrate >= 1 and $finalrate  < 2)
                                <i class="fa fa-star"></i> 
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                                @endif

                                 @if($finalrate >= 2 and $finalrate < 3)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                             

                                @endif

                                 @if($finalrate >= 3  and  $finalrate< 4)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                                @endif

                                 @if($finalrate >= 4 and $finalrate <= 5)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                                @endif
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}">
                            {{$latest_product->title}}
                        </a></h3>
                            <div class="price">
                     @if($latest_product->price->special_price !== null )
                                ${{$latest_product->price->price}} {{ $currency->currency_icon ?? '' }}
                 <span>{{$latest_product->price->regular_price}} {{ $currency->currency_icon ?? '' }}</span>
                   @else
  {{$latest_product->price->price}} {{ $currency->currency_icon ?? '' }}
                  @endif
                            </div>



 @if($latest_product->stock->stock_status == 1 and  $latest_product->stock->stock_qty !== 0 )
    @if($Attributecount  > 0 or $countoptions >0 )
                  <a   class="add-to-cart"  href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}">+ {{__('Add To Cart')}}</a>
                  @else
                   <a   class="add-to-cart"  href="{{url('/')}}/add_to_cartforent/{{$latest_product->id}}">+ {{__('Add To Cart')}}</a>
                 @endif


         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  
                       


                        </div>
                    </div>
                </div>

                  

                   @endforeach
                
            </div>
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <a href="{{url('/')}}/more?more=New_arrival_products" class="btn btn-secondary">{{__('More')}}</a>
                </div>
            </div>
        </div>
    </section>
 @endif

@if($latest_products->count() > 4 )
    <section class="products mt-5 py-4 recently-viewed">
        <div class="container-fluid">
            <div class="row justify-content-center my-4 text-center">
                <div class="title1 section-t-space">
                    <h2 class="title-inner1">{{__('Recently Viewed')}}</h2>
                </div>
            </div>
            <div class="row recently-viewed-slider">
                   @foreach($latest_products as $latest_product)

                 

                    @php
                   $Attributecount=App\Attribute::where('term_id',$latest_product->id)->groupBy('category_id')->count();

                     $countoptions=$latest_product->options->count()
                     @endphp

                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}">
                                <img class="pic-1" src="{{ asset($latest_product->preview->media->url ?? 'uploads/default.png') }}">
                                <img class="pic-2" src="{{ asset($latest_product->preview->media->url ?? 'uploads/default.png') }}">
                            </a>
                            

 @if($latest_product->stock->stock_status == 1 and  $latest_product->stock->stock_qty !== 0 )
   <ul class="social">
                                  <li><a href="javascript:void(0)" data-tip="{{__('Quick View')}}"   id="QuickView"><i
                                            class="ti-eye"></i>
<span class="hidden">{{ $latest_product->id }}</span>
                                        </a></li>

                                

 @if($Attributecount  > 0 or $countoptions >0 )
<li><a href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
</a>
</li>
                   
                  @else
<li><a id="add_to_Wishlist" href="javascript:void(0)" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
<span class="hidden">{{ $latest_product->id }}</span>
</a>
</li>

                 @endif


                                
                                <li>
                  @if($Attributecount  > 0 or $countoptions >0 )

                  <a href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i></a>
                  @else

                   <a  id="add_to_cart" href="javascript:void(0)" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i>
<span class="hidden">{{ $latest_product->id }}</span>

                   </a>

                  

                  


                 @endif
                                </li>
                            </ul>


         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  


                         
                             

                     @if($latest_product->price->special_price !== null )

                            <span class="product-new-label">{{ __('Sale') }}</span>
                            <span class="product-discount-label">
                          @if($latest_product->price->price_type == 1)
                               {{__('Discount')}}
                            {{$latest_product->price->special_price}} 

                         {{ $currency->currency_icon ?? '' }}
                           @else
                             %  {{$latest_product->price->special_price}}  {{__('Discount')}}
                           @endif
                            </span>
                        @endif

                        </div>
                         <ul class="rating">
                              @php
        $count=App\Models\Review::where('term_id',$latest_product->id)->count(); 
   if($count == 0)
        {
        $count = 1;
        }


       $rating=0;
        foreach(App\Models\Review::where('term_id',$latest_product->id)->get() as $R)
        {
            $rating=$R->rating +$rating;
        }

       

           $finalrate=$rating/$count;

                                @endphp
                            

                                @if($finalrate >= 1 and $finalrate  < 2)
                                <i class="fa fa-star"></i> 
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                                @endif

                                 @if($finalrate >= 2 and $finalrate < 3)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>

                             

                                @endif

                                 @if($finalrate >= 3  and  $finalrate< 4)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                                @endif

                                 @if($finalrate >= 4 and $finalrate <= 5)
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                                @endif
                        </ul>
                        <div class="product-content">
                            <h3 class="title"><a href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}">{{$latest_product->title}}

                            </a></h3>
                            <div class="price">
                     @if($latest_product->price->special_price !== null )
         
         {{$latest_product->price->price}}
{{ $currency->currency_icon ?? '' }}
                       

                <span>
                   
                    {{$latest_product->price->regular_price}}
                     {{ $currency->currency_icon ?? '' }}
                     
                 </span>
                @else
{{$latest_product->price->price}}

 {{ $currency->currency_icon ?? '' }} 
                  @endif
                            </div>
                           
                            @if($latest_product->stock->stock_status == 1 and  $latest_product->stock->stock_qty !== 0 )
 @if($Attributecount  > 0 or $countoptions >0 )
                  <a   class="add-to-cart"  href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}">+ {{__('Add To Cart')}}</a>
                  @else
                   <a   class="add-to-cart"  href="{{url('/')}}/add_to_cartforent/{{$latest_product->id}}">+ {{__('Add To Cart')}}</a>
                 @endif


         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  





                        </div>
                    </div>
                </div>
                
                
                   @endforeach
                 
            </div>
        </div>
    </section>

    <div class="added-notification">

        
        <span class="imgviw"></span>
        <h3>{{__('Data add to cart')}}</h3>
    </div>

     

 @endif


 @push('js')

   
            
  <script type="text/javascript">
      $(document).on('click','#QuickView',function(){
              var text =$(this).text();
              text=text.toString();
                    var id= text;
        $.ajax({
            url:"{{url('/QuickView')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:text,

           },
            dataType:"json",
            beforeSend:function(){
                      
                      
            },
            success:function(data)
            {
                
   $('.exampleModal_title').html(data.title);
   $('.exampleModal_price_detail').html(data.exampleModal_price_detail);
   $('.color_variant').html(data.color_variant);
   $('.content').html(data.content);
   $('.productbuttons').html(data.productbuttons);
   $('.sizebox').html(data.sizebox);
   $('.quick_view_img').html(data.quick_view_img);


     document.getElementById('test1').click();
  // $('#test1')[0].click();
            }
        });
             return false;
    
                    
                     
                    });
  </script>







  <script type="text/javascript">
      $(document).on('click','#add_to_cart',function(){
              var text =$(this).text();
              text=text.toString();
                    var id= text;
                        
        $.ajax({
            url:"{{url('/cart')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:text,
            qty:1,

           },
            dataType:"json",
            beforeSend:function(){
                      
                 $('.cart_sucess').html('');      
            },
            success:function(data)
            {
                $('.cart_sucess').html(data.success);  

              //$('#cartEffect').text("{{__('Data add to cart')}}");
        $('.added-notification').addClass("show");
        setTimeout(function () {
            $('.added-notification').removeClass("show");
        }, 5000);

  $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.cart_qty_cls').html(data.count);
              $('.cartHhide').addClass('hidden');
   $('.append_new_cart').html(data.cart_content);
   $('.imgviw').html(data.imgviw);
                }
        });
             return false;
    
                 
    
                    
                     
                    });
  </script>



   <script type="text/javascript">
      $(document).on('click','#add_to_Wishlist',function(){
              var text =$(this).text();
              text=text.toString();
                    var id= text;

            
        $.ajax({
            url:"{{ url('/') }}/add_wishlist_new",
            method:"POST",
          data :{
            _token:'{{ csrf_token() }}',
            id:id,
          

           },
            dataType:"json",
            beforeSend:function(){
                      $('.cart_sucess').html('');
            },
            success:function(data)
            {
             
             $('.cart_sucess').html(data.success);  
 $('.wishlist_qty_cls').html(data.countwishlist);
              //$('#cartEffect').text("{{__('Data add to cart')}}");
        

  $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.cart_qty_cls').html(data.count);
              $('.cartHhide').addClass('hidden');
   $('.append_new_cart').html(data.cart_content);
   $.notify('{{__("Added to favourites")}}', "success");
 
    

            }
        });
             return false;
    
                    
                     
                    });
  </script>




       @endpush



@endsection
