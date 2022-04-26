@extends('frontend.beauty.layouts.app')

@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary bg-pt"  style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('Product Details')}}</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
												<li><a href="{{url('/')}}">{{__('Home')}} </a></li>

							<li>{{__('Product Details')}}</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white">
            <!-- Product details -->
            <div class="container woo-entry">
                <div class="row m-b30">
					<div class="col-lg-5 col-md-5">
						<div class="product-gallery on-show-slider"> 
							<div id="sync1" class="owl-carousel owl-theme owl-btn-center-lr m-b5 owl-btn-1 primary">
                                @foreach($info->medias as $key => $row)
 									
								<div class="item">
									<div class="mfp-gallery">
										<div class="dlab-box">
											<div class="dlab-thum-bx dlab-img-overlay1 ">
												<img src="{{ asset($row->url) }}" alt="">
												<div class="overlay-bx">
													<div class="overlay-icon">
														<a class="mfp-link" href="{{ asset($row->url) }}" title="">
															<i class="ti-fullscreen"></i>
														</a>
												  </div>
												</div>
											</div>
										</div>
									</div>
								</div>

                                @endforeach
								  
								 
								 
								 
							</div>
							<div id="sync2" class="owl-carousel owl-theme owl-none">
                                @foreach($info->medias as $key => $row)
 								
								<div class="item">
									<div class="dlab-media">
										<img src="{{ asset($row->url) }}" alt="">
									</div>
								</div>

								 
                                @endforeach
								 
							</div>
						</div>
					</div>
					<div class="col-lg-7 col-md-7">

   


						<form   method="POST" class="cart sticky-top" id="frm" >
							{{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $info->id }}">
                <span class="cart_sucess"> </span>

							<div class="dlab-post-title ">
								<h4 class="post-title"><a href="#"> {{$info->title}}</a></h4>
								<p class="m-b10">@if(Session::get('locale') == 'ar')

                                       {{ $content->content->ar}}
                                       @else
                                       {{ $content->content->en}}

     @endif</p>
								<div class="dlab-divider bg-gray tb15"><i class="icon-dot c-square"></i></div>
							</div>
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
							<div class="relative">
								
								  <h3 class="m-tb10">
 <cc class="ppprice">  {{$info->price->price}}  </cc>    {{ $currency->currency_icon ?? '' }} 
@if($info->price->special_price !== null )
                    <del>   {{$info->price->regular_price}}  {{ $currency->currency_icon ?? '' }} </del>
                           @endif



                    <span>
                             
                            
  @if($info->price->price_type == 1)
                            {{$info->price->special_price}} 
                           @else
                              {{$info->price->special_price}}  %
                           @endif

