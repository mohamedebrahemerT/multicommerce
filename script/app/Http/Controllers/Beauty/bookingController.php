<?php

namespace App\Http\Controllers\Beauty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Term;
use App\Category;
use App\Attribute;
use App\Getway;
use App\Models\Review;
use Cache;
use Session;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Useroption;
use URL;
use App\Option;
use App\Plan;
use App\Postcategory;
use App\Models\Termoption;
use App\Models\User;
use Cart;
 
 
class bookingController extends Controller
{

    public function index(Request $request)
    {   
        if (Cart::instance('default')->count() == 0) 
            {
            return redirect('/');
             }
         
                     return view( base_view() . '.booking');
        
    }

    public function checkout(Request $request)
    {   
         
                     return view( base_view() . '.checkout');
        
    }

     public function Add_Time(Request $request)
    {   
         
                     $month= request('month');
                     $day= request('day');
                     $time= request('time');

                     Session::put('month', $month);
                     Session::put('day', $day);
                     Session::put('time', $time);
                     
                     Session::get('month');
                     Session::get('day');
                     Session::get('time');

                     return redirect('checkout');


        
    }

    public function Book_now ($id,Request $request)
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
                  
            Cart::add($term->id,$term->title,1,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }
        
                     return redirect('beauty/booking');
        
    }
     
    
}
