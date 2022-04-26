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
 
 
class FrontendController extends Controller
{

    public function home(Request $request)
    {   
        $sliders = $this->get_slider();
        $categories = $this->get_menu_category();
        $services = $this->get_services();
         $employees = $this->get_employees();
        // dd( $employees[1]);
        return view(base_view() . '.home',compact(
            'sliders','categories','services','employees'
          ));
        
    }
    public function about(Request $request)
    {
        // getUserOptionWithKey('shop_name') ;
        // getUserOptionWithKey('shop_name_ar') ;
        // getUserOptionWithKey('google_map_link') ;
        // getUserOptionWithKey('about_ar') ;
        // getUserOptionWithKey('about_en') ;
        // getUserOptionWithKey('Terms_and_Conditions_ar') ;
        // getUserOptionWithKey('Terms_and_Conditions_en') ;
        // getUserOptionWithKey('Goods_Return_Policy_ar') ;
        // getUserOptionWithKey('Goods_Return_Policy_en') ;
        // getUserOptionWithKey('shop_description') ;
        // getUserOptionWithKey('shop_description_ar') ;
        // getUserOptionWithKey('shop_description_ar') ;
        // getUserOptionWithKey('store_email') ;
        // getUserOptionWithKey('local') ;
        // getUserOptionWithKey('currency') ; // json  like "{"currency_position":"left","currency_name":"EGP","currency_name_ar":"\u062c.\u0645","currency_icon":"EGP","currency_icon_ar":"\u062c.\u0645"}"
        // getUserOptionWithKey('tax') ;
        // getUserOptionWithKey('location') ; // json  like "{"company_name":null,"address":"beauty center","address_ar":"\u0628\u064a\u0648\u062a\u064a \u0633\u0646\u062a\u0631","city":null,"state":null,"zip_code":null,"email":"beauty@center.com","email_ar":"beauty@center.com","phone":"1236547892","invoice_description":null} "
        // getUserOptionWithKey('socials') ;  // json  like  "[{"icon":"fa fa-facebook","url":"facebook.com"},{"icon":"fa fa-linkedin","url":"linkedin.com"},{"icon":"fa fa-google-plus","url":"www.google-plus.com"},{"icon":"fa fa-instagram","url":"www.instagram.com"},{"icon":"fa fa-twitter","url":"www.twitter.com"}] "
         $employees = $this->get_employees();
        
        return view(base_view() . '.about-us',compact('employees'));
    }

    public function team(Request $request)
    {
         
         $employees = $this->get_employees();
        
        return view(base_view() . '.team',compact('employees'));
    }
    public function contact(Request $request)
    {
        return view(base_view() . '.contact');
    }
    public function cart(Request $request)
    {
        return view(base_view() . '.cart');
    }
 
    
    public function make_local(Request $request)
    {
         Session::put('locale', $request->lang);
        \App::setlocale($request->lang);
        return redirect()->back();
    }

    public function get_slider()
    {
        $user_id = domain_info('user_id');
        return Category::where('type', 'slider')->with('excerpt')->where('user_id', $user_id)
            ->latest()
            ->get()
            ->map(function ($q) {
                // dd($q->appends);
                $data['slider'] = $q->name;
                $data['url'] = $q->slug;
                $data['meta'] = $q->excerpt->content ?? '';

                return $data;
            });
    }

    public function get_menu_category()
    {
        $user_id = domain_info('user_id');
        // return $data = Category::where('type', 'category')->where('user_id', $user_id)->where('menu_status', 1)->get()->map(function ($q) {
        return $data = Category::where('type', 'category')->where('user_id', $user_id)->get() ;
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

    public function get_employees()
    {
        $user_id = domain_info('user_id');
         if (Session('branch')) 
        {
                            $branche_id=Session('branch');
                             $employees = User::where('branche_id',$branche_id)->where('user_id',$user_id)->get();

        }
        else
        {
          $employees = User::where('user_id',$user_id)->get();

        }

       
        return $employees;

    }

    public function branch( )
    {
          $branch=request('id');

          if ($branch == 'all')
           {
               Session::forget('branch');
                      session()->put('all','all');


           }
          else
          {
            session()->put('branch',$branch);
           $branch=Session::get('branch');
               Session::forget('all');

          }
    
       
          $output = array(
                        'success'     => 'success',
                        
                    );
     
                   
                    return $output;
    }
    
}
