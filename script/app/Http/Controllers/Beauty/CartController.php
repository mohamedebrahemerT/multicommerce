<?php

namespace App\Http\Controllers\Beauty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attribute;
use Cart;
use App\Category;
use App\Term;
use Carbon\Carbon;
 
class CartController extends Controller
{
    
    public function add_to_cart(Request $request,$id)
    {

    	$id=request()->route()->parameter('id');
    	$user_id=domain_info('user_id');
    	
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id);
       if($request->option != null){
        $term=$term->with('termoption',function($q) use ($option){
            if(count($option) > 0){
            return $q->whereIn('id',$option);
            }
            else{
                return $q;
            }
            });
       }
       if($request->variation){
        $term=$term->with('attributes',function($q) use ($variation){
            if(count($variation) > 0){
             return $q->whereIn('id',$variation);
            }
            else{
                return $q;
            }
         
        });
       }
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
        $data['count']=Cart::count();
    	$data['total']=Cart::total();
    	$data['subtotal']=Cart::subtotal();
    	$data['cart_add']=Cart::content();
 
    	//return response()->json($data);

        return redirect('/cart');
    }


    public function add_to_wishlist(Request $request,$id){
        $id=request()->route()->parameter('id');
        $user_id=domain_info('user_id');
        
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id);
        if($request->option != null){
         $term=$term->with('termoption',function($q) use ($option){
             if(count($option) > 0){
             return $q->whereIn('id',$option);
             }
             else{
                 return $q;
             }
             });
        }
        if($request->variation){
         $term=$term->with('attributes',function($q) use ($variation){
             if(count($variation) > 0){
              return $q->whereIn('id',$variation);
             }
             else{
                 return $q;
             }
          
         });
        }
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
                    
            Cart::instance('saveForLater')->add($term->id,$term->title, $qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }
        return view(base_view() . '.wishlist');
        
       // return Cart::instance('wishlist')->count();
    }

    public function wishlist_remove(){
          $id=request()->route()->parameter('id');
          Cart::instance('wishlist')->remove($id);
          return back();
    }

    public function cart_clear()
    {
        Cart::destroy();
        return back();
    }

    public function cart_add(Request $request)
    {
         //return request();
         $id=$request->id;
        $user_id=domain_info('user_id');
        $option=$request->option ?? [];
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('status',1)->where('id',$id);
        if($request->option != null){
            $term=$term->with('termoption',function($q) use ($option){
            if(count($option) > 0){
                return $q->whereIn('id',$option);
                }
                else{
                    return $q;
                }
            });
        }
        if($request->variation != null){
            
            $variation=[];
            foreach($request->variation as $key => $row){
                array_push($variation,$row);
            }

            
            $term=$term->with('attributes',function($q) use ($variation){
             if(count($variation) > 0){
                 return $q->whereIn('variation_id',$variation);
             }
             else{
                   return $q;
             }
             
            });
           
        }
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
           
           
            $price=$price*$request->qty;
            // dd($price);       
            Cart::add($term->id,$term->title, $request->qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }
        
        
        $data['count']=Cart::count();
        $data['total']=Cart::total();
        $data['subtotal']=Cart::subtotal();
        $data['cart_add']=Cart::content();
          
                    
       // return response()->json($data);
        return redirect('/cart');

    }



    public function remove_cart(Request $request){
        Cart::remove($request->id);
        $data['count']=Cart::count();
        $data['total']=Cart::total();
        $data['subtotal']=Cart::subtotal();
        $data['cart_add']=Cart::content();
        return response()->json($data);

    }

    public function cart_remove($id){
        $id=request()->route()->parameter('id');
        Cart::remove($id);
        return back();

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
                      $output = array(
                        'success'     =>  $success_output,
                        'count'     =>  $count,
                        'total'     =>  $total,
                        'subtotal'     =>  $subtotal
                    
                    );
     
                   
                    return $output;

          //  return response()->json(['Coupon Applied']);
        }

        $error['errors']['error']='Sorry, this coupon is expired';
        return response()->json($error,401);



    }

    public function express(Request $request){
       
        $id=$request->id;
        $user_id=domain_info('user_id');
        $option=$request->option ?? [];
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('status',1)->where('id',$id);
        if($request->option != null){
            $term=$term->with('termoption',function($q) use ($option){
            if(count($option) > 0){
                return $q->whereIn('id',$option);
                }
                else{
                    return $q;
                }
            });
        }
        if($request->variation != null){
            
            $variation=[];
            foreach($request->variation as $key => $row){
                array_push($variation,$row);
            }

            
            $term=$term->with('attributes',function($q) use ($variation){
             if(count($variation) > 0){
                 return $q->whereIn('variation_id',$variation);
             }
             else{
                   return $q;
             }
             
            });
           
        }
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
           
           
            $price=$price*$request->qty;
            // dd($price);       
             Cart::add($term->id,$term->title, $request->qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }

       
       return redirect('/checkout');
    }

      public function destroy()
            {
                   $id=request('id');
                  if (request()->has('id'))
                   {

                    $id=substr($id, 0, -1);
                

                         Cart::remove($id);

        $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
        $cart_add=Cart::content();

           $success_output = '<div class="alert alert-danger">
            '.__("Item has been removed!").' 
           </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'count'     =>  $count,
                        'total'     =>  $total,
                        'subtotal'     =>  $subtotal,
                        'cart_add'     =>  $cart_add
                    );
     
                   
                    return $output;
                  }
                  else
                  {
                    return 'no  id';
                  }

             
        
            }

             public function switchToSaveForLater()
       {


          $id=request('id');
           //return $id=substr($id, 0, -1);
         
        // $id = trim(preg_replace('/\s+/','', $id));


          $item = Cart::get($id);

        Cart::remove($id);
          $count=Cart::count();
        
        $total=Cart::total();
        $subtotal=Cart::subtotal();
        $cart_add=Cart::content();

               
        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) 
        {
      $success_output = '<div class="alert alert-danger">Item is already Saved For Later!</div>';  
                      $output = array('success'     =>  $success_output);

            return  $output;
        }
 
  Cart::instance('saveForLater')->add($item->id, $item->name, 1,$item->price,0,
    ['preview'=>$item->options->preview])
            ->associate('App\Term');

            
 
  $countwishlist=Cart::instance('saveForLater')->count();
      
             $success_output = '<div class="alert alert-success">
             '.__("Item has been Saved For Later!").'
             </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'count'     =>  $count,
                        'total'     =>  $total,
                        'subtotal'     =>  $subtotal,
                        'cart_add'     =>  $cart_add,
                        'countwishlist'=>$countwishlist
                    );

            return  $output;

        
      }

      public function update(Request $request, $id)
            {

               

                $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 5.']));
            return response()->json(['success' => false], 400);
        }

        if ($request->quantity > $request->productQuantity) {
            session()->flash('errors', collect(['We currently do not have enough items in stock.']));
            return response()->json(['success' => false], 400);
        }

        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
            }


             public function SaveForLaterdestroy(Request $request)
    {
        $id=request('id');
                  if (request()->has('id'))
                   {

                    // $id=substr($id, 0, -1);
                
        Cart::instance('saveForLater')->remove($id);
         $countwishlist=Cart::instance('saveForLater')->count();
         
                       
           $success_output = '<div class="alert alert-danger">
           '.__("Item has been removed from saved!").'
             </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'countwishlist'     =>  $countwishlist
                    );
     
                   
                    return $output;
                  }
                  else
                  {
                    return 'no  id';
                  }
    }

         public function switchToCart()
    {
          $id = request('id');
        //$id = substr($id, 0, -13);
        // $id = trim(preg_replace('/\s+/','', $id));


        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);


        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {

            $success_output = '<div class="alert alert-success" style="text-align: center;"> The item is already in your cart!</div>';


            $output = array(
                'success' => $success_output
            );


            return $output;


        }
 

             Cart::instance('default')->add($item->id, $item->name, 1,$item->price,0,
    ['preview'=>$item->options->preview])
            ->associate('App\Term');


              $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
         $countwishlist=Cart::instance('saveForLater')->count();
         $cart_content=Cart::instance('default')->content();
             $items='';
        foreach ($cart_content as   $item) 
         {
            $items.='<li>
                                    <div class="media">
                                        <a href="product-page.html"><img alt="" class="me-3"
                                                src="'.$item->options->preview.'"></a>
                                        <div class="media-body">
                                            <a href="product-page.html">
                                                <h4>
                                                '.$item->name .'
                                                </h4>
                                            </a>
                                            <h4><span> '.$item->qty.' x EGP 
                                            '.$item->price.'</span></h4>
                                        </div>
                                    </div>
                                    <div class="close-circle"><a href="#"><i class="fa fa-times"
                                                aria-hidden="true"></i></a></div>
                                </li>';
             
         }


         

         $cart_content='<ul class="show-div onhover-show-div shopping-cart">

              
                               '.$items.'
                            
                                <li>
                                    <div class="total">
                                        <h5>subtotal : <span>EGP '.Cart::instance('default')->total().'</span></h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="buttons"><a href="/cart" class="view-cart">'.__('view cart').'</a> <a href="/checkout" class="checkout">'.__('checkout').'</a></div>
                                </li>
                            </ul>';
          
