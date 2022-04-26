@extends('frontend.bigbag.index')
@section('content')
    <section class="wrap-header-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="cart-header border-right active">
                        <h1><span>01</span><br>{{ __('Shopping Cart') }}</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-header border-right">
                        <h1><span>02</span><br>{{__('BILLING & SHIPPING')}}</h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cart-header">
                        <h1><span>03</span><br>{{__('Payment Options')}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <!--Shopping Cart Area Strat-->
        <div class="Shopping-cart-area pt-4 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                          <span class="cart_sucess"></span>

                @if (session()->has('success_message'))

                    <div class="alert alert-success cc">

                        {{ session()->get('success_message') }}

                    </div>

                @endif
                    
                            <div class="table-content table-responsive">
                                      @if (Cart::count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>

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
                                        
                                        <tr>

                                            <td class="li-product-thumbnail"><a href="#">
                                <img
                    src=" {{ $item->options->preview  }}"
                                                        alt="Li's Product Image"></a></td>
                                            <td class="li-product-name"><a href="#">

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
                                        

                                    
                                        </a></td>
                                            <td class="li-product-price"><span class="amount">
                                                 {{ $item->price  }}<br>
                                                 
                                            </span></td>
                                            <td class="quantity">
                        <label>{{__('Quantity')}}</label>
           <select id="quantity" class="quantity"   >
                                @for ($i = 1; $i < 5 + 1 ; $i++)
        <option value="{{$item->rowId}}"  @if($item->qty == $i)  selected="" @endif>
        {{ $i }}
      </option>
                                @endfor
                            </select>
                                            </td>
                                            <td class="product-subtotal"><span class="amount">
             {{__('subtotal')}} :    <span class="subtotal"> {{ $item->subtotal }}</span>  
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
                                            </span></td>
                    <td class="li-product-remove hide_on_click clickable">

                                                <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST" id="dellshop">
                           
                       <span>
                           
                                                     {{ csrf_field() }}
                         
                <input type="hidden" name="rowId" value="{{ $item->rowId }}">
<a class="cart-options" id="Removeshop"><span class="hidden">{{ $item->rowId }}</span>x</a>
                

                            </form>

            <form action="#" method="POST">
                                {{ csrf_field() }}

                               
        <a class="cart-options" id="saveForLater"><span class="hidden">{{ $item->rowId }}</span><i class="ti-heart"></i></a>

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
                            <div class="row">
                                <div class="col-12">

                                    <div class="coupon-all">
                          <span class="cart_sucess"></span>
                                      
                            <form action="#" method="post">
                                        <div class="coupon">
            <input id="coupon_code" class="input-text" name="code" value=""
                                                placeholder="{{__('Coupon code')}}" type="text"  >

 <input class="button" name="apply_coupon" value="{{__('Apply coupon')}}"
                                                id="apply_coupon"  readonly>


                                        </div>

                                            </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2> {{__('Cart totals')}}</h2>

          

                                        <ul>
             <li> {{__('Price Total')}} <span class="cart_total_top" @if(Session::get('locale') == 'ar')  style="float: left;"  @endif>
                {{  Cart::priceTotal() }} {{ $currency->currency_icon ?? '' }}
             </span></li>

               <li> {{__('Discount')}} <span   @if(Session::get('locale') == 'ar')  style="float: left;"  @endif>- {{ Cart::discount() }} {{ $currency->currency_icon ?? '' }}
             </span></li>

              <li> {{__('Subtotal')}} <span class="cart_total_top"  @if(Session::get('locale') == 'ar')  style="float: left;"  @endif>
               {{ Cart::subtotal() }} {{ $currency->currency_icon ?? '' }}
             </span></li>
            @php
             $totltax=0;
                foreach (Cart::content() as $item)
                {
                    $product_id=$item->id;
        $term = App\Term::where('user_id',domain_info('user_id'))->findorFail($product_id);
          
       
        $totltax= $totltax + $term->tax_value ;

                }

                   @endphp

             <li> {{__('Tax')}} <span   @if(Session::get('locale') == 'ar')  style="float: left;"  @endif>
                {{  $totltax }} {{ $currency->currency_icon ?? '' }}
             </span></li>

             
<li> {{__('Total')}}<span class="cart_total_top">
    {{ Cart::total()  }} {{ $currency->currency_icon ?? '' }}
</span></li>


                                        </ul>
   



                                        <a href="/checkout">  {{__('Proceed to checkout')}}</a>
                                    </div>
                                </div>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
    </section>

     
   

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
                      $('.cart_sucess').html('');
                      $('.cc').addClass('hidden');
                  $('.loading-save-c').removeClass('hidden');

                  ///////////////////////////////

                  //////////////////////////////////
                      
            },
            success:function(data)
            {
                   $('.loading-save-c').addClass('hidden');
   
 

//$.notify('{{__("Coupon Applied!")}}', "success");
             
             $('.cart_sucess').html(data.success); 

       var base_url=$('#base_url').val();
   $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.cart_qty_cls').html(data.count);
             window.location.href="{{url('/')}}/cart";
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

     document.getElementById(newStr).style.display = "none"; 
                     


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
      

                
 

              var text =$(this).text();

              text=text.toString();
      
         
                     

     document.getElementById(text).style.display = "none"; 
                     

            
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
      //window.location.href = '{{ url("cart") }}'

            }
        });



});
        </script>

    

    
  
    
 

    @endpush

@endsection
