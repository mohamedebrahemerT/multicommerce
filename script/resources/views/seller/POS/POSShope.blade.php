@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>trans('POS')])
@endsection
@section('content')

 

@if ($errors->any())
    <div class="alert alert-danger" style="text-align: center;">
        @foreach ($errors->all() as  $value)
            <p>{{ $value }}</p>
        @endforeach
    </div>
@endif


 


  <div class="row">
        <div class="col-md-6">
            
                <div class="card card-light">
                    <div class="card-header">
                  
                       
                            <div class="col-lg-4  ">
                                <label class="col-sm-12 col-form-label">
                                   
                                {{ __('Category Filter') }}	
                                </label>
                                <div class="form-group row">

                                    <div class="col-sm-12">
@php
  $posts= App\Category::where('user_id',getUserId())->where('type','category')->with('preview')->latest()->get();
@endphp
                          

         <select id="category-filter" name="category_id" class="form-control category_id">

                        <option value="0">--</option>
                             @foreach($posts as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                                           @endforeach
                                               
                                    </select>
                                    </div>
                                </div>


                            </div>
                             <i id="spinner5" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i> 
              
                          

                              @php       
$locations=App\Category::where('user_id',getUserId())->where('type','city')->latest()->get();
@endphp

                            <div class="col-lg-4">
             <label class="col-sm-12 col-form-label"> {{ __('Location Filter') }}   </label>
                                <div class="form-group row">
                                    <div class="col-sm-12">

                                        <select id="location-filter" name="location_id" class="form-control location_id">
                                            <option value="0">--</option>
                             @foreach($locations as $location)
                <option value="{{$location->id}}">{{$location->name}}</option>
                                           @endforeach
                                               
                                            </select>
                                    </div>
                                </div>
                            </div>

                             <div class="col-lg-4 ">
                                <div class="input-group">
                                    <input type="text" id="posSearch" name="search_key" class="form-control" placeholder="{{ __('Search') }}">
                                </div>
                            </div>
                       
                    </div>



  

                    <!-- /.card-header -->
                    <div class="card-body" id="pos-services"  >

                    	

@php
  $posts= App\Category::where('user_id',getUserId())->where('type','category')->with('preview')->latest()->paginate(20);
@endphp
 <div id="hidemainsec"> 
                            @foreach($posts as $row)

                                                    <div class="row" >
                              
@php

$user_id = domain_info('user_id');
 
         $attributes=App\Postcategory::where('category_id',$row->id)->get();

         

    $cats_ids=[];
   foreach ($attributes as $key => $Postcat) 
   {
    
         array_push($cats_ids,$Postcat->term_id);
   }
          

            $products = App\Term::where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
                 -> whereIn('id',$cats_ids)
           ->withCount('reviews')->paginate(6);
@endphp

                              @if($products->count() > 0)
                              <div class="col-md-12 mt-2">
                        
                                        <h5>{{$row->name}}</h5>

                                    </div>
                                    @endif


 

@foreach($products as $product)
 

@php
                   $Attributecount=App\Attribute::where('term_id',$product->id)->groupBy('category_id')->count();

                     $countoptions=$product->options->count()
                     @endphp

                                            <div class="col-md-6 col-lg-3">
                                        <div class="card" style="height: 222px;">
                                            <img class="card-img-top" src="{{ asset($product->preview->media->url ?? 'uploads/default.png') }}" height="100em">
                                            <div class="card-body p-2">
                                                
             {{ \Illuminate\Support\Str::limit($product->title, 11, $end='...') }}
                                                 
                                     


<!-- Modal -->
<div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:25%;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('Please choose sizes and extras')}}

        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <form method="get" action="/add_to_cart/{{ $product->id }}">

        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="hidden" name="qty" value="1">
          

    <span class="successdata"></span>


             
@php
   $optionss = json_decode($product->options, true);

    

@endphp

                                            @foreach ($product->options as $key=> $row)
        {{$row->name}}:<br>
                                                                       

                         
  @foreach(App\Models\Termoption::where('p_id','!=',null)->where('term_id',$product->id)->get() as $option )
          

          



    

  <input type="radio" id="op{{$option->id}}" name="option[]" value="{{$option->id}}" required>
  <label for="op{{$option->id}}">{{$option->name}}</label>
   
      

  
                                
               
                           

      
 @endforeach
      @endforeach

                        


                        @foreach(App\Attribute::where('term_id',$product->id)->groupBy('category_id')->get() as $key => $category )

                <h6 class="product-title">{{$category->Category->name}}</h6>


                            <div class="size-box   ">
                               
     @foreach(App\Attribute::where('category_id',$category->category_id)->where('term_id',$product->id)->get() as $variation )   


    

 <input type="radio" id="variation{{$variation->variation->id}}" name="variation[]" value="{{$variation->variation->id}}" required>
  <label for="variation{{$variation->variation->id}}">{{$variation->variation->name}}</label>

 @endforeach
                                    
                              
                            </div>
 @endforeach


  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
        <button type="submit" class="btn btn-primary">{{__('Save changes')}}</button>
      </div>

      </form>
    </div>
  </div>
