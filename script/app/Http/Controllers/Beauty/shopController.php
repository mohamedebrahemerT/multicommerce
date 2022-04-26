<?php

namespace App\Http\Controllers\Beauty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Term;
 
 
 
class shopController extends Controller
{

    public function shop(Request $request)
    {   
        $services = $this->get_services();
         
                     return view( base_view() . '.shop',compact('services'));
        
    }

    public function get_services()
    {
        $user_id = domain_info('user_id');
          if (Session('branch')) 
        {
              $branche_id=Session('branch');
            $services = Term::where('branche_id',$branche_id)->where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->get(); 
        }
        else
        {
$services = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->get();
        }
        return $services;

    }

    
     
    
}
