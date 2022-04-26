@extends('frontend.bigbag.index')
@section('content')
        <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>{{__('Offers')}} </h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Offers')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@if($latest_products->count() >= 1 )
    <section>
        <div class="container">
            <div class="row my-5">

                <div class="col-md-12">

                    <div class="row mb-5 product-page">
                    @foreach($latest_products as $latest_product)
                        @if($latest_product->stock->stock_status == 1)

 @if($latest_product->price->special_price !== null )

      <div class="col-xl-4 col-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="{{url('/')}}/product/{{$latest_product->slug}}/{{$latest_product->id}}">
                                <img class="pic-1" src="{{ asset($latest_product->preview->media->url ?? 'uploads/default.png') }}">
                                <img class="pic-2" src="{{ asset($latest_product->preview->media->url ?? 'uploads/default.png') }}">
                            </a>
                            <ul class="social">
                                <li><a href="javascript:void(0)" data-tip="{{__('Quick View')}}"   id="QuickView"><i
                                            class="ti-eye"></i>
<span class="hidden">{{ $latest_product->id }}</span>
                                        </a></li>
                                <li><a href="/add_to_wishlist/{{$latest_product->id}}" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i></a></li>
                                <li><a href="{{url('/')}}/addtocart?id={{$latest_product->id}}&&qty=1" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i></a></li>
                            </ul>
                          

   @if($latest_product->price->special_price !== null )
                            <span class="product-new-label">{{ __('Sale') }}</span>
                            <span class="product-discount-label">
                          @if($latest_product->price->price_type == 1)
                            {{$latest_product->price->special_price}} 
                           @else
                              {{$latest_product->price->special_price}} %
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
                    {{$latest_product->price->price}} {{ $currency->currency_icon ?? '' }}
               <span>{{$latest_product->price->regular_price}} {{ $currency->currency_icon ?? '' }}</span>
                 @else
  {{ $currency->currency_icon ?? '' }}{{$latest_product->price->price}}
                  @endif
                            </div>
                            <a class="add-to-cart" href="{{url('/')}}/addtocart?id={{$latest_product->id}}&&qty=1">+ {{__('Add To Cart')}}</a>
                        </div>
                    </div>
                </div>

                                       @endif
                                       @endif
 
                
                   @endforeach

                         

                    </div>
                            
                    
                    <div class="product-pagination">
                        <div class="theme-paggination-block">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12">
  
                                         	{{$latest_products->links()}}

 
                                  
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                            @endif

 @endsection
