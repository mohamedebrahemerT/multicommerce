@extends('frontend.beauty.layouts.app')

@section('content')
   <!-- Content -->
   <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary bg-pt" style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('Cart')}}</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="#">{{__('Home')}}</a></li>
							<li>{{__('Shopping Cart')}}</li>
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
					<div class="col-lg-12 m-b30">
						<div class="table-responsive">

							 <span class="cart_sucess"></span>

                @if (session()->has('success_message'))

                    <div class="alert alert-success cc">

                        {{ session()->get('success_message') }}

                    </div>

                @endif
                                      @if (Cart::count() > 0)

							<table class="table check-tbl">
								<thead class="text-left">
									 <tr style="text-align:center">

                                            <th class="li-product-thumbnail">{{__('images')}}</th>
                                            <th class="cart-product-name">{{__('Product')}}</th>
                                            <th class="li-product-price">{{__('Unit Price')}}</th>
                                            <th class="li-product-quantity">{{__('Quantity')}}</th>
                                            <th class="li-product-subtotal">{{__('Total')}}</th>
    <th class="li-product-remove">  {{__('Opration')}}
        <i id="spinner" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i>
    </th>

                                        </tr>
								</thead>
								<tbody>
                @foreach (Cart::content() as $item)

									<tr class="alert" style="text-align: center;">
										<td class="product-item-img"><img src="{{ $item->options->preview  }}" alt=""></td>
										<td class="product-item-name"> {{ $item->name  }}</td>
										<td class="product-item-price"> {{ $item->price  }} {{ $currency->currency_icon ?? '' }}</td>
										<td  >
											  
           <select id="quantity" class="quantity"   >
                                @for ($i = 1; $i < 5 + 1 ; $i++)
        <option value="{{$item->rowId}}" {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
										</td>
										<td class="product-item-totle">{{ $item->subtotal }} {{ $currency->currency_icon ?? '' }}

<span style="font-size:15px">
    <br>
                   {{__('discount')}}:     {{ $item->discount  }}<br>

                   @php
                    $product_id=$item->id;
        $term = App\Term::where('user_id',domain_info('user_id'))->findorFail($product_id);
            


                   @endphp
                  {{__('tax')}}       : 
                     @if($term->tax_value == null)
                      0
                      @else
                        {{ $term->tax_value  }}
                        @endif

                        <br>
</span>

                                        </td>
										<td class="li-product-remove hide_on_click clickable">

                                                <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST" id="dellshop">
                           
                       <span>
                           
                                                     {{ csrf_field() }}
                         
                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
<a class="cart-options" id="Removeshop" style="cursor: pointer;
font-size: 24px;
font-weight: 700;"><span  style="display: none; ">{{ $item->rowId }}</span>x</a>
                

                            </form>


                             <form action="#" method="POST">
                                {{ csrf_field() }}

                               
        <a  style="cursor: pointer;" class="cart-options" id="saveForLater"><span style="display: none; ">{{ $item->rowId }}</span><i class="ti-heart"></i></a>

                            </form>

           

                                            </td>
									</tr>
                @endforeach
									 
								</tbody>
							</table>

							 @else
                                        <h3> {{__('No items in Cart!')}}</h3>
            @endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<form class="shop-form"> 
							<span class="apply_coupon"></span>
							<h5>{{__('Add a copoun')}}</h5>
							
							
							<div class="form-group">
								<input id="coupon_code" type="text" class="form-control" placeholder="{{__('Coupon code')}}">
							</div>
							<div class="form-group">
							<button class="site-button" id="apply_coupon" type="button">{{__('Apply coupon')}}</button>
						</div>
						</form>	
					</div>
					<div class="col-lg-6 col-md-6">
						<h5>{{__('Cart totals')}}</h5>
						<table class="table-bordered check-tbl">
							<tbody>
								<tr>
									<td>{{__('Price Total')}}</td>
						<td class="cart_total_top">{{  Cart::priceTotal() }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>
								<tr>
									<td>{{__('Discount')}}</td>
						<td>{{ Cart::discount() }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>
								<tr>
									<td>{{__('Subtotal')}}</td>
						<td class="cart_total_top" >{{ Cart::subtotal() }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>
								<tr>

                                     @php
             $totltax=0;
                foreach (Cart::content() as $item)
                {
                    $product_id=$item->id;
        $term = App\Term::where('user_id',domain_info('user_id'))->findorFail($product_id);
          
       
        $totltax= $totltax + $term->tax_value ;

                }

                   @endphp
									<td>{{__('Tax')}} </td>
						<td> {{ $totltax }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>

								<tr>
									<td>{{__('Total')}} </td>
						<td class="cart_total_top">  {{ Cart::total()  }} {{ $currency->currency_icon ?? '' }}</td>
								</tr>
							</tbody>
						</table>
						<div class="form-group">
							<button class="site-button" type="button"><a style="color:#fff;" href="{{url('/')}}/booking" >{{__('Proceed to make appointment')}}</a></button>
						</div>
					</div>
				</div>
		   </div>
            <!-- Product END -->
		</div>
	</div>
@endsection

 

    @push('js')
         


<script type="text/javascript">
  
         @if (!session()->has('ceapon'))

           $('#AC').removeClass('hidden');
          
         @endif
</script>

  <script type="text/javascript">
      $(document).on('click','#apply_coupon',function(){

    
    var code =$('#coupon_code').val();

    
        $.ajax({
            url:"{{url('/apply_coupon')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            code:code,

           },
            dataType:"json",
            beforeSend:function(){
                      $('.apply_coupon').html('');
                      $('.cc').addClass('hidden');
                  $('.loading-save-c').removeClass('hidden');

                  ///////////////////////////////

                  //////////////////////////////////
                      
            },
            success:function(data)
            {
                   $('.loading-save-c').addClass('hidden');
   
 


 

$.notify('{{__("Coupon Applied!")}}', "success");

 

             
             $('.apply_coupon').html(data.success); 

       var base_url=$('#base_url').val();
   $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.cart_qty_cls').html(data.count);

//window.location.reload();


            }
        });
             return false;
    
                    
                     
                    });
  </script>


  <script type="text/javascript">
      $(document).on('click','#Removeshop',function(){

        
          $(this).closest("tr").hide();
     

              var tr = $(this).closest('div.cart-table-row');
                          tr.fadeOut(1000, function(){ // **addd this
                            $(this).remove();
                        });

              var text =$(this).text();

              text=text.toString();

            
                 
                    var xxxx= text;
var newStr = xxxx.substring(0, xxxx.length - 1);   

     
                     


        $.ajax({
            url:"{{url('/cartdestroy')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:text,

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
   
$.notify('{{__("Item has been removed!")}}', "error");
 
             
             $('.cart_sucess').html(data.success); 

       var base_url=$('#base_url').val();
   $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.cart_qty_cls').html(data.count);

  


            }
        });
             return false;
    
                    
                     
                    });
  </script>

  <script type="text/javascript">
      $(document).on('click','#saveForLater',function(){
          $(this).closest("tr").hide();

                 $(this).closest("div.cart-table-row").hide();

              var tr = $(this).closest('div.cart-table-row');
                          tr.fadeOut(1000, function(){ // **addd this
                            $(this).remove();
                        });

              var text =$(this).text();

              text=text.toString();
      
           
            
        $.ajax({
            url:"{{ url('switchToSaveForLater') }}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:text,

           },
            dataType:"json",
            beforeSend:function(){
                      $('.cart_sucess').html('');
                         $('.cc').addClass('hidden');
                            $('.loading-save-c').removeClass('hidden');


            },
            success:function(data)
            {
                   $('.loading-save-c').addClass('hidden');

              $('.loading-save-c').addClass('hidden');

              $.notify('{{__("Item has been Saved For Later!")}}', "success");
                 
             $('.cart_sucess').html(data.success);  
                var base_url=$('#base_url').val();
   $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.cart_qty_cls').html(data.count);
   $('.wishlist_qty_cls').html(data.countwishlist);

  

            }
        });
             return false;
    
                    
                     
                    });
  </script>
    
  <script type="text/javascript">
      $(document).on('click','#Removesavforlater',function(){

                 $(this).closest("div.cart-table-row").hide();

              var tr = $(this).closest('div.cart-table-row');
                          tr.fadeOut(1000, function(){ // **addd this
                            $(this).remove();
                        });

              var text =$(this).text();

              text=text.toString();
            
        $.ajax({
            url:"{{ url('/SaveForLaterdestroy') }}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:text,

           },
            dataType:"json",
            beforeSend:function(){
                      $('.cart_sucess').html('');
                         $('.cc').addClass('hidden');
            },
            success:function(data)
            {
             
             $('.cart_sucess').html(data.success);  

            }
        });
             return false;
    
                    
                     
                    });
  </script>


    <script type="text/javascript">
      $(document).on('click','#switchToCart',function(){

                 $(this).closest("div.cart-table-row").hide();

              var tr = $(this).closest('div.cart-table-row');
                          tr.fadeOut(1000, function(){ // **addd this
                            $(this).remove();
                        });

              var text =$(this).text();

              text=text.toString();
            
        $.ajax({
            url:"{{ url('switchToCart') }}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:text,

           },
            dataType:"html",
            beforeSend:function(){
                      $('.cart_sucess').html('');
            },
            success:function(data)
            {
             
             $('.cart_sucess').html(data.success);  

            }
        });
             return false;
    
                    
                     
                    });
  </script>
   <script type="text/javascript">
      $(document).on('click','#Apply',function(){

                  
                  var coupon=$('#coupon_code').val();

               
       
        $.ajax({
            url:"{{url('/couponnstore')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            coupon_code:coupon,

           },
            dataType:"json",
            beforeSend:function(){
                      $('#coupon_sucess').html('');
                   $('.RemoveCO').html('');

            },
            success:function(data)
            {
             
            $('#coupon_sucess').html(data.success);
             $('#DC10').html(data.DC10);
           $('#cheeckHaveCoupon').addClass('hidden');
           $('#coupon_code').val('');

             
        
            }
        });
             return false;
    
                    
                     
                    });
  </script>

    <script type="text/javascript">
      $(document).on('click','#Remove_coupon',function(){
       
        $.ajax({
            url:"{{ url('/coupondestroy') }}",
            method:"delete",
           data :{
            _token:'{{ csrf_token() }}',
            
           },
            dataType:"html",
            beforeSend:function(){
                   $('.RemoveCO').html('');
                      $('#coupon_sucess').html('');

            },
            success:function(data)
            {
                
                X="'<div class='alert alert-danger'>coupon has been removed!</div>'";
           $('.RemoveCO').html(data);
           $('#EFC').addClass('hidden');
           $('#FVV').addClass('hidden');

           $('#AC').removeClass('hidden');
           $('#cheeckHaveCoupon').removeClass('hidden');


           

           
           
         


            }
        });
             return false;
    
                    
                     
                    });
  </script>

  
  
 
    
<script type="text/javascript">
            $('.quantity').on('change',function() {

                 var zzzzzz = $(this).val();
                 var xxxx = zzzzzz;
               
                 
    var quantity = $('option:selected', this).text(); //to get selected text
 
     $.ajax({
            url:"{{ url('cart_update/update')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:xxxx,
            quantity:quantity

           },
            dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner").style.display = "block"; 
      $('.cart_sucess').html(''); 
                 
                      
            },
            success:function(data)
            {
         document.getElementById("spinner").style.display = "none";
 
      $('.cart_sucess').html(data.success); 

       var base_url=$('#base_url').val();
   $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.cart_qty_cls').html(data.count);
  window.location.href = '{{ url("cart") }}'

            }
        });



});
        </script>

    

    
  
    
 

    @endpush
