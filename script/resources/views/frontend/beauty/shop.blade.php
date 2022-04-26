@extends('frontend.beauty.layouts.app')

@section('content')
   <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary bg-pt" style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white"> {{__('beauty.ourShop')}}  </h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="{{url('/')}}">{{__('Home')}} </a></li>
							<li>{{__('beauty.ourShop')}} </li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- contact area -->
        <div class="section-full content-inner">
            <!-- Product -->
            <div class="container">
                <div class="row">
							@foreach($services as $service)
                         
					<div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
						<div class="item-box m-b10">
							<div class="item-img">
								<img src="{{  $service->preview ? $service->preview->media->url : '' }}" alt=""/>
								<div class="item-info-in">
									<ul>
										<li><a id="add_to_cart2" href="#"><i class="ti-shopping-cart"></i>
  <span style="display:none;">{{ $service->id }}</span>
										</a></li>
										<li><a href="{{url('/')}}/product/{{$service->slug}}/{{$service->id}}"><i class="ti-eye"></i></a></li>
										
					<li><a  id="add_to_Wishlist" href="#"><i class="ti-heart"></i><span style="display:none;">{{ $service->id }}</span></a></li>
									</ul>
								</div>
							</div>
							<div class="price-tbl d-flex">
							<div class="flex-grow-1">
								<h4 class="text-primary">{{$service->title}}</h4>
								<p>{{$service->time_required}} {{__('beauty.MinuteSession')}} </p>
							</div>
							<div class="price-val align-self-center">
								<h3 class="text-secondry">{{$service->price ? $service->price->price : ''}}</h3>
								<span class="input-group-btn">
											<button id="add_to_cart" name="submit" value="Submit" type="submit" class="site-button radius-xl"><i class="ti-shopping-cart"></i> <span  style="display: none;">{{ $service->id }}</span>{{__('beauty.add')}}</button>
										</span>
							</div>
						</div>
						</div>
					</div>
							@endforeach

					 
				</div>
				 
				 
            <!-- Product END -->
		</div>
@endsection

 

  
@push('js')


<script type="text/javascript">
      $(document).on('click','#add_to_cart',function(){
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
      $(document).on('click','#add_to_cart2',function(){
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

