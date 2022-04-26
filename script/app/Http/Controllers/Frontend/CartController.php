<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attribute;
use Cart;
use App\Category;
use App\Term;
use Carbon\Carbon;
use App\Useroption;

use Illuminate\Support\Facades\Session;
 
class CartController extends Controller
{

    public function currency()
    {
         $user_id = domain_info('user_id');
        
        if(Useroption::where('user_id',$user_id)->where('key','currency')->first())
      {
         $currency=Useroption::where('key','currency')->where('user_id',$user_id)->first();
      }
         
       $currency=json_decode($currency->value ?? '');

              return $currency->currency_icon;
                             
              
    } 

    public function add_to_cart(Request $request,$id)
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
          
                    
         
        return redirect('/seller/getPOSShope');
    }

     public function add_to_cartforent(Request $request,$id)
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
           
             $price;
          
            // dd($price);       
            Cart::add($term->id,$term->title,1,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }
        
        
        $data['count']=Cart::count();
        $data['total']=Cart::total();
        $data['subtotal']=Cart::subtotal();
        $data['cart_add']=Cart::content();
          
                    
         
        return redirect('/cart');
    }

    public function add_to_wishlist(Request $request,$id){
        $id=request()->route()->parameter('id');
        $user_id=domain_info('user_id');
        
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id);


     foreach (Cart::instance('saveForLater')->content() as $item)
         {

              if (Cart::instance('saveForLater')->count() > 0)

              {

                 if ( $item->id == $id) 
            {
    session()->flash('danger',__('Item is already Saved For Later!'));

              

            return back();
            }

              }

           

         }


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
             if ($request->qty)
              {
                  $qty=$request->qty ?? 1;
             }
             else
             {
                  $qty= 1;
             }
 
            $price=$price*$qty;
                    
            Cart::instance('saveForLater')->add($term->id,$term->title, $qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }
    session()->flash('success', __('Added to favourites'));
        
        return  redirect('/');
        
       // return Cart::instance('wishlist')->count();
    }


   

     public function add_wishlist(Request $request,$id){

                 

         $id=$request->id;

        $user_id=domain_info('user_id');

          $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id)->first();

           foreach (Cart::instance('saveForLater')->content() as $item)
         {

              if (Cart::instance('saveForLater')->count() > 0)

              {

                 if ( $item->id == $id) 
            {
               $success_output = '<div class="alert alert-danger">'.__('Item is already Saved For Later!').'</div>';  
                      $output = array('success'     =>  $success_output);

            return  $output;
            }

              }

           

         }
          
          if ( Session::get('option_price'.$id)) 
          { 
              $option_id=Session::get('option_price'.$id)->id;
            $option=[];
        array_push($option,$option_id);

          }


           if ( Session::get('varent_selction'.$id)) 
          { 
              $variation_id=Session::get('varent_selction'.$id)->id;
            $variation=[];
        array_push($variation,$variation_id);

          }
          


        $option=$option ?? [];
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('status',1)->where('id',$id);
        if($option != null){

             $term=$term->with('termoption',function($q) use ($option){
            if(count($option) > 0){
                return $q->whereIn('id',$option);
                }
                else{
                    return $q;
                }
            });
        }
        if(Session::get('varent_selction'.$id)){
               
          

            
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



            if($option != null){
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
 
            if(Session::get('varent_selction'.$id)){
             $attributes=$term->attributes ?? [];
             
            }
            else{
             $attributes= [];
            }
           
           
            $price=$price*$request->qty;
                  
            Cart::instance('saveForLater')->add($term->id,$term->title, $request->qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }

       $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
          $cart_content=Cart::instance('default')->content();
            $countwishlist=Cart::instance('saveForLater')->count();

            $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id)->first();
          $imgviw='<img src="'.$term->preview->media->url.'" class="img-fluid" alt="">';


    session()->flash('success', __('Added to favourites'));


     $success_output = '<div class="alert alert-success">
              '.__('Added to favourites').'
              
              </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'count'     =>  $count,
                        'total'     =>  $total,
                        'subtotal'     =>  $subtotal,
                        'cart_content'     =>  $cart_content,
                        'countwishlist'=>$countwishlist,
                        'imgviw'=>$imgviw
                    );
     
                   
                    return $output;

                

                
            
        
       
    }

        


         public function add_wishlist_home(Request $request,$id){

                 
       $id=request('id');
         $user_id=domain_info('user_id');
        
          $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id)->first();

                
                   
                   
        foreach (Cart::instance('saveForLater')->content() as $item)
         {

              if (Cart::instance('saveForLater')->count() > 0)

              {

                 if ( $item->id == $id) 
            {
               $success_output = '<div class="alert alert-danger">'.__('Item is already Saved For Later!').'</div>';  
                      $output = array('success'     =>  $success_output);

            return  $output;
            }

              }

           

         }

            
             $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id)->first();

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
        session()->flash('success', __('Added to favourites'));

       $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
          $cart_content=Cart::instance('default')->content();
            $countwishlist=Cart::instance('saveForLater')->count();

            $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id)->first();
          $imgviw='<img src="'.$term->preview->media->url.'" class="img-fluid" alt="">';


    session()->flash('success', __('Added to favourites'));


     $success_output = '<div class="alert alert-success">
              '.__('Added to favourites').'
              
              </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'count'     =>  $count,
                        'total'     =>  $total,
                        'subtotal'     =>  $subtotal,
                        'cart_content'     =>  $cart_content,
                        'countwishlist'=>$countwishlist,
                        'imgviw'=>$imgviw
                    );
     
                   
                    return $output;

                
            
        
       
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
        if (empty($code)) 
        {
             
               $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
    

           $success_output = '<div class="alert alert-danger">
            '.__("Coupon Code Not Found.").' 
           </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'count'     =>  $count,
                        'total'     =>  $total,
                        'subtotal'     =>  $subtotal
                    
                    );
                    return $output;

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

         $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
    

           $success_output = '<div class="alert alert-danger">
            '.__("Sorry, this coupon is expired").' 
           </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'count'     =>  $count,
                        'total'     =>  $total,
                        'subtotal'     =>  $subtotal
                    
                    );
     
                   
                    return $output;

        
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


    public function RemoveCartFromHome()
    {
        $id=request('id');
        if (request()->has('id'))
        {

        
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

          //  Cart::remove($id);
        $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
        $cart_add=Cart::content();
             Cart::instance('saveForLater')->content();

      

       

      


     
        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) 
        {
            $success_output = '<div class="alert alert-danger">Item is already Saved For Later!</div>';  
            $output = array('success'     =>  $success_output);
            return  $output;
        }
 
        Cart::instance('saveForLater')->add($item->id, $item->name, 1,$item->price,0,['preview'=>$item->options->preview])
            ->associate('App\Term');


                $counter=0;
             foreach (Cart::instance('saveForLater')->content() as $item1)
         {      
                
              if (Cart::instance('saveForLater')->count() > 0)

              {

                  
               $counter=$counter+1; 

            }

              }
           
       

        $countwishlist=Cart::instance('saveForLater')->count();
        $success_output = '<div class="alert alert-success">
             '.__("Item has been Saved For Later!").'
             </div>';  
        $output = array(
            'success'     =>  $success_output,
            'counter'     =>  $counter,
            'total'     =>  $total,
            'subtotal'     =>  $subtotal,
            'cart_add'     =>  $cart_add,
            'countwishlist'=>$counter
        );

            return  $output; 
    }

    public function update(Request $request)
    {
                  // return request();
             $id= $request->id ;
        Cart::instance('default')->update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        $count=Cart::count();
        $total=Cart::total();
        $subtotal=Cart::subtotal();
        $cart_add=Cart::content();
        $countwishlist=Cart::instance('saveForLater')->count();

        $success_output = '<div class="alert alert-success">
             '.__("Quantity was updated successfully!").'
             </div>';  
        $output = array(
            'success'     =>  $success_output,
            'count'     =>  $count,
            'total'     =>  $total,
            'subtotal'     =>  $subtotal,
            'cart_add'     =>  $cart_add
        );
        return  $output;
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
 
        Cart::instance('default')->add($item->id, $item->name, 1,$item->price,0,['preview'=>$item->options->preview])
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
                    <a href="'.url('/').'/product/'.$item->id.'"><img alt="" class="me-3"
                            src="'.$item->options->preview.'"></a>
                    <div class="media-body">
                        <a href="'.url('/').'/product/'.$item->id.'">
                            <h4>
                            '.$item->name .'
                            </h4>
                        </a>
                        <h4><span> '.$item->qty.' x '.$this->currency().' 
                        '.$item->price.'</span></h4>
                    </div>
                </div>
                <div class="close-circle">
                 <form action="'.url('/').'/cartdestroy" method="POST" id="dellshop">
                           
                       <span>
                           
         <input type="hidden" name="_token" value="'.csrf_token().'">
                         
                <input type="hidden" name="rowId" value="'.$item->rowId.'">
<a class="cart-options" id="RemoveCartFromHome"><span class="hidden">'.$item->rowId.'</span><i class="fa fa-times" aria-hidden="true"></i></a>
                

                            


                                            </span></form>
                            </div>
            </li>';
             
        }
        $cart_content='<ul class="show-div onhover-show-div shopping-cart">
            '.$items.'
        
            <li>
                <div class="total">
                    <h5>subtotal : <span>'.$this->currency().Cart::instance('default')->total().'</span></h5>
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
          
        if ( Session::get('option_price'.$id)) 
        { 
            $option_id=Session::get('option_price'.$id)->id;
            $option=[];
            array_push($option,$option_id);
        }

        if ( Session::get('varent_selction'.$id)) 
        { 
            $variation_id=Session::get('varent_selction'.$id)->id;
            $variation=[];
            array_push($variation,$variation_id);
        }
    
        $option=$option ?? [];
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('status',1)->where('id',$id);
        if($option != null){
            $term=$term->with('termoption',function($q) use ($option){
            if(count($option) > 0){
                return $q->whereIn('id',$option);
                }
                else{
                    return $q;
                }
            });
        }
        if(Session::get('varent_selction'.$id)){
               
          

            
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



            if($option != null){
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
 
            if(Session::get('varent_selction'.$id)){
             $attributes=$term->attributes ?? [];
             
            }
            else{
             $attributes= [];
            }
           
           
            $price=$price*$request->qty;
                  
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
                                        <a href="'.url('/').'/product/'.$item->id.'"><img alt="" class="me-3"
                                                src="'.$item->options->preview.'"></a>
                                        <div class="media-body">
                                            <a href="'.url('/').'/product/'.$item->id.'">
                                                <h4>
                                                '.$item->name .'
                                                </h4>
                                            </a>
                                            <h4><span> '.$item->qty.' x '.$this->currency().' 
                                            '.$item->price.'</span></h4>
                                        </div>
                                    </div>
                                    <div class="close-circle">
                                     <form action="'.url('/').'/cartdestroy" method="POST" id="dellshop">
                           
                       <span>
                           
          <input type="hidden" name="_token" value="'.csrf_token().'">
                         
                <input type="hidden" name="rowId" value="'.$item->rowId.'">
<a class="cart-options" id="RemoveCartFromHome"><span class="hidden">'.$item->rowId.'</span><i class="fa fa-times" aria-hidden="true"></i></a>
                

                            


                                            </span></form>
                                                </div>
                                </li>';
             
        }
        $cart_content='<ul class="show-div onhover-show-div shopping-cart">

                '.$items.'
            
                <li>
                    <div class="total">
                        <h5>subtotal : <span>'.$this->currency().' '.Cart::instance('default')->total().'</span></h5>
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
