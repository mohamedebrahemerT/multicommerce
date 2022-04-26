@extends('frontend.bigbag.index')
@section('content')
     
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
                        <form action="#">
                            <div class="table-content table-responsive favorites-tabel">
                                      @if (Cart::instance('saveForLater')->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th class="li-product-thumbnail">{{__('images')}}</th>
                                            <th class="cart-product-name">{{__('Product')}}</th>
                                            <th class="li-product-price">{{__('Unit Price')}}</th>
                                            <th class="li-product-quantity">{{__('Stock Status')}}</th>
                                            <th class="li-product-subtotal">{{__('Add To Cart')}}</th>
                                            <th class="li-product-remove">  {{__('remove')}}<i class="fa fa-spin fa-spinner loading-save-c " style="display: none;"></i></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                @foreach (Cart::instance('saveForLater')->content() as $item)
                                        
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

                         @isset($info->options->options)
<br>
                            @foreach ($info->options as $key=> $row)
        {{$row->name}}:
                                       @endforeach

                                           
                       

                       @endisset

                         @isset($item->options->options )

                                        @foreach ($item->options->options as $op)

                                         {{ $op->name }}                                     
                                       @endforeach
                                      
                                       @foreach ($item->options->attribute as $attribute)
                                            <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                        @endforeach
                       @endisset
                                        
                                        </a></td>
                                            <td class="li-product-price"><span class="amount">
                                                 {{ $item->price  }}
                                            </span></td>
                                             @php

             $stock_status=App\Stock::where('term_id',$item->id )->first()->stock_status;
                                             @endphp

                                            <td class="status">

                                          @if($stock_status == 1)
                                            <label for="" class="green">
                                    {{__('In Stock')}}
                                 
                                
                                            
                                        </label>
                                        @else
                        <label for="" class="red">{{__('Out Stock')}}</label>
                       
                                            @endif
                                        </td>
                                            <td   >
                                                  @if($stock_status == 1)
                                                <form action="#" method="POST">
                                            <span>
                                            {{ csrf_field() }}
                                            <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                            <a class="cart-options" id="switchToCart"><span class="hidden">{{ $item->rowId }}
                                            </span><i class="ti-shopping-cart" style="font-size: 25px;"></i></a>
                                        </form>
                                        @endif
                                        
                                            </td class="li-product-remove">
                    <td class="li-product-remove hide_on_click clickable">

                                              <form action="#" method="POST">
                                            <span>
                                            {{ csrf_field() }}
                                             <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                             <a class="cart-options" id="Removesavforlater">
                                                <span class="hidden">
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
                            
                             
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
    </section>

     
   

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

@endsection