</div>
                  
                 


                    

                                {{$product->price->price}} {{__('SAR')}}
                                            </div>
                                            <div class="card-footer p-1">
 @if($product->stock->stock_status == 1 and  $product->stock->stock_qty !== 0 )
              

     @if($Attributecount  > 0 or $countoptions >0 )
                               <!-- Button trigger modal -->
                                               
                              
<a class="btn btn-block btn-dark add-to-cart"  data-toggle="modal" data-target="#exampleModal{{$product->id}}"  style="color: #fff; cursor:pointer;">

      </span><i class="fa fa-plus"></i> Add <br>
</a>
                                               
         @else
                          
     <a  id="Removeshop" href="javascript:;"class="btn btn-block btn-dark add-to-cart"><span  style="display:none;">{{ $product->id }}</span><i class="fa fa-plus"></i>Add</a>


                 @endif  

                 @else

                 
                    {{ __('out of stock') }}

                             @endif                         
                                               




                                            </div>
                                        </div>
                                    </div>

                                 
                                                                  
                                           @endforeach
                                                                   
                                                            </div>



                                           @endforeach
                                           </div>

          <span class="filter-services"></span>

                                                    <div class="row">
                                                                                            </div>
                                            </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            
        </div>
        <div class="col-md-6">
            
                   <form method="post" action="{{url('/')}}/seller/xxxxxx">

                                <div class="card card-dark">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">

                            <input type="hidden" class="form-control" name="posTime" id="posTime" value="04:49 am">

                          

                             
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">
                           {{ __(' Search a customer by name, email or mobile') }}
                                   
                                </label>

                                    @php
       $lims_customer_list=App\User::where('created_by',getUserId())->withCount('orders')->where('role_id',2)->get();
                                    @endphp

             

             <select    name="customer_id[]" data-placeholder=" {{ __(' Search a customer by name, email or mobile') }}" multiple class="chosen-select form-control">
                                                @foreach($lims_customer_list as $customer)
                                                    @php $deposit[$customer->id] = $customer->deposit - $customer->expense; @endphp
                                                    <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->email . ')'}}

                                                  {{$customer->phone }}
                                                    </option>
                                                @endforeach
                                                </select>
                                                 <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mt-2">&nbsp;</div>
                                <button class="btn btn-success btn-rounded" id="select-customer" type="button"
data-toggle="modal" data-target="#exampleModal"
                                >
                                    <i class="fa fa-plus"></i>  </button>



                            </div>

                            
 

                        </div>

                        <div class="row">
                            <table class="table myTable " id="myTable"  style="color: inherit;
font-size: 16px;
font-weight: 700;
font-style: oblique;
font-weight: bold;">
                                <thead>
                                    <tr>
                                        <th  >{{ __('service') }}</th>
                                        <th  >{{ __('Price') }}</th>
                                    <th class="product-quantity">{{ __('Quantity') }}</th>
                                        
                                        <th  >{{ __('SubTotal') }}</th>
                                        <th><i class="fa fa-gear"></i></th>
                                    </tr>
                                </thead>
                     <tbody   class="success"></tbody>

                                <tbody  id="tbody" >
                @foreach (Cart::content() as $item)
 

       <tr class="{{ $item->id  }}" id="{{ $item->id  }}">

        <td>
        <input type='hidden' name='cart_services[]'  value="{{ $item->id  }}">
        {{ $item->name  }}
  <br>
        @php

                    $user_id = domain_info('user_id');

                     $info = App\Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->with('medias', 'content', 'categories', 'brands', 'seo', 'price', 'options', 'stock')->findorFail($item->id);

   $optionss = json_decode($info->options, true);


                    @endphp

                   @if($item->options->options   or  $item->options->attribute)
 
                          <span style="font-size: 14px;
