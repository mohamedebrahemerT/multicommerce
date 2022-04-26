@extends('frontend.bigbag.index')
@section('content')
 
@section('content')    
 
<input type="hidden" id="category" value="{{ $info->id ?? null }}">  

<div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>  {{ $info->name ?? __('Product List') }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $info->name ?? __('Products') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
	
	<section class="only-mobile filter d-block d-sm-none">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="filter-main-btn"><span class="filter-btn btn"><i class="fa fa-filter"
                                aria-hidden="true"></i> {{ __('Filter') }}</span></div>
                </div>
            </div>
        </div>
    </section>
	
    <section>
        <div class="container">
            <div class="row my-5">
                <div class="col-md-3 collection-filter-block">
				<div class="collection-mobile-back  d-block d-sm-none"><span class="filter-back"><i class="fa fa-angle-left"
                                aria-hidden="true"></i> {{ __('back') }}</span></div>


 <div class="collection-collapse-block  open">

 

                        <h3 class="collapse-block-title">{{ __('category') }}</h3>
                        <div class="collection-collapse-block-content">
                            <div class="collection-brand-filter">
@php
  $user_id = domain_info('user_id');
$category=App\Category::where('user_id',$user_id)->where('type','category')->with('preview')->take(5)->get();
@endphp

                      <form class="form" method="post" action="" id="frm">  
           
                @foreach($category as $row)
                              
                                <div class="form-check collection-filter-checkbox">
                    <input name="categories[]" value="{{$row->id}}" type="checkbox" class="form-check-input categories" id="{{ $info->id}}" @if($row->id ==$info->id) checked @endif   >
                                    <a class="form-check-label" for="category-{{ $info->id}}" 
                    href="/category/{{$row->slug}}/{{$row->id}}">
                                         {{ $row->name  }}
                                        
                                    </a>
                                </div>
                @endforeach

                               

                            </div>
                        </div>
                    </div>
                      <a href="javascript:void(0)"   class="btn btn-solid hover-solid" id="cartEffect1">
                               
                               {{ __('filter') }}
                            </a>

                    </form>

                     @push('js')
                      <script type="text/javascript">
      $(document).on('click','#cartEffect1',function(){

       


         var categories = [];

var eventTypes = document.forms['frm'].elements[ 'categories[]' ];

for (var i=0, len=eventTypes.length; i<len; i++) {
    if (eventTypes[i].checked ) {
        categories.push($(eventTypes[i]).val());
    }
}

               

            
         $.ajax({
            url:"{{ url('get_shop_products') }}",
            method:"post",
           data :{
            _token:'{{ csrf_token() }}',
            categories:categories,

           },
            dataType:"json",
            beforeSend:function()
            {
             $('.appenddata').html('');  
                    
            },
            success:function(data)
            {
                    
             $('.appenddata').html(data.success);  
            
              
                
             ;

            }
        });
             return false;
    
    
                    
                     
                    });
  </script>

                     @endpush



                    <div class="collection-collapse-block  open">
                        <h3 class="collapse-block-title">{{ __('brand') }}</h3>
                        <div class="collection-collapse-block-content">
                            <div class="collection-brand-filter">
@php
  $user_id = domain_info('user_id');
$brands=App\Category::where('user_id',$user_id)->where('type','brand')->with('preview')->take(5)->get();
@endphp
           
                @foreach($brands as $brand)
                              
                                <div class="form-check collection-filter-checkbox">

                                 
                                    <input value="{{$brand->id}}" type="checkbox" class="form-check-input brands" id="zara" @if($brand->id ==$info->id) checked @endif  >

                                    <a class="form-check-label" for="zara"

href="/category/{{$brand->slug}}/{{$brand->id}}?b={{$brand->id}}"


                                    >
                                         {{ $brand->name  }}
                                        
                                    </a>
                                </div>
                @endforeach

                               

                            </div>
                        </div>
                    </div>

                     <div class="collection-collapse-block border-0 open">
                        <h3 class="collapse-block-title">{{ __('Price') }}</h3>
                        <div class="collection-collapse-block-content">
                            <div class="collection-brand-filter">
                                <div class="range-slider">
                                    <input type="text" class="js-range-slider" name="my_range" value="" id="myTextBox"  id="myTextBox" />
                                </div>
                            </div>
                        </div>
                    </div>

                    @push('js')
                    <script type="text/javascript">
                         $(".js-range-slider").ionRangeSlider({
  min: 0,
  max: 100000,
  from: 0,
  prefix: " {{ $currency->currency_icon ?? '' }}",
});

                            $("#myTextBox").on("input paste", function() 
                            {
                        var my_range=$(this).val(); 

                        
                  $.ajax({
            url:"{{ url('get_shop_products_my_range_price') }}",
            method:"get",
           data :{
            _token:'{{ csrf_token() }}',
            min_price:0,
            my_range:my_range,
            cat_id:'{{$info->id}}',
            

           },
            dataType:"json",
            beforeSend:function()
            {
             $('.appenddata').html('');  
                    
            },
            success:function(data)
            {
                   
             $('.appenddata').html(data.success);  
              
                 
    document.getElementById("product-page").style.display = "none";

            }
        });
             return false;
    




                            });

                    </script>
                    @endpush
 @php

  $user_id = domain_info('user_id');
 
                    $posts = App\Category::where([
            ['user_id',   $user_id],
            ['type', 'parent_attribute'],
        ])->with('childrenCategories')->withCount('parent_variation')->get();

@endphp

 @foreach($posts as $row)   

                     <div class="collection-collapse-block border-0 open">
                        <h3 class="collapse-block-title">
                           {{ $row->name }}
                        </h3>
                        <div class="collection-collapse-block-content">
                            <div class="collection-brand-filter">

                                @foreach($row->childrenCategories as $r) 

                                <div class="form-check collection-filter-checkbox">
        <input type="checkbox" value="{{$r->id}}" class="form-check-input categories"  id="category-{{ $r->id }}" @isset($cc) 
                                    @if($cc ==  $r->id)
checked
                                    @endif
                                    @endisset  >

         
                                    
                                    <a class="form-check-label" for="hundred"


href="/category/{{$row->slug}}/{{$row->id}}?cc={{$r->id}}" 
                                    >{{ $r->name }}</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
 @endforeach


                    <!--div class="collection-collapse-block open">
                        <h3 class="collapse-block-title">{{ __('colors') }}</h3>
                        <div class="collection-collapse-block-content">
                            <div class="color-selector">
                                <ul>
                                    <li class="color-1 active"></li>
                                    <li class="color-2"></li>
                                    <li class="color-3"></li>
                                    <li class="color-4"></li>
                                    <li class="color-5"></li>
                                    <li class="color-6"></li>
                                    <li class="color-7"></li>
                                </ul>
                            </div>
                        </div>
                    </div -->

                   

                  




                </div>

             @if($products->count() > 0)
                <div class="col-md-9">
                    <div class="products-section">
                        <div class="shop-top-bar">
                            <div class="shop-bar-inner">
                                <div class="toolbar-amount">
                                    <span>Showing Products 1-24 Of 10 Result</span>
                                </div>
                            </div>
                            <!-- product-select-box start -->
                            <div class="product-select-box">
                                <div class="product-short">
                                    <p>{{ __('Sort By') }}:</p>
                        <select class="form-control SortBy" name="SortBy">
             <!--option value="Relevance">{{ __('Relevance') }}</option>
                 <option value="Low-High">{{ __('Price (Low &gt; High)') }}</option>
             <option value="High-Low">{{ __('High-Low') }}</option>
             <option value="Rating-Lowest">{{ __('Rating (Lowest)') }}</option>
             <option value="Model-A-Z">{{ __('Model (A - Z)') }}</option>
             <option value="Model-Z-A">{{ __('Model (Z - A)') }}</option -->

             <option value="A-Z">{{ __('Name (A - Z)') }} </option>
             <option value="Z-A">{{ __('Name (Z - A)') }}</option>
         


                                    </select>
                                </div>
                            </div>
                            <!-- product-select-box end -->
                        </div>

                    </div>

                    <span class="appenddata"></span>

                    <div class="row my-5 product-page " id="product-page">
                   @foreach($products as $product)

                 

                   @php
                   $Attributecount=App\Attribute::where('term_id',$product->id)->groupBy('category_id')->count();

                     $countoptions=$product->options->count()
                     @endphp

                        <div class="col-xl-4 col-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="{{url('/')}}/product/{{$product->slug}}/{{$product->id}}">
                                        <img class="pic-1" src="{{ asset($product->preview->media->url ?? 'uploads/default.png') }}">
                                        <img class="pic-2" src="{{ asset($product->preview->media->url ?? 'uploads/default.png') }}">
                                    </a>

 @if($product->stock->stock_status == 1 and  $product->stock->stock_qty !== 0 )
 <ul class="social">

                                          <li><a href="javascript:void(0)" data-tip="{{__('Quick View')}}"   id="QuickView"><i
                                            class="ti-eye"></i>
<span class="hidden">{{ $product->id }}</span>
                                        </a></li>

                                        @if($Attributecount  > 0 or $countoptions >0 )
<li><a href="{{url('/')}}/product/{{$product->slug}}/{{$product->id}}" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
</a>
</li>
                   
                  @else
<li><a id="add_to_Wishlist" href="javascript:void(0)" data-tip="{{__('Add to Wishlist')}}"><i class="ti-heart"></i>
<span class="hidden">{{ $product->id }}</span>
</a>
</li>

                 @endif


                                        <li><a href="{{url('/')}}/addtocart?id={{$product->id}}&&qty=1" data-tip="{{__('Add To Cart')}}"><i class="ti-shopping-cart"></i></a></li>
                                    </ul>
  


         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  

                                    
                                   

   @if($product->price->special_price !== null )
                            <span class="product-new-label">{{ __('Sale') }}</span>
                            <span class="product-discount-label">
                               @if($product->price->price_type == 1)
                               {{__('Discount')}}
                            {{$product->price->special_price}} 

                         {{ $currency->currency_icon ?? '' }}
                           @else
                         %     {{$product->price->special_price}}  {{__('Discount')}}
                           @endif
                            </span>
                            @endif


                                </div>
                                 <ul class="rating">
                              @php
        $count=App\Models\Review::where('term_id',$product->id)->count(); 
   if($count == 0)
        {
        $count = 1;
        }


       $rating=0;
        foreach(App\Models\Review::where('term_id',$product->id)->get() as $R)
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
                                    <h3 class="title"><a href="{{url('/')}}/product/{{$product->slug}}/{{$product->id}}">
                                         {{$product->title}}
                                    </a></h3>
                    <div class="price">
                 {{$product->price->price}} {{ $currency->currency_icon ?? '' }}
                     @if($product->price->special_price !== null )
                     <span>{{$product->price->regular_price}} {{ $currency->currency_icon ?? '' }}</span>
                                             @endif

                                    </div>

                                     @if($product->stock->stock_status == 1 and  $product->stock->stock_qty !== 0 )
 <a class="add-to-cart" href="{{url('/')}}/addtocart?id={{$product->id}}&&qty=1">+ {{__('Add To Cart')}}</a>

         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  


                                  



                                </div>
                            </div>
                        </div>

                        
                   @endforeach
                         
                    </div>

                    <!--div class="product-pagination">
                        <div class="theme-paggination-block">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                           
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="product-search-count-bottom">
                                        <h5>Showing Products 1-24 of 10 Result</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div -->
                </div>
             @else
   <div class="col-md-9">
             <h1>{{ __('No item found') }}</h1>
         </div>
             @endif



            </div>
        </div>
    </section>


 

@push('js')

   <!--script type="text/javascript">
      $(document).ready(function(){
    var selectedArray = [];
    $("input.categories:checkbox").on("click", function(){
        
        if ($(this).is(":checked"))
        {
        selectedArray.push($(this).val());
 
             
      }
      else {
        selectedArray.splice(selectedArray.indexOf($(this).val()));
      }
          
      $("#arr").text(selectedArray);

              

              $.ajax({
            url:"{{ url('get_shop_products') }}",
            method:"get",
           data :{
            _token:'{{ csrf_token() }}',
            categories:selectedArray,

           },
            dataType:"json",
            beforeSend:function()
            {
             $('.appenddata').html('');  
                    
            },
            success:function(data)
            {
                    
             $('.appenddata').html(data.success);  
            
              
                
             ;

            }
        });
             return false;
    
    



   });
})
   </script -->  



   <!--script type="text/javascript">
      $(document).ready(function(){
    var selectedArray = [];
    $("input.brands:checkbox").on("click", function(){

        
        
        if ($(this).is(":checked"))
        {
        selectedArray.push($(this).val());
      }
      else {
        selectedArray.splice(selectedArray.indexOf($(this).val()));
      }
          
      $("#arr").text(selectedArray);

              

              $.ajax({
            url:"{{ url('get_shop_products') }}",
            method:"get",
           data :{
            _token:'{{ csrf_token() }}',
            brands:selectedArray,

           },
            dataType:"json",
            beforeSend:function()
            {
             $('.appenddata').html('');  
                    
            },
            success:function(data)
            {
                   
             $('.appenddata').html(data.success);  
              

  

            }
        });
             return false;
    
    



   });
})
   </script -->    


   
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




 @push('js')


    
<script type="text/javascript">
            $('.SortBy').on('change',function() {

                 var id = $(this).val();
 
                     
                     
                  
             if (id == 'Relevance') 
             {
    window.location.href = '{{ url("/") }}/category/{{$info->slug}}/{{$info->id}}?FliterType=Relevance'
             }
               else if (id == 'A-Z') 
             {
    window.location.href = '{{ url("/") }}/category/{{$info->slug}}/{{$info->id}}/?FliterType=A-Z'

             }
              else if (id == 'Z-A') 
             {
    window.location.href = '{{ url("/") }}/category/{{$info->slug}}/{{$info->id}}/?FliterType=Z-A'

             }
              else if (id == 'Low-High') 
             {
    window.location.href = '{{ url("/") }}/category/{{$info->slug}}/{{$info->id}}/?FliterType=Low-High'

             }
             else if (id == 'High-Low') 
             {
    window.location.href = '{{ url("/") }}/category/{{$info->slug}}/{{$info->id}}/?FliterType=High-Low'

             }
             else if (id == 'Rating-Lowest') 
             {
    window.location.href = '{{ url("/") }}/category/{{$info->slug}}/{{$info->id}}/?FliterType=Rating-Lowest'

             }

             else if (id == 'Model-A-Z') 
             {
    window.location.href = '{{ url("/") }}/category/{{$info->slug}}/{{$info->id}}/?FliterType=Model-A-Z'

             }

             else if (id == 'Model-Z-A') 
             {
    window.location.href = '{{ url("/") }}/category/{{$info->slug}}/{{$info->id}}/?FliterType=Model-Z-A'

             }
              
             else
             {
    window.location.href = '{{ url("/") }}/category/{{$info->slug}}/{{$info->id}}' 

             }
             
              
  
   

});
        </script>

    

    
  
    
 

    @endpush
    
@endsection      
 







