@extends('frontend.bigbag.index')
@section('content')
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>{{__('Best selling products')}}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}/">
                            {{ __('home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{__('Best selling products')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

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
                                <li><a href="/add_to_wishlist/{{$best_selling->id}}" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i></a></li>
                                <li><a href="{{url('/')}}/addtocart?id={{$best_selling->id}}&&qty=1" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  
                           
                             

 @if($best_selling->price->special_price !== null )
                            <span class="product-new-label">{{ __('Sale') }}</span>
                            <span class="product-discount-label">
                          @if($best_selling->price->price_type == 1)
                            {{$best_selling->price->special_price}} 
                           @else
                              {{$best_selling->price->special_price}} %
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
         {{$best_selling->price->price}}{{ $currency->currency_icon ?? '' }}
  <span>{{ $currency->currency_icon ?? '' }}{{$best_selling->price->regular_price}}</span>
    @else
 {{$best_selling->price->price}}{{ $currency->currency_icon ?? '' }}
                  @endif
                            </div>
 @if($best_selling->stock->stock_status == 1 and  $best_selling->stock->stock_qty !== 0 )
   <a class="add-to-cart" href="{{url('/')}}/addtocart?id={{$best_selling->id}}&&qty=1">+ {{__('Add To Cart')}}</a>

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
 @endif

 

  
   
 

@endsection
