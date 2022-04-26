@extends('frontend.beauty.layouts.app')

@section('content')

 <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary bg-pt" style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('Wishlist')}} </h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							                         <li><a href="{{url('/')}}">{{__('Home')}} </a></li>

							<li>{{__('Wishlist')}}</li>
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
					<div class="col-md-12">
						<div class="table-responsive">
							  <span class="cart_sucess"></span>

                @if (session()->has('success_message'))

                    <div class="alert alert-success cc">

                        {{ session()->get('success_message') }}

                    </div>

                @endif

                                      @if (Cart::instance('saveForLater')->count() > 0)

							<table class="table check-tbl">
								<thead class="text-left">
									<tr style="text-align:center;">
										 <th  >{{__('images')}}</th>
                                            <th  >{{__('Product')}}</th>
                                            <th class="li-product-price">{{__('Unit Price')}}</th>
                                            <th  >{{__('Stock Status')}}</th>
                                            <th  >{{__('Add To Cart')}}</th>
                                            <th  >  {{__('remove')}}<i class="fa fa-spin fa-spinner loading-save-c " style="display: none;"></i></th>

										 
									</tr>
								</thead>
								<tbody>
                @foreach (Cart::instance('saveForLater')->content() as $item)

                                
									<tr class="alert" style="text-align:center;">
										<td class="product-item-img"><img src="{{ $item->options->preview  }}" alt=""></td>
										<td class="product-item-name">
										 

                                        {{ $item->name  }}

                                         @php

                    $user_id = domain_info('user_id');

                     $info = App\Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->with('medias', 'content', 'categories', 'brands', 'seo', 'price', 'options', 'stock')->findorFail($item->id);

   $optionss = json_decode($info->options, true);


                    @endphp
<br>
                            @foreach ($info->options as $key=> $row)
        {{$row->name}}:
                                       @endforeach

                                        @isset($item->options->options)
                                        @foreach ($item->options->options as $op)

                                         {{ $op->name }}                                     
                                       @endforeach

                                       @endisset
                                      
                                       @isset($item->options->attribute)
                                       @foreach ($item->options->attribute as $attribute)
                                            <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                        @endforeach
                                       @endisset

                                        
										</td>
										<td class="product-item-price">{{ $item->price  }} {{ $currency->currency_icon ?? '' }}</td>
										<td class="product-item-quantity">
											 @php

             $stock_status=App\Stock::where('term_id',$item->id )->first()->stock_status;
                                             @endphp
											  @if($stock_status == 1)
                                            <label for="" class="green">
                                    {{__('In Stock')}}
                                 
                                
                                            
                                        </label>
                                        @else
                        <label for="" class="red">{{__('Out Stock')}}</label>
                       
                                            @endif
										</td>
										<td class="product-item-totle">
											  @if($stock_status == 1)
                                                <form action="#" method="POST">
                                            <span>
                                            {{ csrf_field() }}
                                            <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                            <a style="cursor: pointer;" class="cart-options" id="switchToCart"><span  style="display:none">{{ $item->rowId }}
                                            </span><i class="ti-shopping-cart" style="font-size: 25px;"></i></a>
                                        </form>
                                        @endif
										</td>


										<td  >
											  <form action="#" method="POST">
                                            <span>
                                            {{ csrf_field() }}
                                             <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                             <a style="cursor:pointer;" class="cart-options" id="Removesavforlater">
                                                <span  style="display:none">
                                                    {{ $item->rowId }}</span>
                                                <i class="fa fa-times"></i></a>
                                        </form>
										</td>
									</tr>
                @endforeach

									 
								</tbody>
							</table>
							 @else
                                        <h3> {{__('No items in Cwishlist!')}}</h3>
            @endif
						</div>
					</div>
				</div>
			 </div>
            <!-- Product END -->
		</div>
   
@endsection

 @push('js')
         
    <script type="text/javascript">

            $(document).on('click', '#Removesavforlater', function () {

          $(this).closest("tr").hide();

                $(this).closest("div.cart-table-row").hide();


                var tr = $(this).closest('div.cart-table-row');

                tr.fadeOut(1000, function () { // **addd this

                    $(this).remove();

                });


                var text = $(this).text();


                text = text.toString();


                $.ajax({

                    url: "{{ url('/SaveForLaterdestroy') }}",

                    method: "POST",

                    data: {

                        _token: '{{ csrf_token() }}',

                        id: text,


                    },

                    dataType: "json",

                    beforeSend: function () {

                        $('.cart_sucess').html('');
$.notify('{{__("Item has been removed from saved!")}}', "error");
                      $('.cart_sucess').html('');
                         $('.cc').addClass('hidden');
                            $('.loading-save-c').removeClass('hidden');



                    },

                    success: function (data) {

                         $('.loading-save-c').addClass('hidden');
       
             
             $('.cart_sucess').html(data.success); 
   $('.wishlist_qty_cls').html(data.countwishlist);
   

          

            
     

                    }

                });

                return false;


            });

        </script>





        <script type="text/javascript">

            $(document).on('click', '#switchToCart', function () {

          $(this).closest("tr").hide();

                $(this).closest("div.cart-table-row").hide();


                var tr = $(this).closest('div.cart-table-row');

                tr.fadeOut(1000, function () { // **addd this

                    $(this).remove();

                });


                var text = $(this).text();


                text = text.toString();


                $.ajax({

                    url: "{{ url('switchToCart') }}",

                    method: "POST",

                    data: {

                        _token: '{{ csrf_token() }}',

                        id: text,


                    },

                    dataType: "json",

                    beforeSend: function () {

                       $('.cart_sucess').html('');
                         $('.cc').addClass('hidden');
                            $('.loading-save-c').removeClass('hidden');


                    },

                    success: function (data) {


                        $('.loading-save-c').addClass('hidden');

              $('.loading-save-c').addClass('hidden');
         
             $('.cart_sucess').html(data.success);  
              $.notify('{{__("Item moved to cart!")}}', "success");
                
    $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.cart_qty_cls').html(data.count);
   $('.wishlist_qty_cls').html(data.countwishlist);
              $('.cartHhide').addClass('hidden');
   $('.append_new_cart').html(data.cart_content);
 
              

    
                    }

                });

                return false;


            });

        </script>
 

    @endpush
