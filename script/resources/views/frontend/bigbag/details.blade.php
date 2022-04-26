@extends('frontend.bigbag.index')
@section('content')
        @push('style')
     
        @endpush
    
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>{{ __('PRODUCT') }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}/">
                            {{ __('home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{ __('PRODUCT') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container">

         
         
            <div class="row my-5">
                <div class="col-md-6">
                    <div class="slider-for">
                                @foreach($info->medias as $key => $row)

                        <span  id='ex1' class="venobox zoom" data-gall="myGallery" >
    <img src='{{ asset($row->url) }}'  />
    <p></p>
  </span>
                                @endforeach
                      
                    </div>
                    <div class="slider-nav">
                                @foreach($info->medias as $key => $row)

                        <div><img class="pic-1" src="{{ asset($row->url) }}"></div>
                                @endforeach

                        
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="product-right">
                        <h2>
                            {{$info->title}}
                        </h2>
                        <div class="rating-section">
                            <div class="rating">
                                @php
        $count=App\Models\Review::where('term_id',$info->id)->count(); 
   if($count == 0)
        {
        $count = 1;
        }


       $rating=0;
        foreach(App\Models\Review::where('term_id',$info->id)->get() as $R)
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
                              
                            </div>
                            <h6>{{number_format($finalrate, 1)}}   {{ __('ratings') }}</h6>
                        </div>

                        <div class="label-section">
                            @if($info->featured == 1 )
                                 <span class="badge badge-grey-color">
                            {{ __('Trending products') }}
                                 </span>
                           

                             @elseif($info->featured == 2 )
                                 <span class="badge badge-grey-color">

                            {{ __('Best selling products') }}
                                 </span>
                            
                            @endif

                        
                            <span class="label-text"> {{--$info->categories->name--}}</span>
                        </div>

                        
                        <h3 class="price-detail">
 <cc class="ppprice">  {{$info->price->price}}  </cc>    {{ $currency->currency_icon ?? '' }}   



@if($info->price->special_price !== null )
                    <del>   {{$info->price->regular_price}}  {{ $currency->currency_icon ?? '' }} </del>
                           @endif



                    <span>

                      @php
                      use Carbon\Carbon;
                        $mydate= Carbon::now()->toDateString();
                      @endphp
                             
                       @if ($info->price->ending_date >= $mydate)     
  @if($info->price->price_type == 1)
                            {{$info->price->special_price}} 
                           @else
                              {{$info->price->special_price}}  %
                           @endif

@if($info->price->special_price !== null )
                    {{ __('off') }}
                            @endif

                </span>
                @endif




              </h3>






                        <ul class="color-variant">
@php
   $optionss = json_decode($info->options, true);

    

@endphp

                                            @foreach ($info->options as $key=> $row)
        {{$row->name}}:<br>
                                                                       

                         
  @foreach(App\Models\Termoption::where('p_id','!=',null)->where('term_id',$info->id)->get() as $key => $option )
        <li class="bg-light2" value=" {{$option->id}} "> 
 
          </li>
  {{$option->name}}   


        
         <br>
          
   

  
                                
               
                           

      
 @endforeach
      @endforeach

                        </ul >
                      

    <form action="{{ url('/') }}/cart/{{$info->id}}" method="POST" id="frm" >
                             {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $info->id }}">
                <span class="cart_sucess"> </span>

                        <div id="selectSize" class="addeffect-section product-description border-product">
  @foreach(App\Attribute::where('term_id',$info->id)->groupBy('category_id')->get() as $key => $category )

                <h6 class="product-title">{{$category->Category->name}} </h6>


                            <div class="size-box   ">
                                <ul class="size-boxul">
     @foreach(App\Attribute::where('category_id',$category->category_id)->where('term_id',$info->id)->get() as $variation )   
 <li value="{{$variation->variation->id}}" style="margin: 2%;"><a href="javascript:void(0)" class="bg-light2" style="display: inline-block;
height: 20px;
width: 20px;
border-radius: 100%;
margin-right: 5px;
-webkit-transition: all 0.1s ease;
transition: all 0.1s ease;
vertical-align: middle;">  
    
      

 

   </a></li>{{$variation->variation->name}} 
 @endforeach
                                    
                                </ul>
                            </div>
 @endforeach

                     <h6 class="product-title">{{ __('quantity') }}</h6>
                            <div class="qty-box">
                                <div class="input-group"><span class="input-group-prepend"><button type="button"
                                            class="btn quantity-left-minus" data-type="minus" data-field=""><i
                                                class="ti-angle-left"></i></button> </span>
                                    <input type="text" name="qty" class="form-control input-number" value="1">
                                    <span class="input-group-prepend"><button type="button"
                                            class="btn quantity-right-plus" data-type="plus" data-field=""><i
                                                class="ti-angle-right"></i></button></span>
                                </div>
                            </div>
                        </div>
                        <div class="product-buttons">
 @php
                   $Attributecount=App\Attribute::where('term_id',$info->id)->groupBy('category_id')->count();

                     $countoptions=$info->options->count()
                     @endphp


 @if($info->stock->stock_status == 1 and  $info->stock->stock_qty !== 0 )
 @if($Attributecount  > 0 or $countoptions >0 )
                      <a href="javascript:void(0)"   class="btn btn-solid hover-solid" id="cartEffect">
                                <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i>
                               {{ __('add to cart') }}
                            </a>
                            
                  @else

                  <a href="javascript:void(0)"   class="btn btn-solid hover-solid" id="cartEffect1">
                                <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i>
                               {{ __('add to cart') }}
                            </a>
                            

                 @endif

                            



                             </form>

                            <a id="add_wishlist" href="javascript:void(0)" class="btn btn-solid hover-solid"><i class="fa fa-bookmark fz-16 me-2"
                                    aria-hidden="true"></i>
                              {{ __('wishlist') }}  
                            </a>

         @else
  <span style="color: red"> {{ __('out of stock') }} </span>
                 @endif  
  

                     

                     

                        </div>
                        <!--div class="product-count">
                            <ul>
                                <li>
                                    <img src="{{url('/')}}/frontend/bigbag/images/truck.png" class="img-fluid" alt="image">
                                    <span class="lang"> {{ __('Free shipping for orders above $500 USD') }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="border-product">
                            <h6 class="product-title">{{ __('shipping info') }}</h6>
                            <ul class="shipping-info">
                                <li>{{ __('100% Original Products') }}</li>
                                <li>{{ __('Free Delivery on order above Rs. 799') }} </li>
                                <li>{{ __('Pay on delivery is available') }} </li>
                                <li> {{ __('Easy 30 days returns and exchanges') }}  </li>
                            </ul>
                        </div -->
                        <div class="border-product">
                            <h6 class="product-title">   {{ __('share it') }} </h6>
                            <div class="product-icon">
                            <div class="sharethis-inline-share-buttons"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tab-product m-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <ul class="nav nav-tabs nav-material" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-toggle="tab" href="#tab1">{{ __('Details') }}</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#tab2">{{ __('Specification') }}</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#tab3">{{ __('Reviews') }}</a>
                            <div class="material-border"></div>
                        </li>
                    </ul>
                    <div class="tab-content nav-material" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab1">
                            <div class="product-tab-discription">
                                <div class="part">
                                    <p>
                  @if(Session::get('locale') == 'ar')

                                       {{ $content->content->ar}}
                                       @else
                                       {{ $content->content->en}}

     @endif

                                    </p>
                                </div>
                                 
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <p>
                                  @if(Session::get('locale') == 'ar')

                               {{ $content->excerpt->ar ?? '' }}
                                       @else
                                      {{ $content->excerpt->en ?? '' }}

     @endif
                            </p>

                             <div class="single-product-tables">
                                 
                              

    @foreach(App\Attribute::where('term_id',$info->id)->groupBy('category_id')->get() as $category )
                


                                <table >

                                    <thead>
                                       <tr>{{$category->Category->name}}</tr> 
                                     
                                    </thead>
                                    <tbody>
                                        @foreach(App\Attribute::where('category_id',$category->category_id)->where('term_id',$info->id)->get() as $variation )  
                                        <tr >
                                 <td>{{$variation->variation->name}}</td>
                                            
                                        </tr>
 @endforeach

                                        
                                    </tbody>
                                </table>
 
 @endforeach
    

                            </div>
                           
                                 
                               
                        
  @foreach(App\Models\Termoption::where('p_id','!=',null)->where('term_id',$info->id)->get() as $option )
   <table style="  margin:1%"  class="table table-bordered">

                                      <thead>
                                       <tr>
                                           <td>{{__('option')}}</td>
                                           <td>{{__('price')}}</td>
                                       </tr> 
                                     
                                    </thead>
                                    <tbody>
                                       
                                        <tr >
                                 <td>{{$option->name}}</td>
                                 <td>{{$option->amount}} {{ $currency->currency_icon ?? '' }}  </td>
                                
                                            
                                        </tr>


                                        
                                    </tbody>
                                </table>
                                <br>
 @endforeach

                             
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            <ul class="comment-section">
         @foreach(App\Models\Review::where('term_id',$info->id)->get() as $Review )
                                <li>
                                    <div class="media">
 

                                  

 @if($Review->User->image == '0')
                    <img src="{{ url('/')}}/uploads/{{$Review->User->id}}/photo.png" class="mr-2" alt="photo here">
                     @else
 <img src="{{ url('/') }}/frontend/bigbag/images/profile.jpg" class="mr-2" alt="photo here">
                     @endif





                                        <div class="media-body">
                                            <h6>

                                               {{$Review->name}}
                                                 <span>
                                            

{{$Review->created_at}}
                                        </span></h6>
                                            <p>{{$Review->comment}}</p>

                                        </div>
                                    </div>
                                </li>
                                  @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
 

    </section>

    <div class="added-notification">

        
        <span class="imgviw"></span>
        <h3>{{__('Data add to cart')}}</h3>
    </div>


    <div class="added-notification2" style="display: none;">

        
        <span class="imgviw2"></span>
              <h3 >{{__('Added to favourites')}}</h3>
    </div>


    @push('js')
            <script type="text/javascript">
      $(document).on('click','#cartEffect',function(){

       if (!$("#selectSize .size-box ul").hasClass('selected')) 
        {
             $('#selectSize').addClass('cartMove');
        return 0;

       
      } 


          var frm=$('#frm').serialize() ;
         
            
        $.ajax({
            url:"{{ url('/') }}/cart/{{$info->id}}",
            method:"POST",
           data :frm,
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
      $(document).on('click','#cartEffect1',function(){

       


          var frm=$('#frm').serialize() ;
         
            
        $.ajax({
            url:"{{ url('/') }}/cart/{{$info->id}}",
            method:"POST",
           data :frm,
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
      $(document).on('click','#add_wishlist',function(){

      /*  if (!$("#selectSize .size-box ul").hasClass('selected')) 
        {
             $('#selectSize').addClass('cartMove');
        return 0;

       
      } */




          var frm=$('#frm').serialize() ;
         
            
        $.ajax({
            url:"{{ url('/') }}/add_wishlist_new/{{$info->id}}",
            method:"POST",
          data :{
            _token:'{{ csrf_token() }}',
            id:' {{$info->id}}',
            qty:1,
          

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
        $('.added-notification2').addClass("show");
        setTimeout(function () {
            $('.added-notification2').removeClass("show");
        }, 5000);

  $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.wishlist_qty_cls').html(data.countwishlist);
              $('.cartHhide').addClass('hidden');
   $('.append_new_cart').html(data.cart_content);
   $('.imgviw2').html(data.imgviw);
 
    

            }
        });
             return false;
    
                    
                     
                    });
  </script>

<script type="text/javascript">
    $('.color-variant li').on('click', function (e) {
  $(".color-variant li").removeClass("active");
  $(this).addClass("active");    
});
</script>

<script type="text/javascript">
    $('.size-box li').on('click', function (e) {
  $(".size-box li").removeClass("active");
  $(this).addClass("active");    
});
</script>

 


<script type="text/javascript">
    $(".color-variant li").click(function ()
{       
var a = $(this).attr("value");
  
var a = a.substring(0, a.length - 1);   
    
   
 $.ajax({
            url:"{{url('/termoptions_price')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:a,
            term_id:' {{$info->id}}',
            type:'termoptions'

           },
            dataType:"json",
            beforeSend:function(){
                      $('.cart_sucess').html('');
                      $('.cc').addClass('hidden');
                  $('.loading-save-c').removeClass('hidden');

                  ///////////////////////////////

                  //////////////////////////////////
                      
            },
            success:function(data)
            {
                   $('.loading-save-c').addClass('hidden');
   
 

 //$.notify('{{__("Item updaed!")}}', "success");
             
             


             $('.ppprice').html(data.success); 

       

  


            }
        });
             return false;



 
});
</script>



<script type="text/javascript">
    $(".size-boxul li").click(function ()
{       
var a = $(this).attr("value");
  
   
   
   
 $.ajax({
            url:"{{url('/varent_selction')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:a,
            term_id:' {{$info->id}}',
            type:'varent_selction'

           },
            dataType:"json",
            beforeSend:function(){
                      $('.cart_sucess').html('');
                      $('.cc').addClass('hidden');
                  $('.loading-save-c').removeClass('hidden');

                  ///////////////////////////////

                  //////////////////////////////////
                      
            },
            success:function(data)
            {
                   $('.loading-save-c').addClass('hidden');
   
 

//$.notify('{{__("Item updaed!")}}', "success");
             
             

       

  


            }
        });
             return false;



 
});
</script>



     <style>
    /* styles unrelated to zoom */
   
  
    /* these styles are for the demo, but are not required for the plugin */
    .zoom {
      display:inline-block;
      position: relative;
    }
    
    /* magnifying glass icon */
    .zoom:after {
      content:'';
      display:block; 
      width:33px; 
      height:33px; 
      position:absolute; 
      top:0;
      right:0;
      background:url(icon.png);
    }

    .zoom img {
      display: block;
    }

    .zoom img::selection { background-color: transparent; }

    #ex2 img:hover { cursor: url(grab.cur), default; }
    #ex2 img:active { cursor: url(grabbed.cur), default; }
  </style>
 
  <script src="{{url('/')}}/frontend/bigbag/external/jquery.zoom.js"></script>
  <script>
    $(document).ready(function(){
      $('#ex1').zoom();
      $('#ex2').zoom({ on:'grab' });
      $('#ex3').zoom({ on:'click' });      
      $('#ex4').zoom({ on:'toggle' });
    });
  </script>
  
    
    @endpush

@endsection