font-weight: 400;">
                                @foreach ($info->options as $key=> $row)
        {{$row->name}}:
                                       @endforeach


                                        @foreach ($item->options->options as $op)

                                         {{ $op->name }}                                     
                                       @endforeach
                                    

   ،

                                       @foreach ($item->options->attribute as $attribute)
                                             {{ $attribute->attribute->name }} : {{ $attribute->variation->name }} 
                                        @endforeach
                          </span>
                 @endif


    </td>

        <td>
            <input type='hidden' name='cart_prices[]' class='cart-price-3'  value="{{ $item->price  }}"> {{ $item->price  }}
        </td>

        <td class="quantity">
                        
           <select id="quantity" class="quantity"   >
                                @for ($i = 1; $i < 5 + 1 ; $i++)
        <option value="{{$item->rowId}}" {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                                            </td>

        <!--td> 
            <input type='hidden' readonly name='cart_quantity[]'  class='form-control cart-service-3' value="{{ $item->qty }}"> {{ $item->qty }}
        </td -->
        <td> {{ $item->subtotal }}</td>
        <td>
            <a href="javascript:;" class="btn btn-danger btn-sm btn-circle delete-cart-row"  id="Removeservices"><i class="fa fa-times" aria-hidden="true"></i> <span  style="display: none;">'.$term->id .'</span>    </a>
        </td>
    </tr>
                @endforeach



                                    <tr id="no-service">
                                        <td colspan="5" class="text-center text-danger">
                                        	{{ __('Please select product to continue') }}
                                             <i id="spinner" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i>
                                        
                                    </td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>

                        <!--div class="row">
                            <table class="table table-condensed" id="product-table" style="color: inherit;
font-size: 16px;
font-weight: 700;
font-style: oblique;
font-weight: bold;">
                                <thead>
                                    <tr>
                                        <th  >{{ __('service') }}</th>
                                        <th  >{{ __('Price') }}</th>
                                        <th  >{{ __('Quantity') }}</th>
                                        <th  >{{ __('SubTotal') }}</th>
                                        <th><i class="fa fa-gear"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="no-product">
                                        <td colspan="5" class="text-center text-danger">
                                        		{{ __('No product selected yet') }}
                                        
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div -->

                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-body">
                            <div class="col-md-12 border-bottom" id="CouponBox">
                       <div class="col-md-12 border-bottom" id="CouponBox">
  <span class="success2"></span>
    </div>
    </div>
                        <div class="row pos-calculations">
                            <div class="col-md-6 border-bottom">
                                

             {{ __('Price Total') }}                            </div>
                            <div class="col-md-6 border-bottom" id="cart-sub-total">
                             
                                <span class="PriceTotal">{{ Cart::priceTotal() }} {{__('SAR')}}</span>
                            </div>

                                 


                            <div class="col-md-6 border-bottom">
                                <h6> {{ __('Discount') }}  (%)</h6>
                            </div>
                            <div class="col-md-6 border-bottom">
                                 <span class="Discount">{{ Cart::discount() }} {{__('SAR')}}</span>
                            </div>

                            <div class="col-md-6 border-bottom">
                                <h6>{{ __('Tax') }}</h6>
                            </div>
                             @php
             $totltax=0;
                foreach (Cart::content() as $item)
                {
                    $product_id=$item->id;
        $term = App\Term::where('user_id',getUserId())->findorFail($product_id);
          
       
        $totltax= $totltax + $term->tax_value ;

                }

                   @endphp
                            <div class="col-md-6 border-bottom">
                                <h5 id="cart-tax-amount">
                                    <span class="Tax"> {{ $totltax }} {{__('SAR')}}</span>
                                </h5>
                            </div>

                        
                            <div class="col-md-12 border-bottom" id="CouponBox">
                                <div class="row">
                                    <div class="col-md-6 ">

                                        <h6>{{ __('Apply Coupon') }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="coupon_code" name="coupon" class="form-control" style=" width:70%; display: inline">
                                        <button type="button" id="apply_coupon" style="" class="btn btn-success "><i class="fa fa-check"></i><i id="spinner4" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i> </button>
                                    </div>
                                </div>

                            </div>


                            <!--div class="col-md-12 py-3 border-bottom" id="removeCouponBox" style="display:none">
                                <h5>{{ __('Coupons') }}</h5>

                                <div class="coupons-base-content justify-content-between d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="fa fa-tag"></i>
                                        </div>
                                        <div>
                                            <h5 class="coupons-name mb-0" id="couponCode"> </h5>
                                            <p class="mb-0 text-success">
                                                Bingo!! You saved <span id="couponCodeAmonut"> $0.00 </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" onclick="removeCoupon();" class="btn btn-success btn-outline-danger remove-button"> Remove                                        </button>
                                    </div>
                                </div>
                            </div -->



                            <div class="col-md-6 border-bottom">
                             {{ __('Subtotal') }}                               </div>
                            <div class="col-md-6 border-bottom" id="cart-total">
                               <span class="Subtotal">   {{ Cart::subtotal() }} {{__('SAR')}}</span>
                            </div>

                           

                            <div class="col-md-6" id="totalAmountBox">
                                <h4>{{ __('Grand Total') }}   </h4>
                            </div>
                            <div class="col-md-6">
                                <h4 id="total-cart">
                                    <span class="Total">  {{ Cart::total() }} {{__('SAR')}}</span>
                                </h4>
                                <input type="hidden" id="cart-total-input">
                                <input type="hidden" id="product-total-input">
                                <input type="hidden" id="coupon_id" name="coupon_id">
                                <input type="hidden" id="coupon_amount" name="coupon_amount">
                            </div>

                            <div class="col-md-6 mt-2">
                                <button type="button" id="empty-cart" class="btn btn-danger p-3 btn-lg btn-block">{{ __('Empty Cart') }}
  <i id="spinner2" class="fa fa-spin fa-spinner loading-save-c2" style="display: none;"></i>
                                </button>
                                <div id="cart-item-error" class="invalid-feedback">
                                    

                                </div>

                            </div>
                            <div class="col-md-6 mt-2">
                      

     

      
                @csrf
            
            <input type="submit" name="{{ __('Pay') }}"  class="btn btn-success p-3 btn-lg btn-block" value="{{ __('Pay') }}">
            
        </form>

     
                                <div id="cart-item-error" class="invalid-feedback"></div>
                            </div>


                        </div>

                    </div>
                </div>
           
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="card-body">
        <form class="basicform_with_reset" action="{{ url('/') }}/seller/customer_store" method="post">
          @csrf
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Name') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="name">
          </div>
        </div>

         <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Email') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="email" class="form-control" required="" name="email">
          </div>
        </div>

         <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Phone') }}</label>
          <div class="col-sm-12 col-md-7">
            <input type="number" class="form-control" required="" name="phone">
          </div>
        </div>

        
  
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
          <div class="col-sm-12 col-md-7">
            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>

            
          </div>
        </div>
        </form>
      </div>
      </div>
      
    </div>
  </div>
</div>


@endsection

@push('js')
<script type="text/javascript">
 function add_new_row(table, rowcontent) {
    if ($(table).length > 0) {
        if ($(table + ' > tbody').length == 0) $(table).append('<tbody />');
        ($(table + ' > tr').length > 0) ? $(table).children('tbody:last').children('tr:last').append(rowcontent): $(table).children('tbody:last').append(rowcontent);
    }
}
</script>



  <script type="text/javascript">
      $(document).on('click','#Removeshop',function(){

              var text =$(this).text();

             

              text=text.toString();

                    var xxxx= text;
var newStr = xxxx.substring(0, xxxx.length - 3); 

         
       
        $.ajax({
            url:"{{url('/seller/Shopeaddservice')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:newStr,

           },
            dataType:"json",
            beforeSend:function(){
                      $('.success2').html('');
      document.getElementById("spinner").style.display = "block";
              

                  ///////////////////////////////

                  //////////////////////////////////
                      
            },
            success:function(data)
            {
             $('.PriceTotal').html(data.PriceTotal);  
             $('.Discount').html(data.Discount);  
             $('.Tax').html(data.Tax);  
             $('.Subtotal').html(data.Subtotal);  
             $('.Total').html(data.Total);  
 
  $('#myTable').append(data.success);
            
      document.getElementById("spinner").style.display = "none";
      
           window.location.href = "/seller/getPOSShope";

            

         

            }
        });
             return false;
    
                    
                     
                    });
  </script>



  <script type="text/javascript">
   

       $(document).on('click','#empty-cart',function(){

       
        $.ajax({
            url:"{{url('/seller/ShopeEmptyCart')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
          

           },
            dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner2").style.display = "block";       
            },
            success:function(data)
            {
             $('.PriceTotal').html(data.PriceTotal);  
             $('.Discount').html(data.Discount);  
             $('.Tax').html(data.Tax);  
             $('.Subtotal').html(data.Subtotal);  
             $('.Total').html(data.Total);  
 
        
      document.getElementById("spinner2").style.display = "none";

    $("#myTable > tbody").empty();
     
          
             $('.success').html(data.success);  
        

            }
        });
             return false;
    
                    
                     
                    });

  </script>





  <script type="text/javascript">
   

       $(document).on('click','#Removeservices',function(){
              
              var text =$(this).text();

              text=text.toString();
                  

    //  document.getElementById(this).style.display = "none";

           //  $(this).closest('tr').remove();   
          // $(this).parent().parent().remove(); 

        $.ajax({
            url:"{{url('/seller/ShopeRemoveservices')}}",
            method:"POST",
           data :{
          _token:'{{ csrf_token() }}',
            id:text,
          

           },
            dataType:"json",
            beforeSend:function(){
            document.getElementById("spinner").style.display = "block";


            },
            success:function(data)
            {
             $('.PriceTotal').html(data.PriceTotal);  
             $('.Discount').html(data.Discount);  
             $('.Tax').html(data.Tax);  
             $('.Subtotal').html(data.Subtotal);  
             $('.Total').html(data.Total); 

           window.location.href = "/seller/getPOSShope";

              
 var b = data.id;
document.getElementById(b).innerHTML = '';

 
        
      document.getElementById("spinner").style.display = "none";

    
        

            }
        });
             return false;
    
                    
                     
                    });

  </script>


   <script type="text/javascript">
      $(document).on('click','#apply_coupon',function(){

    
    var code =$('#coupon_code').val();
 
        $.ajax({
            url:"{{url('/seller/Shopeapply_coupon')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            code:code,

           },
            dataType:"json",
            beforeSend:function(){
      document.getElementById("spinner4").style.display = "block"; 
                 
                      
            },
            success:function(data)
            {
                   
         $('.PriceTotal').html(data.PriceTotal);  
             $('.Discount').html(data.Discount);  
             $('.Tax').html(data.Tax);  
             $('.Subtotal').html(data.Subtotal);  
             $('.Total').html(data.Total);  
             $('.success2').html(data.success);  

      document.getElementById("spinner4").style.display = "none";
 

$.notify('{{__("Coupon Applied!")}}', "success");
             
             


            }
        });
             return false;
    
                    
                     
                    });
  </script>


 <script type="text/javascript">
            $('.category_id').on('change',function() {
    
    var newval = $(this).val();

   
     $.ajax({
            url:"{{url('/seller/Shopefilter-services')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:newval,

           },
            dataType:"html",
            beforeSend:function(){
      document.getElementById("spinner5").style.display = "block"; 
                 
                      
            },
            success:function(data)
            {
                   
        
             $('.filter-services').html(data);  

      document.getElementById("spinner5").style.display = "none";
 
     document.getElementById("hidemainsec").style.display = "none";


            }
        });
});
        </script>


 <script type="text/javascript">
            $('.location_id').on('change',function() {
    
    var newval = $(this).val();

   
     $.ajax({
            url:"{{url('/seller/Shopelocation-filter')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            location_id:newval,

           },
            dataType:"html",
            beforeSend:function(){
      document.getElementById("spinner5").style.display = "block"; 
                 
                      
            },
            success:function(data)
            {
                   
        
             $('.filter-services').html(data);  

      document.getElementById("spinner5").style.display = "none";
 
     document.getElementById("hidemainsec").style.display = "none";


            }
        });
});
        </script>

        