$success_output = '<div class="alert alert-success">
   '.__("Item moved to cart!").'
 </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'count'     =>  $count,
                        'total'     =>  $total,
                        'subtotal'     =>  $subtotal,
                        'countwishlist'=>$countwishlist,
                        'cart_content'=>$cart_content
                    );
     
                   
                    return $output;
    
        


    }

     public function store($id,Request $request)
            {
              
 
                 
         $id=$request->id;
        $user_id=domain_info('user_id');
        $option=$request->option ?? [];
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('status',1)->where('id',$id);
        if($request->option != null){
            $term=$term->with('termoption',function($q) use ($option){
            if(count($option) > 0){
                return $q->whereIn('id',$option);
                }
                else{
                    return $q;
                }
            });
        }
        if($request->variation != null){
            
            $variation=[];
            foreach($request->variation as $key => $row){
                array_push($variation,$row);
            }

            
            $term=$term->with('attributes',function($q) use ($variation){
             if(count($variation) > 0){
                 return $q->whereIn('variation_id',$variation);
             }
             else{
                   return $q;
             }
             
            });
           
        }
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
           
           
            $price=$price*$request->qty;
            // dd($price);       
            Cart::add($term->id,$term->title, $request->qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }
        
        
        $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
          $cart_content=Cart::instance('default')->content();
          $imgviw='<img src="'.$term->preview->media->url.'" class="img-fluid" alt="">';
             $items='';
        foreach ($cart_content as   $item) 
         {
            $items.='<li>
                                    <div class="media">
                                        <a href="product-page.html"><img alt="" class="me-3"
                                                src="'.$item->options->preview.'"></a>
                                        <div class="media-body">
                                            <a href="product-page.html">
                                                <h4>
                                                '.$item->name .'
                                                </h4>
                                            </a>
                                            <h4><span> '.$item->qty.' x EGP 
                                            '.$item->price.'</span></h4>
                                        </div>
                                    </div>
                                    <div class="close-circle"><a href="#"><i class="fa fa-times"
                                                aria-hidden="true"></i></a></div>
                                </li>';
             
         }


         

         $cart_content='<ul class="show-div onhover-show-div shopping-cart">

              
                               '.$items.'
                            
                                <li>
                                    <div class="total">
                                        <h5>subtotal : <span>EGP '.Cart::instance('default')->total().'</span></h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="buttons"><a href="/cart" class="view-cart">'.__('view cart').'</a> <a href="/checkout" class="checkout">'.__('checkout').'</a></div>
                                </li>
                            </ul>';

              

              $success_output = '<div class="alert alert-success">
              '.__('Data add to cart').'
              
              </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'count'     =>  $count,
                        'total'     =>  $total,
                        'subtotal'     =>  $subtotal,
                        'cart_content'     =>  $cart_content,
                        'imgviw'=>$imgviw
                    );
     
                   
                    return $output;
             
            }

             

}