@if($info->price->special_price !== null )
                    {{ __('off') }}
                            @endif

                </span></h3>
								<div class="shop-item-rating">
									<span class="rating-bx"> 
										

										 @if($finalrate >= 1 and $finalrate  < 2)
                                       <i class="fa fa-star"></i> 
										<i class="fa fa-star-o"></i>  
										<i class="fa fa-star-o"></i>  
										<i class="fa fa-star-o"></i> 
										<i class="fa fa-star-o"></i> 
									 

                                @endif

                                 @if($finalrate >= 2 and $finalrate < 3)
                                		 <i class="fa fa-star"></i> 
										 <i class="fa fa-star"></i> 
										<i class="fa fa-star-o"></i>  
										<i class="fa fa-star-o"></i> 
										<i class="fa fa-star-o"></i> 

                             

                                @endif

                                 @if($finalrate >= 3  and  $finalrate< 4)
                              			 <i class="fa fa-star"></i> 
										 <i class="fa fa-star"></i> 
										<i class="fa fa-star"></i>  
										<i class="fa fa-star-o"></i> 
										<i class="fa fa-star-o"></i> 
                                @endif

                                 @if($finalrate >= 4 and $finalrate <= 5)
                               <i class="fa fa-star"></i> 
										<i class="fa fa-star"></i> 
										<i class="fa fa-star"></i>  
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o"></i> 
                                
                             
                                @endif
									</span>
									<span>{{number_format($finalrate, 1)}}   {{ __('ratings') }}</span>
								</div>
							</div>
							<div class="shop-item-tage">
								<span>Tags :- </span>

								@if($info->featured == 1 )
                                  <a href="#">
                            {{ __('Trending products') }}
                                                                </a>

                           

                             @elseif($info->featured == 2 )
                               <a href="#">

                            {{ __('Best selling products') }}
                                </a>
                            
                            @endif

								 
							</div>
							<div class="dlab-divider bg-gray tb15"><i class="icon-dot c-square"></i></div>
							   <input type="hidden" name="qty" class="form-control input-number" value="1">
							<button  onclick="return 0;" id="cartEffect1" class="site-button radius-no"><i class="ti-shopping-cart"></i>  {{ __('add to cart') }}</button>

							<button class="site-button radius-no"><i class="ti-envelope"></i><a style="color:#fff;" href="{{url('/')}}/Book_now/{{$info->id}}"> {{ __('Book now') }}</a></button>
						</form>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="dlab-tabs product-description tabs-site-button">
                            <ul class="nav nav-tabs ">
                                <li><a data-toggle="tab" href="#web-design-1" class="active show"><i class="fa fa-globe"></i>{{ __('Description') }} </a></li>
                                <li><a data-toggle="tab" href="#graphic-design-1"><i class="fa fa-photo"></i> {{ __('Additional Information') }}</a></li>
                                <li><a data-toggle="tab" href="#developement-1"><i class="fa fa-cog"></i> {{ __('Product Review') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="web-design-1" class="tab-pane active">
                                    <p class="m-b10">
                                    	@if(Session::get('locale') == 'ar')

                                       {{ $content->content->ar}}
                                       @else
                                       {{ $content->content->en}}

     @endif
                                    </p> 
                                    </ul>
                                </div>
                                <div id="graphic-design-1" class="tab-pane">
                                   
    @foreach(App\Attribute::where('term_id',$info->id)->groupBy('category_id')->get() as $category )
                


                                <table >

                                    <thead>
                                       <tr>{{$category->Category->name}} </tr> 
                                     
                                    </thead>
                                    <tbody>
                                        @foreach(App\Attribute::where('category_id',$category->category_id)->where('term_id',$info->id)->get() as $variation )  
                                        <tr >
                                 <td>{{$variation->variation->name}}  </td>
                                            
                                        </tr>
 @endforeach

                                        
                                    </tbody>
                                </table>

 @endforeach

                        
  @foreach(App\Models\Termoption::where('p_id','!=',null)->where('term_id',$info->id)->get() as $option )
   <table >

                                      <thead>
                                       <tr>
                                           <td>{{__('option')}}</td>
                                           <td>{{__('amount')}}</td>
                                       </tr> 
                                     
                                    </thead>
                                    <tbody>
                                       
                                        <tr >
                                 <td>{{$option->name}}</td>
                                 <td>{{$option->amount}}</td>
                                
                                            
                                        </tr>


                                        
                                    </tbody>
                                </table>
 @endforeach
                                </div>
                                <div id="developement-1" class="tab-pane">
                                    <div id="comments">
                                        <ol class="commentlist">
         @foreach(App\Models\Review::where('term_id',$info->id)->get() as $Review )

                                            <li class="comment">
                                                <div class="comment_container"> <img class="avatar avatar-60 photo" src="{{url('/')}}/frontend/beauty/images/testimonials/pic1.jpg" alt="">
                                                    <div class="comment-text">
                                                        <div  class="star-rating">
                                                            <div data-rating='3'> <i class="fa fa-star" data-alt="1" title="regular"></i> <i class="fa fa-star" data-alt="2" title="regular"></i> <i class="fa fa-star-o" data-alt="3" title="regular"></i> <i class="fa fa-star-o" data-alt="4" title="regular"></i> <i class="fa fa-star-o" data-alt="5" title="regular"></i> </div>
                                                        </div>
                                                        <p class="meta"> <strong class="author">{{$Review->name}}</strong> <span><i class="fa fa-clock-o"></i> {{$Review->created_at}}</span> </p>
                                                        <div class="description">
                                                            <p>{{$Review->comment}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                  @endforeach
                                              
                                        </ol>
                                    </div>
                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <div id="respond" class="comment-respond">
                                                <h3 class="comment-reply-title" id="reply-title"> {{__('Add a review')}}</h3>
                                                <form class="comment-form" method="post" >
                                                    <div class="comment-form-author">
                                                        <label>{{__('Name')}} <span class="required">*</span></label>
                                                        <input type="text" aria-required="true" size="30" value="" name="author" id="author">
                                                    </div>
                                                    <div class="comment-form-email">
                                                        <label>{{__('Email')}} <span class="required">*</span></label>
                                                        <input type="text" aria-required="true" size="30" value="" name="email" id="email">
                                                    </div>
                                                    <div class="comment-form-rating">
                                                        <label class="pull-left m-r20">{{__('Your Rating')}}</label>
                                                        <div class='rating-widget'>
														<!-- Rating Stars Box -->
														  <div class='rating-stars'>
															<ul id='stars'>
															  <li class='star' title='Poor' data-value='1'>
																<i class='fa fa-star fa-fw'></i>
															  </li>
															  <li class='star' title='Fair' data-value='2'>
																<i class='fa fa-star fa-fw'></i>
															  </li>
															  <li class='star' title='Good' data-value='3'>
																<i class='fa fa-star fa-fw'></i>
															  </li>
															  <li class='star' title='Excellent' data-value='4'>
																<i class='fa fa-star fa-fw'></i>
															  </li>
															  <li class='star' title='WOW!!!' data-value='5'>
																<i class='fa fa-star fa-fw'></i>
															  </li>
															</ul>
														  </div>
														</div>
                                                    </div>
                                                    <div class="comment-form-comment">
                                                        <label>{{__('Your Review')}}</label>
                                                        <textarea aria-required="true" rows="8" cols="45" name="comment" id="comment"></textarea>
                                                    </div>
                                                    <div class="form-submit">
                                                        <input type="submit" value="{{__('Submit')}}" class="site-button" id="submit" name="submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<h5 class="m-b20">{{__('Related Products')}}   </h5>
						<div class="img-carousel-content owl-carousel owl-btn-center-lr owl-btn-1 primary">
							
                   @foreach($RelatedProducts as $RelatedProduct)
                                 
							<div class="item">
								<div class="item-box">
									<div class="item-img">
										<img src="{{ asset($RelatedProduct->preview->media->url ?? 'uploads/default.png') }}" alt="">
										<div class="item-info-in">
											<ul>
												<li><a id="add_to_cartRelatedProduct" href="#"><i class="ti-shopping-cart"></i><span  style="display: none;">{{ $RelatedProduct->id }}</span></a></li>

												<li><a href="{{url('/')}}/product/{{$RelatedProduct->slug}}/{{$RelatedProduct->id}}"><i class="ti-eye"></i></a></li>

																	
					<li><a  id="add_to_Wishlist" href="#"><i class="ti-heart"></i><span style="display:none;">{{ $RelatedProduct->id }}</span></a></li>
											</ul>
										</div>
									</div>
									<div class="item-info text-center text-black p-a10">
										<h6 class="item-title text-uppercase font-weight-500"><a href="{{url('/')}}/product/{{$RelatedProduct->slug}}/{{$RelatedProduct->id}}">{{$RelatedProduct->title}}</a></h6>
										<ul class="item-review">
											

											  @php
        $count=App\Models\Review::where('term_id',$RelatedProduct->id)->count(); 
   if($count == 0)
        {
        $count = 1;
        }


       $rating=0;
        foreach(App\Models\Review::where('term_id',$RelatedProduct->id)->get() as $R)
        {
            $rating=$R->rating +$rating;
        }

       

           $finalrate=$rating/$count;

                                @endphp
                            

                                @if($finalrate >= 1 and $finalrate  < 2)
                                			<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>

                                @endif

                                 @if($finalrate >= 2 and $finalrate < 3)
                              			    <li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>

                             

                                @endif

                                 @if($finalrate >= 3  and  $finalrate< 4)
                              				<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
                                @endif

                                 @if($finalrate >= 4 and $finalrate <= 5)
                               				 <li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
											<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
                                @endif
										</ul>
										<h4 class="item-price">

								

 @if($RelatedProduct->price->special_price !== null )
 <del>{{$RelatedProduct->price->price}}  {{ $currency->currency_icon ?? '' }} </del> <span class="text-primary"> {{$RelatedProduct->price->regular_price}} {{ $currency->currency_icon ?? '' }}</span>

               
                 

                   @else
 {{$RelatedProduct->price->price}} {{ $currency->currency_icon ?? '' }}
                  @endif

										</h4>
									</div>
								</div>
							</div>
                   @endforeach
							 
						</div>
					</div>
				</div>
			</div>
            <!-- Product details -->
        </div>
  
     <!-- Footer -->


@endsection

@push('js')


<script src="{{url('/')}}/frontend/beauty/js/jquery.star-rating-svg.js"></script>
<script>
$(document).ready(function() {

  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
  var slidesPerPage = 4; //globaly define number of elements per page
  var syncedSecondary = true;

	  sync1.owlCarousel({
		items : 1,
		slideSpeed : 2000,
		nav: true,
		autoplay: false,
		dots: false,
		loop: true,
		responsiveRefreshRate : 200,
		navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
	  }).on('changed.owl.carousel', syncPosition);

	  sync2.on('initialized.owl.carousel', function () {
		  sync2.find(".owl-item").eq(0).addClass("current");
		}).owlCarousel({
		items : slidesPerPage,
		dots: false,
		nav: false,
		margin:5,
		smartSpeed: 200,
		slideSpeed : 500,
		slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
		responsiveRefreshRate : 100
	  }).on('changed.owl.carousel', syncPosition2);

  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;
    
    //if you disable loop you have to comment this block
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    
    if(current < 0) {
      current = count;
    }
    if(current > count) {
      current = 0;
    }
    
    //end block

    sync2
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = sync2.find('.owl-item.active').length - 1;
    var start = sync2.find('.owl-item.active').first().index();
    var end = sync2.find('.owl-item.active').last().index();
    
    if (current > end) {
      sync2.data('owl.carousel').to(current, 100, true);
    }
    if (current < start) {
      sync2.data('owl.carousel').to(current - onscreen, 100, true);
    }
  }
  
  function syncPosition2(el) {
    if(syncedSecondary) {
      var number = el.item.index;
      sync1.data('owl.carousel').to(number, 100, true);
    }
  }
  
  sync2.on("click", ".owl-item", function(e){
		e.preventDefault();
		var number = $(this).index();
		//sync1.data('owl.carousel').to(number, 300, true);
		
		sync1.data('owl.carousel').to(number, 300, true);
		
	});
});

$(".my-rating").starRating({
  initialRating: 4,
  strokeColor: '#894A00',
  strokeWidth: 10,
  starSize: 25
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
              $.notify(data.success, "success");
              $.notify('__('added to cart')', "success");
      

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
 
@endpush



 
@push('js')


<script type="text/javascript">
      $(document).on('click','#add_to_cartRelatedProduct',function(){
              var text =$(this).text();
              text=text.toString();
                    var id= text;
                    

                      var xxxx= id;
var id = xxxx.substring(0, xxxx.length - 4);  

                     

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
                  
                   

                
     $.notify("Added to cart", "success");
     $.notify("Added to cart", "info");
     $.notify("Added to cart", "warn");
      
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
             
              
   $.notify('{{__("Added to favourites")}}', "success");
   $.notify('{{__("Added to favourites")}}', "info");
   $.notify('{{__("Added to favourites")}}', "success");
   $.notify('{{__("Added to favourites")}}', "warn");
     
 
    

            }
        });
             return false;
    
                    
                     
                    });
  </script>

    
@endpush