<script>
$(document).ready(function(){



 $('#posSearch').keyup(function(){ 

  
        var query = $(this).val();
        
         
         $.ajax({
          url:"{{url('/')}}/seller/Shopesearch_key",
          method:"POST",
          data:
          {
            query:query,
        _token:'{{ csrf_token() }}',
               
            },
        dataType:"html",
            beforeSend:function(){
      document.getElementById("spinner5").style.display = "block"; 
                 
                      
            },
            success:function(data)
            {
                   
        
             $('.filter-services').html(data);  

      document.getElementById("spinner5").style.display = "none";
 
     document.getElementById("hidemainsec").style.display = "none";


            }
         });
        
    });

   

});


 
</script>




<script type="text/javascript">
    $(".color-variant li").click(function ()
{       
var a = $(this).attr("value");
  
var a = a.substring(0, a.length - 1);   

      

       
         
 $.ajax({
            url:"{{url('/termoptions_pricePOS')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:a,
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
   
 

$.notify('{{__("Item updaed!")}}', "success");
             
             


             $('.successdata').html(data.success); 
    alert(data.success2);
       

  


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
            url:"{{url('/varent_selctionPOS')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:a,
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
   
 

$.notify('{{__("Item updaed!")}}', "success");
             
            $('#success').html(data.success);
             

       

  


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

       
  window.location.href = '{{ url("seller/getPOSShope") }}'

            }
        });



});
        </script>

    




        

 <!-- notify bootstrap-->
    <script src="{{url('/')}}/frontend/bigbag/js/bootstrap-notify.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>

<script type="text/javascript">
    $(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})
</script>

<script type="text/javascript">
    $(".chosen-select2").chosen({
  no_results_text: "Oops, nothing found!"
})
</script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
