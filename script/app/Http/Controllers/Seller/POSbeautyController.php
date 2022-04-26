<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Term;
use Cart;
use App\Order;
use App\Orderitem;
use App\Ordermeta;
use Auth;
use App\Models\User;
use App\Category;
use App\Postcategory;
use Carbon\Carbon;
use App\Useroption;
use Session;
use DateTime;
 
class POSbeautyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function POSbeauty( )
    {
 

          return view('seller.POS.POSbeauty');
    }
 
   
    public function addservice(Request $request)
    {
           $id= request('id');
$user_id=domain_info('user_id');

        $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id);
          $term= $term->first();
           
             $name= $term->title;
              $price=$term->price->price;
             $qty=1;
             $subTotal=$price*$qty;
         
$cart_services="<input type='hidden' name='cart_services[]'  value=".$id."> ".$name."";
 $cart_prices="<input type='hidden' name='cart_prices[]' class='cart-price-3'  value='".$price."'> ".$price." ";
 $cart_quantity="<input type='hidden' readonly name='cart_quantity[]'  class='form-control cart-service-3' value='".$qty."'>  ".$qty." ";

         $remove='<a href="javascript:;" class="btn btn-danger btn-sm btn-circle delete-cart-row"  id="Removeservices"><i class="fa fa-times" aria-hidden="true"></i> <span  style="display: none;">'.$term->id .'</span>   <i id="spinner3" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i></a>';

        $success= "<tr class=".$id."' id='".$id."'><td>".$cart_services."</td><td>".$cart_prices."</td><td>".$cart_quantity."</td><td>".$subTotal."</td><td>".$remove."</td></tr>";

 
               
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) 
        {
      $success_output = '<div class="alert alert-danger">Item is already Saved For Later!</div>';  
                      $output = array('success'     =>  $success_output);

            return  $output;
        }

          $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id);

          $term= $term->first();
       if(!empty($term)){
           $price=$term->price->price;
           if($request->option != null){
            foreach($term->termoption ?? [] as $row){
                if($row->amount_type == 1){
                 $price= $price+$row->amount;
                }
                else{
                 $percent= $price * $row->amount / 100;
                 $price= $price+$percent;
                }
            }
            $options=$term->termoption;
           }
           else{
            $options= [];
           }

           if($request->variation != null){
            $attributes=$term->attributes ?? [];
           }
           else{
            $attributes= [];
           }
           $qty=$request->qty ?? 1;

           $price=$price*$qty;
                   
           Cart::add($term->id,$term->title, $qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
          
       }

 
  //Cart::add($term->id, $term->name, 1,$term->price,0)
           // ->associate('App\Term');

         $PriceTotal=Cart::priceTotal().' '. __('SAR');
         $Discount=Cart::discount().' '. __('SAR');

$totltax=0;
                foreach (Cart::content() as $item)
                {
                    $product_id=$item->id;
        $term = Term::where('user_id',domain_info('user_id'))->findorFail($product_id);
          
       
        $totltax= $totltax + $term->tax_value ;

                }
         
         $Tax=$totltax.' '. __('SAR');
         $Subtotal=Cart::subtotal().' '. __('SAR');
         $Total=Cart::total().' '. __('SAR');
        


                      $output = array(
                        'success'     =>  $success,
                        'PriceTotal'     =>  $PriceTotal,
                        'Discount'     =>  $Discount,
                        'Tax'     =>  $Tax,
                        'Subtotal'     =>  $Subtotal,
                        'Total'     =>  $Total
                         
                       
                    
                    );
     
                   
                    return $output;
        
    }


    public function EmptyCart(Request $request)
    {



          Cart::destroy();
           $PriceTotal=Cart::priceTotal().' '. __('SAR');
         $Discount=Cart::discount().' '. __('SAR');
         $Tax=Cart::tax().' '. __('SAR');
         $Subtotal=Cart::subtotal().' '. __('SAR');
         $Total=Cart::total().' '. __('SAR');
        
         $success=' <tbody><tr id="no-service"><td colspan="5"class="text-center text-danger"> <i id="spinner" class="fa fa-spin fa-spinner loading-save-c" style="display: none;"></i></td></tr></tbody>';

           
                      $output = array(
                        'success'     =>  $success,
                        'PriceTotal'     =>  $PriceTotal,
                        'Discount'     =>  $Discount,
                        'Tax'     =>  $Tax,
                        'Subtotal'     =>  $Subtotal,
                        'Total'     =>  $Total
                         
                       
                    
                    );
     
                   
                    return $output;
    }


    

      public function Removeservices()
            {
                   $id=request('id');
                   $zzzzz=request('id');
                  if (request()->has('id'))
                   {

                   $itme = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $rowId  ;
        });
                
        $id=$itme->first()->rowId;
                         Cart::remove($id);

         $PriceTotal=Cart::priceTotal().' '. __('SAR');
         $Discount=Cart::discount().' '. __('SAR');
        $totltax=0;
                foreach (Cart::content() as $item)
                {
                    $product_id=$item->id;
        $term = Term::where('user_id',domain_info('user_id'))->findorFail($product_id);
          
       
        $totltax= $totltax + $term->tax_value ;

                }
         
         $Tax=$totltax.' '. __('SAR');
         $Subtotal=Cart::subtotal().' '. __('SAR');
         $Total=Cart::total().' '. __('SAR');

           $success_output = '<div class="alert alert-danger">
            '.__("Item has been removed!").' 
           </div>';  
                       $output = array(
                      
                        'PriceTotal'     =>  $PriceTotal,
                        'Discount'     =>  $Discount,
                        'Tax'     =>  $Tax,
                        'Subtotal'     =>  $Subtotal,
                        'Total'     =>  $Total,
                         'id'       =>$zzzzz
                       
                    
                    );
     
                   
                    return $output;
     
                   
                    return $output;
                  }
                  else
                  {
                    return 'no  id';
                  }

             
        
            }

     public function POS(Request $request)
    {
         
          $todayDate = date('Y/m/d');
           $date = request('date') ;

           $currentDate = date('Y-m-d');

        $todayDate = date('Y-m-d', strtotime($todayDate));   
          $date = date('Y-m-d', strtotime($date));
      
        if ($date < $todayDate )
        {   
          Session::flash('danger', __('It is not possible to book less than today date')); 

           return redirect()->back()->with(__('It is not possible to book less than today date'));   
          return back();
        
        } 
              $time= date('H:i:s');
            if ( request('posDateTime') <  $time)
        {   
          Session::flash('danger', __('Reservation must not have passed')); 

           return redirect()->back()->with(__('It is not possible to book less than today date'));   
          return back();
        
        } 
         

        
     
 
          

         $PriceTotal=Cart::priceTotal();
         $Discount=Cart::discount();

         $totltax=0;
                foreach (Cart::content() as $item)
                {
                    $product_id=$item->id;
        $term = Term::where('user_id',domain_info('user_id'))->findorFail($product_id);
          
       
        $totltax= $totltax + $term->tax_value ;

                }
         $Tax=$totltax;
         $Subtotal=Cart::subtotal();
         $Total=Cart::total();

         $prefix=Useroption::where('user_id',domain_info('user_id'))->where('key','order_prefix')->first();
        $max_id=Order::max('id');
        if (empty($prefix)) {
          $prefix=$max_id+1;
        }
        else{
         $prefix=$prefix->value.$max_id;
       }

       $data = $request->all();
       $Order=new Order();
      $Order->order_no=$prefix;
       $Order->transaction_id=$data['_token'];
       $Order->customer_id=request('customer_id')[0];
       $Order->emp_id=request('emp_id')[0];
       $Order->user_id=Auth::id();
       $Order->order_type=1;
       $Order->payment_status=1;
       $Order->status='processing';
       $Order->tax=$Tax;
       $Order->shipping=0;
       $Order->total=$Total;
       $Order->is_fully_refunded=0;
       $Order->is_partially_refunded=0;
       $Order->refund_status='';
       $Order->reason='';
       $Order->order_date=request('date');
       $Order->order_time=request('posTime');
       $Order->seller_take_action='';
                // $Order->order_date=*date('Y-m-d H:i:s')*/;
                // $Order->order_time=*date('H:i:s')*/;
       $Order->save();
 
      // $data['customer_id']=request('customer_id')[0];
       $customer_id=request('customer_id')[0];
       $posts=User::where('id',$customer_id)->first();

       $info['name'] = $posts->name;
       $info['email'] = $posts->email;
       $info['comment'] = '';
       $info['coupon_discount'] = Cart::discount() ;
       $info['sub_total'] =  $PriceTotal;


       $meta = new Ordermeta;
       $meta->order_id = $Order->id;
       $meta->key = 'content';
       $meta->value = json_encode($info);
       $meta->save();


       foreach ($data['cart_services'] as $key => $item) {
           $Orderitem=new Orderitem();
           $Orderitem->order_id=$Order->id;
           $Orderitem->term_id=$data['cart_services'][$key];
           $Orderitem->info='{"attribute":[],"options":[]}';
           $Orderitem->qty=$data['cart_quantity'][$key];
           $Orderitem->amount=$data['cart_prices'][$key];
                // $Orderitem->is_refundable='';
                 //$Orderitem->reason='';
                 //$Orderitem->refund_status='';
           $Orderitem->save();
       }

          Cart::destroy();


       return redirect('/seller/order/'.$Order->id);
   }

   
 public function apply_coupon(Request $request)
    {
             
        $validatedData = $request->validate([
            'code' => 'required|max:50',
         ]);
        $user_id=domain_info('user_id');
        $code=Category::where('user_id',$user_id)->where('type','coupon')->where('name',$request->code)->first();
        if (empty($code)) {
           $error['errors']['error']='Coupon Code Not Found.';
           return response()->json($error,404);
        }
        $mydate= Carbon::now()->toDateString();
        if ($code->slug >= $mydate)
         {
            Cart::setGlobalDiscount($code->featured);

             $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
    

           $success_output = '<div class="alert alert-success">
            '.__("Coupon Applied!").' 
           </div>';  
                        $PriceTotal=Cart::priceTotal().' '. __('SAR');
         $Discount=Cart::discount().' '. __('SAR');
         $Tax=Cart::tax().' '. __('SAR');
         $Subtotal=Cart::subtotal().' '. __('SAR');
         $Total=Cart::total().' '. __('SAR');
    
           
                      $output = array(
                        'success'     =>  $success_output,
                        'PriceTotal'     =>  $PriceTotal,
                        'Discount'     =>  $Discount,
                        'Tax'     =>  $Tax,
                        'Subtotal'     =>  $Subtotal,
                        'Total'     =>  $Total
                         
                       
                    
                    );
     
                   
                    return $output;

          //  return response()->json(['Coupon Applied']);
        }

        $error['errors']['error']='Sorry, this coupon is expired';
        return response()->json($error,401);



    }


    public function filter_POSBeautyType( )
    {
         

         $user_id = domain_info('user_id');

               
               if (request('id') == '0' ) 
               {
                    $products = Term::where('user_id', $user_id)
       
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
           ->withCount('reviews')->inRandomOrder()->get();
               }
               else
               {
                $products = Term::where('user_id', $user_id)
          ->where('POSBeautyType', request('id'))
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
           ->withCount('reviews')->inRandomOrder()->get();
               }
          

     

     $service='';


foreach($products as $product)
    {
        $service.=' <div class="col-md-6 col-lg-3">
                             <div class="card">
         <img class="card-img-top" src="'. asset($product->preview->media->url ?? 'uploads/default.png').'" height="100em">
                     <div class="card-body p-2">
                 <p class="font-weight-normal">
                            '. $product->title.' 
                         </p>
                                              '.$product->price->price.' '.__('SAR').'
                                            </div>
                                            <div class="card-footer p-1">
 
 <a id="Removeshop" href="javascript:;" class="btn btn-block btn-dark add-to-cart"><span style="display:none;">'. $product->id.' </span><i class="fa fa-plus"></i>اضافة </a>
 </div>
  </div>
  </div>';
}


          $success_output = "<div class='row'>
                     <div class='col-md-12 mt-2'>
                                     
                                    </div>

                            ".$service."
 
                                                                  
                                                                                                              
                                                            </div>";  
                        
    
           
                      $output = array(
                        'success'     =>  $success_output
                        
                    );
     
                   
                    return $output;
    }

    public function filter_services( )
    {
        $user_id = domain_info('user_id');

          $category_id=request('id');
   if ($category_id == 0 ) 
   {
    
 
     $posts= Category::where('user_id',getUserId())->where('type','category')->with('preview')->latest()->get();

     $Categories_ids=[];
   foreach ($posts as $key => $post) 
   {
    
         array_push($Categories_ids,$post->id);
   }
         

  $attributes=Postcategory::whereIn('category_id',$Categories_ids)->get();
        
   }
else
{
 $attributes=Postcategory::where('category_id',$category_id)->get();
   
}


  $cats_ids=[];
   foreach ($attributes as $key => $Postcat) 
   {
    
         array_push($cats_ids,$Postcat->term_id);
   }
         

  $products = Term::where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
           -> whereIn('id',$cats_ids)
           ->withCount('reviews')->inRandomOrder()->get();
     $service='';


foreach($products as $product)
    {
        $service.=' <div class="col-md-6 col-lg-3">
                             <div class="card">
         <img class="card-img-top" src="'. asset($product->preview->media->url ?? 'uploads/default.png').'" height="100em">
                     <div class="card-body p-2">
                 <p class="font-weight-normal">
                            '. $product->title.' 
                         </p>
                                              '.$product->price->price.' '.__('SAR').'
                                            </div>
                                            <div class="card-footer p-1">
 
 <a id="Removeshop" href="javascript:;" class="btn btn-block btn-dark add-to-cart"><span style="display:none;">'. $product->id.' </span><i class="fa fa-plus"></i>اضافة </a>
 </div>
  </div>
  </div>';
}


          $success_output = "<div class='row'>
                     <div class='col-md-12 mt-2'>
                                     
                                    </div>

                            ".$service."
 
                                                                  
                                                                                                              
                                                            </div>";  
                        
    
           
                      $output = array(
                        'success'     =>  $success_output
                        
                    );
     
                   
                    return $output;
    }



 public function location_filter( )
    {
            $location_id=request('location_id');

        $user_id = domain_info('user_id');

        if ( $location_id == 0)
         {
             $products = Term::where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
           ->withCount('reviews')->inRandomOrder()->get();
        }
        else
        {
             $products = Term::where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
           -> where('branche_id',$location_id)
           ->withCount('reviews')->inRandomOrder()->get();
        }
 
     $service='';


foreach($products as $product)
    {
        $service.=' <div class="col-md-6 col-lg-3">
                             <div class="card">
         <img class="card-img-top" src="'. asset($product->preview->media->url ?? 'uploads/default.png').'" height="100em">
                     <div class="card-body p-2">
                 <p class="font-weight-normal">
                            '. $product->title.' 
                         </p>
                                              '.$product->price->price.' '.__('SAR').'
                                            </div>
                                            <div class="card-footer p-1">
 
 <a id="Removeshop" href="javascript:;" class="btn btn-block btn-dark add-to-cart"><span style="display:none;">'. $product->id.' </span><i class="fa fa-plus"></i>اضافة </a>
 </div>
  </div>
  </div>';
}


          $success_output = "<div class='row'>
                     <div class='col-md-12 mt-2'>
                                     
                                    </div>

                            ".$service."
 
                                                                  
                                                                                                              
                                                            </div>";  
                        
    
           
                      $output = array(
                        'success'     =>  $success_output
                        
                    );
     
                   
                    return $output;
    }

    public function search_key( )
    {
             $query=request('query');

        $user_id = domain_info('user_id');

        if ($query == null)
         {
            $products = Term::where('user_id', $user_id)
          ->where('status', 1)
          ->where('type', 'product')
          ->with('preview')
           ->inRandomOrder()->get();
             
        }else
        {
            $products = Term::where('user_id', $user_id)
          ->where('status', 1)
          ->where('type', 'product')
          ->with('preview')
           ->where('title->ar','LIKE', '%' . $query . '%')
           ->orWhere('title->en','LIKE', '%' . $query . '%')
           ->inRandomOrder()->get();
        }

         
 
     $service='';


foreach($products as $product)
    {
        $service.=' <div class="col-md-6 col-lg-3">
                             <div class="card">
         <img class="card-img-top" src="'. asset($product->preview->media->url ?? 'uploads/default.png').'" height="100em">
                     <div class="card-body p-2">
                 <p class="font-weight-normal">
                            '. $product->title.' 
                         </p>
                                              '.$product->price->price.' '.__('SAR').'
                                            </div>
                                            <div class="card-footer p-1">
 
 <a id="Removeshop" href="javascript:;" class="btn btn-block btn-dark add-to-cart"><span style="display:none;">'. $product->id.' </span><i class="fa fa-plus"></i>اضافة </a>
 </div>
  </div>
  </div>';
}


          $success_output = "<div class='row'>
                     <div class='col-md-12 mt-2'>
                                     
                                    </div>

                            ".$service."
 
                                                                  
                                                                                                              
                                                            </div>";  
                        
    
           
                      $output = array(
                        'success'     =>  $success_output
                        
                    );
     
                   
                    return $output;
    }

     
}
