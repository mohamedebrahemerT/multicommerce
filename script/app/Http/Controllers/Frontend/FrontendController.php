<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Term;
use App\Category;
use App\Attribute;
use App\Getway;
use App\Models\Review;
use App\Models\Price;

use Cache;
use Illuminate\Support\Facades\Session;
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
use App\Models\Useraddresses;

use App\Models\User;
use App\Order;
use App\Domain;

use Cart;
use DB;
use Auth;
 
 
class FrontendController extends Controller
{

    public $cats;
    public $attrs;
    
    

    public function make_local(Request $request)
    {
        Session::put('locale', $request->lang);
        \App::setlocale($request->lang);
        return redirect()->back();
    }

    public function index(Request $request)
    { 
       
                $user_id=domain_info('user_id');
               $Domain=Domain::where('user_id',$user_id)->first();
               if ($Domain->status != 1) 
               {
              
                   return  view('expired',compact('Domain'));
               }
                
                
                  
                     


        $url = $request->getHost();
        $url = str_replace('www.', '', $url);
    
        if (url('/') == env('APP_URL') || $url == 'localhost') 
        {
            $seo = Option::where('key', 'seo')->first();
            $seo = json_decode($seo->value);

            JsonLdMulti::setTitle($seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/logo.png'));

            SEOMeta::setTitle($seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle($seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
            SEOTools::twitter()->setTitle($seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));


            $latest_gallery = Category::where('type', 'gallery')->with('preview')->where('is_admin', 1)->latest()->take(15)->get();
            $features = Category::where('type', 'features')->with('preview', 'excerpt')->where('is_admin', 1)->latest()->get();

            $testimonials = Category::where('type', 'testimonial')->with('excerpt')->where('is_admin', 1)->latest()->get();

            $brands = Category::where('type', 'brand')->with('preview')->where('is_admin', 1)->latest()->get();

            $plans = Plan::where('status', 1)->get();
            $header = Option::where('key', 'header')->first();
            $header = json_decode($header->value ?? '');

            $about_1 = Option::where('key', 'about_1')->first();
            $about_1 = json_decode($about_1->value ?? '');

            $about_2 = Option::where('key', 'about_2')->first();
            $about_2 = json_decode($about_2->value ?? '');

            $about_3 = Option::where('key', 'about_3')->first();
            $about_3 = json_decode($about_3->value ?? '');

            $ecom_features = Option::where('key', 'ecom_features')->first();
            $ecom_features = json_decode($ecom_features->value ?? '');

            $counter_area = Option::where('key', 'counter_area')->first();
            $counter_area = json_decode($counter_area->value ?? '');

            return view('welcome', compact('latest_gallery', 'plans', 'features', 'header', 'about_1', 'about_3', 'about_2', 'testimonials', 'brands', 'ecom_features', 'counter_area'));
        }
        
        if ($url == env('APP_PROTOCOLESS_URL')) {

            return redirect('/check');
        }

        if (Cache::has(domain_info('user_id') . 'seo')) 
        {
             $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
             $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
             $seo = json_decode($data->value ?? '');
        }
        JsonLdMulti::setTitle($seo->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

        SEOMeta::setTitle($seo->title ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->title ?? env('APP_NAME'));
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::setCanonical($seo->canonical ?? url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
        SEOTools::twitter()->setTitle($seo->title ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
        SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
   
         $latest_products = $this->get_latest_products();
        $random_products = $this->get_random_products();
        $trending_products = $this->get_trending_products();
        $best_selling_product = $this->get_best_selling_product();
        $sliders = $this->get_slider();
        $menu_category = $this->get_menu_category();

        $user = User::find(domain_info('user_id'));

        if($user && $user->shop_type == 4)
        {     

             $sliders = $this->get_slider();
        $categories = $this->get_menu_category();
        $services = $this->get_services();
         $employees = $this->get_employees();
        // dd( $employees[1]);
        return view(base_view() . '.home',compact(
            'sliders','categories','services','employees'
          ));
            //return redirect()->route('beauty.home');
        }
        // dd($sliders);

 
    
    
        return view(base_view() . '.home',compact(
          'latest_products',
          'random_products',
          'trending_products',
          'best_selling_product',
          'menu_category',
          'sliders'
        ));
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

    public function more()
    {
        $more=Request('more');

        if ($more =='trending_products') 
        {
   $trending_products = $this->get_trending_products();
   return view(base_view() . '.more.'.$more,compact('trending_products'));
            
        }
        elseif ($more =='Available_Offer') 
        {
             $random_products = $this->get_random_products();
             return view(base_view() . '.more.'.$more,compact('random_products'));
        }
        
        elseif ($more =='best_selling_product') 
        {
              $best_selling_product = $this->get_best_selling_product();
             return view(base_view() . '.more.'.$more,compact('best_selling_product'));
        }

        elseif ($more =='New_arrival_products') 
        {
         $latest_products = $this->get_latest_products();
             return view(base_view() . '.more.'.$more,compact('latest_products'));
        }

    }

    public function page()
    {
        $id = request()->route()->parameter('id');
        $info = Term::where('user_id', domain_info('user_id'))->where('type', 'page')->with('excerpt', 'content')->findorFail($id);
        JsonLdMulti::setTitle($info->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($info->excerpt->value ?? null);
        JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

        SEOMeta::setTitle($info->title ?? env('APP_NAME'));
        SEOMeta::setDescription($info->excerpt->value ?? null);

        SEOTools::setTitle($info->title ?? env('APP_NAME'));
        SEOTools::setDescription($info->excerpt->value ?? null);
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
        SEOTools::twitter()->setTitle($info->title ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($info->title ?? null);
        SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));


        return view(base_view() . '.page', compact('info'));
    }

    public function sitemap()
    {
        if (!file_exists('uploads/' . domain_info('user_id') . '/sitemap.xml')) {
            abort(404);
        }
        return response(file_get_contents('uploads/' . domain_info('user_id') . '/sitemap.xml'), 200, [
            'Content-Type' => 'application/xml'
        ]);
    }


    public function shop(Request $request)
    {
        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Shop - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Shop - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Shop - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Shop - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }


        $src = $request->src ?? null;
        return view(base_view() . '.shop', compact('src'));
    }

    public function cart()
    {
                
          
        \Cart::setGlobalTax(tax());
        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Cart - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Cart - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Cart - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Cart - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }

        return view(base_view() . '.cart');
    }

    public function wishlist()
    {
        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Wishlist - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Wishlist - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Wishlist - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Wishlist - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }


        return view(base_view() . '.wishlist');
    }

    public function thanks()
    {
        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Thank you - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Thank you - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Thank you - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Thank you - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }
        return view(base_view() . '.thanks');
    }

    public function checkout()
    {

           if (Auth::check() )
            {
               
         $Useraddressescount= Useraddresses::where('user_id',auth()->user()->id)->count();
                if ($Useraddressescount == 0)
                 {
    session()->flash('danger', __('You have to add your address'));

            return redirect('/user/addresses');
                    
                }
           }
        
         if (Cart::instance('default')->count() == 0) 
            {
            return redirect('/');
             }
        \Cart::setGlobalTax(tax());


        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Checkout - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }

        $shop_type = domain_info('shop_type');

        if ($shop_type == 1) {
            $locations = Cache::remember(domain_info('user_id') . 'locations', 200, function () {
                $user_id = domain_info('user_id');
                return Category::where('user_id', $user_id)->where('type', 'city')->with('child_relation')->get();
            });
        } else {
            $locations = [];
        }


        $getways = Cache::remember(domain_info('user_id') . 'getwayes', 200, function () {
            $user_id = domain_info('user_id');
            return Getway::where('user_id', $user_id)->where('status', 1)->get();
        });

        return view(base_view() . '.checkout', compact('locations', 'getways'));
    }

    public function wishlist_remove()
    {
        $id = request()->route()->parameter('id');
    }

    public function detail($slug, $id)
    {
        $locale = app()->getLocale();
        $id = request()->route()->parameter('id');
        $user_id = domain_info('user_id');


         $info = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->with('medias', 'content', 'categories', 'brands', 'seo', 'price', 'options', 'stock')->findorFail($id);

        $next = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->where('id', '>', $id)->first();
        $previous = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->where('id', '<', $id)->first();
//dd($info->options);
        $variations = collect($info->attributes)->groupBy(function ($q) {

            return $q->attribute->name;
            //return json_decode($q->attribute->name)->ar;
        });
        //dd($variations);


        $content = json_decode($info->content->value);
        $seo = $info->seo->value ?? '';


//        SEOMeta::setTitle($seo->meta_title->ar ?? $info->title);
//        SEOMeta::setDescription($seo->meta_description->ar ?? $content->excerpt->ar ?? null);
//        SEOMeta::addMeta('article:published_time', $info->updated_at->format('Y-m-d'), 'property');
//        SEOMeta::addKeyword([$seo->meta_keyword->ar ?? null ]);
        ///-------
        SEOMeta::setTitle($seo['meta_title'][$locale] ?? $info->title);
        SEOMeta::setDescription($seo['meta_description'][$locale] ?? $content->excerpt->$locale ?? null);
        SEOMeta::addMeta('article:published_time', $info->updated_at->format('Y-m-d'), 'property');
        SEOMeta::addKeyword([$seo['meta_keyword'][$locale] ?? null]);
        /// -----------

        OpenGraph::setDescription($seo['meta_description'][$locale] ?? $content->excerpt->$locale ?? null);
        OpenGraph::setTitle($seo['meta_title'][$locale] ?? $info->title);
        OpenGraph::addProperty('type', 'product');

        foreach ($info->medias as $row) {
            OpenGraph::addImage(asset($row->url));
            JsonLdMulti::addImage(asset($row->url));
            JsonLd::addImage(asset($row->url));
        }


        JsonLd::setTitle($seo['meta_title'][$locale] ?? $info->title);
        JsonLd::setDescription($seo['meta_description'][$locale] ?? $content->excerpt->$locale ?? null);
        JsonLd::setType('Product');

        JsonLdMulti::setTitle($seo['meta_title'][$locale] ?? $info->title);
        JsonLdMulti::setDescription($seo['meta_description'][$locale] ?? $content->excerpt->$locale ?? null);
        JsonLdMulti::setType('Product');

  $RelatedProducts = $this->get_random_products();
        return view(base_view() . '.details', compact('info', 'next', 'previous', 'variations', 'content','RelatedProducts'));
    }



    

    public function category($id)
    {

                    /*if (Request('FliterType')) 
                    {
                         return Request();
                    }*/
           $id= request('id');
        
        $id = request()->route()->parameter('id');
        $user_id = domain_info('user_id');

$test = Category::where('id',$id)->where('user_id', $user_id)->first();
              
            if (empty($test)) {
            abort(404);
        }


         if (request('b')) 
         {
               

     $info = Category::where('id',$id)->where('user_id', $user_id)->where('type', 'brand')->with('preview','take_20_product')->first();
  
         }
         else
         {

              $info = Category::where('id',$id)->where('user_id', $user_id)->with('preview','take_20_product')->first();

         }

           if (request('cc')) 
         {
           $cc=request('cc');
         $attributes=Attribute::where('variation_id',request('cc'))->get();

         

    $cats_ids=[];
   foreach ($attributes as $key => $Postcat) 
   {
    
         array_push($cats_ids,$Postcat->term_id);
   }
          

            $products = Term::where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
                 -> whereIn('id',$cats_ids)
           ->withCount('reviews')->inRandomOrder()->paginate(6);
 
        

        return view(base_view() . '.shop', compact('info','products','cc'));
             
         }
    
       
   
   
   $Postcategory=Postcategory::where('category_id',$info->id)->get();

 

    $cats_ids=[];
   foreach ($Postcategory as $key => $Postcat) 
   {
    
         array_push($cats_ids,$Postcat->term_id);
   }
          

           $products = Term::where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
                 -> whereIn('id',$cats_ids)
           ->withCount('reviews')->inRandomOrder()->paginate(6);
 
        

        return view(base_view() . '.shop', compact('info','products'));
    }


    public function home_page_products(Request $request)
    {
        if ($request->latest_product) {
            if ($request->latest_product == 1) {
                $data['get_latest_products'] = $this->get_latest_products();
            } else {
                $data['get_latest_products'] = $this->get_latest_products($request->latest_product);
            }
        }

        if ($request->random_product) {
            if ($request->random_product == 1) {
                $data['get_random_products'] = $this->get_random_products();
            } else {
                $data['get_random_products'] = $this->get_random_products($request->random_product);
            }

        }
        if ($request->get_offerable_products) {
            if ($request->get_offerable_products == 1) {
                $data['get_offerable_products'] = $this->get_offerable_products();
            } else {
                $data['get_offerable_products'] = $this->get_offerable_products($request->random_product);
            }

        }

        if ($request->trending_products) {
            if ($request->trending_products == 1) {
                $data['get_trending_products'] = $this->get_trending_products();
            } else {
                $data['get_trending_products'] = $this->get_trending_products($request->trending_products);
            }

        }

        if ($request->best_selling_product) {
            if ($request->best_selling_product == 1) {
                $data['get_best_selling_product'] = $this->get_best_selling_product();
            } else {
                $data['get_best_selling_product'] = $this->get_best_selling_product($request->best_selling_product);
            }
        }

        if ($request->sliders) {
            $data['sliders'] = $this->get_slider();
        }

        if ($request->menu_category) {
            $data['get_menu_category'] = $this->get_menu_category();
        }

        if ($request->bump_adds) {
            $data['bump_adds'] = $this->get_bump_adds();
        }

        if ($request->banner_adds) {
            $data['banner_adds'] = $this->get_banner_adds();
        }

        if ($request->featured_category) {
            $data['featured_category'] = $this->get_featured_category();
        }

        if ($request->featured_brand) {
            $data['featured_brand'] = $this->get_featured_brand();
        }

        if ($request->category_with_product) {
            $data['category_with_product'] = $this->get_category_with_product();
        }

        if ($request->brand_with_product) {
            $data['brand_with_product'] = $this->get_brand_with_product();
        }


        return response()->json($data);

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
        return $data = Category::where('type', 'category')->where('user_id', $user_id)->where('menu_status', 1)->get()->map(function ($q) {
            $data['id'] = $q->id;
            $data['name'] = $q->name;
            $data['slug'] = $q->slug;
            return $data;
        });
    }


    public function brand($id)
    {
        $id = request()->route()->parameter('id');
        $user_id = domain_info('user_id');
        $info = Category::where('user_id', $user_id)->where('type', 'brand')->with('preview')->findorFail($id);

        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }

        JsonLdMulti::setTitle($info->name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset($info->preview->content ?? 'uploads/' . domain_info('user_id') . '/logo.png'));

        SEOMeta::setTitle($info->name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($info->name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset($info->preview->content ?? 'uploads/' . domain_info('user_id') . '/logo.png'));
        SEOTools::twitter()->setTitle($info->name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($info->name ?? null);
        SEOTools::jsonLd()->addImage(asset($info->preview->content ?? 'uploads/' . domain_info('user_id') . '/logo.png'));

        return view(base_view() . '.shop', compact('info'));

    }

    public function get_featured_attributes()
    {
        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'parent_attribute')->where('featured', 1)->with('featured_child_with_post_count_attribute')->get();

        return $posts;
    }

    public function get_ralated_product_with_latest_post(Request $request)
    {
        $user_id = domain_info('user_id');

        $this->cats = $request->categories ?? [];
        $avg = Review::where('term_id', $request->term)->avg('rating');
        $ratting_count = Review::where('term_id', $request->term)->count();
        $avg = (int)$avg;
        $related = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->whereHas('post_categories', function ($q) {
            $q->whereIn('category_id', $this->cats);
        })->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->take(20)->get();

        $get_latest_products = $this->get_latest_products();
        $data['get_latest_products'] = $get_latest_products;
        $data['get_related_products'] = $related;
        $data['ratting_count'] = $ratting_count;
        $data['ratting_avg'] = $avg;

        return response()->json($data);
    }

    public function get_reviews($id)
    {
        $user_id = domain_info('user_id');
        $id = request()->route()->parameter('id');
        $reviews = Review::where('term_id', $id)->where('user_id', $user_id)->latest()->paginate(12);
        $data = [];
        foreach ($reviews as $review) {
            $dta['rating'] = $review->rating;
            $dta['name'] = $review->name;
            $dta['comment'] = $review->comment;
            $dta['created_at'] = $review->created_at->diffForHumans();
            array_push($data, $dta);
        }
        $revi['data'] = $data;
        $revi['links'] = $reviews;

        return response()->json($revi);
    }


    public function get_ralated_products(Request $request)
    {
        $user_id = domain_info('user_id');

        $this->cats = $request->cats;

        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->whereHas('post_categories', function ($q) {
            $q->whereIn('category_id', $this->cats);
        })->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->latest()->paginate(30);

        return response()->json($posts);
    }

    public function product_search(Request $request)
    {
        $user_id = domain_info('user_id');


          if (app()->getLocale() == 'ar') 
          {
                 $products = Term::
           where('title->ar','LIKE', '%' . $request->src . '%')
              ->where('user_id', $user_id)
              ->where('type', 'product')
              ->where('status', 1)
           ->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->latest()->paginate(30);  
          }
          else
          {
     $products = Term::
           Where('title->en','LIKE', '%' . $request->src . '%')
              ->where('user_id', $user_id)
              ->where('type', 'product')
              ->where('status', 1)
              

           ->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->latest()->paginate(30);  
          }

           
     

       // return response()->json($posts);

         $search=$request->src;

  return view(base_view().'.'.'search',compact('products','search'));


    }

    public function get_featured_category()
    {
        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'category')->with('preview')->where('featured', 1)->latest()->get()->map(function ($q) {
            $data['id'] = $q->id;
            $data['name'] = $q->name;
            $data['slug'] = $q->slug;
            $data['type'] = $q->type;
            $data['preview'] = asset($q->preview->content ?? 'uploads/default.png');
            return $data;
        });

        return $posts;
    }

    public function get_featured_brand()
    {
        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'brand')->with('preview')->where('featured', 1)->latest()->get()->map(function ($q) {
            $data['id'] = $q->id;
            $data['name'] = $q->name;
            $data['slug'] = $q->slug;
            $data['type'] = $q->type;
            $data['preview'] = asset($q->preview->content ?? 'uploads/default.png');
            return $data;
        });
        return $posts;
    }

    public function get_category()
    {
        $user_id = domain_info('user_id');
        return $posts = Category::where('user_id', $user_id)->where('type', 'category')->withCount('posts')->latest()->get();


    }

    public function get_brand()
    {
        $user_id = domain_info('user_id');
        return $posts = Category::where('user_id', $user_id)->where('type', 'brand')->withCount('posts')->latest()->get();


    }

    public function get_products(Request $request)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->paginate(30);
        return response()->json($posts);
    }

    public function get_offerable_products($limit = 20)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->whereHas('price', function ($q) {
            return $q->where('ending_date', '>=', date('Y-m-d'))->where('starting_date', '<=', date('Y-m-d'));
        })->withCount('reviews')->inRandomOrder()->take(20)->get();
        return $posts;
    }


    public function get_latest_products($limit = 20)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()
        ->take($limit)
        ->get();
                 
        return $posts;

    }

    public function max_price()
    {
        $user_id = domain_info('user_id');
        return Attribute::where('user_id', $user_id)->max('price');

    }

    public function min_price()
    {
        $user_id = domain_info('user_id');
        return Attribute::where('user_id', $user_id)->min('price');

    }

    public function get_bump_adds()
    {
        $user_id = domain_info('user_id');
        return Category::where('user_id', $user_id)->where('type', 'offer_ads')->latest()->get()->map(function ($q) {
            $data['image'] = asset($q->name);
            $data['url'] = $q->slug;
            return $data;
        });

    }

    public function get_banner_adds()
    {
        $user_id = domain_info('user_id');
        return Category::where('user_id', $user_id)->where('type', 'banner_ads')->get()->map(function ($q) {
            $data['image'] = asset($q->name);
            $data['url'] = $q->slug;
            return $data;
        });
    }

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


    public function get_shop_attributes()
    {
        $data['categories'] = $this->get_category();
        $data['brands'] = $this->get_brand();
        $data['attributes'] = $this->get_featured_attributes();
        return $data;
    }


    public function get_shop_products(Request $request)
    {  //return request();

        if ($request->order == 'DESC' || $request->order == 'ASC') {
            $order = $request->order;
        } else {
            $order = 'DESC';
        }
        if ($request->order == 'bast_sell') {
            $featured = 2;
        } elseif ($request->order == 'trending') {
            $featured = 1;
        } else {
            $featured = 0;
        }

        $user_id = domain_info('user_id');
        $this->attrs = $request->attrs ?? [];
        $this->cats = $request->categories ?? [];
         $this->brands = $request->brands ?? [];

        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews');

        if (!empty($request->term)) {
            $data = $posts->where('title', 'LIKE', '%' . $request->term . '%');
        }

        if (count($this->attrs) > 0) {
             $data = $posts->whereHas('attributes_relation', function ($q) {
                return $q->whereIn('variation_id', $this->attrs);
            });
        }

        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
            $data = $posts->whereHas('price', function ($q) use ($min_price) {
                return $q->where('price', '>=', $min_price);
            });

        }

        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
            $data = $posts->whereHas('price', function ($q) use ($max_price) {
                return $q->where('price', '<=', $max_price);
            });
        }

        if (count($this->cats) > 0) {
             $data = $posts->whereHas('post_categories', function ($q) {
                return $q->whereIn('category_id', $this->cats);
            });
        }

         if (count($this->brands) > 0) 
         {  
                     $cc=$this->brands;
          $attributes=Attribute::whereIn('variation_id',$cc)->get();

         

    $cats_ids=[];
   foreach ($attributes as $key => $Postcat) 
   {
    
         array_push($cats_ids,$Postcat->term_id);
   }
          

            $data = Term::where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
                 -> whereIn('id',$cats_ids)
           ->withCount('reviews')->inRandomOrder()->paginate(6);
        }

        if ($featured != 0) {
            $data = $posts->orderBy('featured', 'DESC');
        } else {
            $data = $posts->orderBy('id', $order);
        }

        $data = $data ?? $posts;
        $data = $data->paginate($request->limit ?? 18);

        $subdata='';

        foreach ($data as $key => $product) 
        {

             $subdata.='    <div class="col-xl-4 col-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="'.url('/').''.'/product/'.$product->slug.'/'.$product->id.'">
                                        <img class="pic-1" src="'.$product->preview->media->url .'">
                                        <img class="pic-2" src="'.$product->preview->media->url .'">
                                    </a>
                                    <ul class="social">
                                        <li><a href="" data-tip="'.('Quick View').'"  id="QuickView"><i class="ti-eye"></i>
                                        </a></li>
                                        <span class="hidden">'. $product->id.'</span>
                                        <li><a href="" data-tip="'.('Add to Wishlist').'"><i class="ti-heart"></i></a></li>
                                        <li><a href="" data-tip="'.('Add to Wishlist').'"><i class="ti-shopping-cart"></i></a></li>
                                    </ul>
                                    <span class="product-new-label">'.__('Sale').'</span>
                                    <span class="product-discount-label">
                    '.$product->price->special_price.'
                                    </span>
                                </div>
                                <ul class="rating">
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star disable"></li>
                                </ul>
                                <div class="product-content">
                                    <h3 class="title"><a href="'.url('/').''.'/product/'.$product->slug.'/'.$product->id.'">
                                            '.$product->title.'
                                    </a></h3>
                                    <div class="price">
                                   '.$product->price->regular_price.'
                                        <span> '.$product->price->price.' '.$this->currency().'</span>
                                    </div>
                                    <a class="add-to-cart" href="'.url('/').''.'/product/'.$product->slug.'/'.$product->id.'">'.__('Add To Cart').'</a>
                                </div>
                            </div>
                        </div>';
           
        }

               

           $data=' <div class="row my-5 product-page">  

                  '.$subdata.'
            </div>';
      
      //   return  $data;

           
                      $output = array(
                        'success'     =>  $data,
                    );

            return  $output;

        return response()->json($data);

    }


     public function get_shop_products_my_range_price(Request $request)
    {  
        $user_id = domain_info('user_id');

           $Terms = Term::
             where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')->get();

           $Terms_ids=[];
   foreach ($Terms as $key => $Term) 
   {
    
         array_push($Terms_ids,$Term->id);
   }

       $Postcategors=Postcategory::
     where('category_id',Request('cat_id'))->
     whereIn('term_id',$Terms_ids)
     ->get();

      $PostcategorsTerms_ids=[];
   foreach ($Postcategors as $key => $Postcategy) 
   {
    
         array_push($PostcategorsTerms_ids,$Postcategy->term_id);
   }

      

     $min_price=0;
         $max_price=request('my_range');
         
            $Prices=Price::
            where('regular_price','<=',$max_price)->
          
         whereIn('term_id',$PostcategorsTerms_ids)
             ->get();

             $PricesTerms_ids=[];
   foreach ($Prices as $key => $Pric) 
   {
    
         array_push($PricesTerms_ids,$Pric->term_id);
   }

          

           $data = Term::
           where('status', 1)->where('type', 'product')->
           whereIn('id', $PricesTerms_ids)
          ->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
                 
           ->withCount('reviews')->inRandomOrder()->paginate(6);

        
    /* $Postcategory=Postcategory::where('category_id',Request('cat_id'))->get();

       $Terms_ids=[];
   foreach ($Postcategory as $key => $Postcat) 
   {
    
         array_push($Terms_ids,$Postcat->term_id);
   }

        $min_price=0;
       // $max_price=request('my_range');
        $max_price=100;
           $Prices=Price::where('regular_price','<=',$max_price)
          ->orwhere('price','<=',$max_price)
         ->whereIn('term_id',$Terms_ids)
             ->get();


              $Price_trmes_ids=[];
   foreach ($Prices as $key => $Price_trm) 
   {
    
         array_push($Price_trmes_ids,$Price_trm->term_id);
   }
       $Price_trmes_ids;
         
        $user_id = domain_info('user_id');
              

              $data = Term::
            whereIn('id', $Price_trmes_ids)
            -> where('user_id', $user_id)
          ->where('status', 1)->where('type', 'product')
          ->with('preview', 'attributes', 'category', 'price', 'options', 'stock','category')
                 
           ->withCount('reviews')->inRandomOrder()->paginate(6);
       
                */


   /*

$user_id = domain_info('user_id');
   $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews');

   if (!empty($request->min_price)) {
            $min_price = $request->min_price;
            $data = $posts->whereHas('price', function ($q) use ($min_price) {
                return $q->where('price', '>=', $min_price);
            });

        }

        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
            $data = $posts->whereHas('price', function ($q) use ($max_price) {
                return $q->where('price', '<=', $max_price);
            });
        }
         
            */
        $subdata='';

        

        foreach ($data as $key => $product) 
        {

             $subdata.='    <div class="col-xl-4 col-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="'.url('/').''.'/product/'.$product->slug.'/'.$product->id.'">
                                        <img class="pic-1" src="'.$product->preview->media->url .'">
                                        <img class="pic-2" src="'.$product->preview->media->url .'">
                                    </a>
                                    <ul class="social">
                                        <li><a href="" data-tip="'.('Quick View').'"  id="QuickView"><i class="ti-eye"></i>
                                        </a></li>
                                        <span class="hidden">'. $product->id.'</span>
                                        <li><a href="" data-tip="'.('Add to Wishlist').'"><i class="ti-heart"></i></a></li>
                                        <li><a href="" data-tip="'.('Add to Wishlist').'"><i class="ti-shopping-cart"></i></a></li>
                                    </ul>
                                    <span class="product-new-label">'.__('Sale').'</span>
                                    <span class="product-discount-label">
                    '.$product->price->special_price.'
                                    </span>
                                </div>
                                <ul class="rating">
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star disable"></li>
                                </ul>
                                <div class="product-content">
                                    <h3 class="title"><a href="'.url('/').''.'/product/'.$product->slug.'/'.$product->id.'">
                                            '.$product->title.'
                                    </a></h3>
                                    <div class="price">
                                   '.$product->price->regular_price.'
                                        <span> '.$product->price->price.' '.$this->currency().'</span>
                                    </div>
                                    <a class="add-to-cart" href="'.url('/').''.'/product/'.$product->slug.'/'.$product->id.'">'.__('Add To Cart').'</a>
                                </div>
                            </div>
                        </div>';
           
        }

               

           $data=' <div class="row my-5 product-page">  

                  '.$subdata.'
            </div>';
      
      //   return  $data;

           
                      $output = array(
                        'success'     =>  $data,
                    );

            return  $output;

        return response()->json($data);

    }

    public function get_random_products($limit = 20)
    {
        $limit = request()->route()->parameter('limit') ?? 20;
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->inRandomOrder()->take($limit)->get();
        return $posts;
    }

    public function get_trending_products($limit = 20)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->where('featured', 1)->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->take($limit)->get();
        return $posts;
    }

    public function get_best_selling_product($limit = 20)
    {
        $user_id = domain_info('user_id');
        $posts = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->where('featured', 2)->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->take($limit)->get();
        return $posts;
    }

    public function get_category_with_product($limit = 10)
    {
        $limit = request()->route()->parameter('limit');
        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'category')->with('take_20_product')->take($limit)->get();

        return $posts;
    }

    public function get_brand_with_product($limit = 10)
    {

        $limit = request()->route()->parameter('limit');

        $user_id = domain_info('user_id');
        $posts = Category::where('user_id', $user_id)->where('type', 'brand')->with('take_20_product')->take($limit)->get();

        return $posts;
    }

    public function contact()
    {
        $seo = Option::where('key', 'seo')->first();
        $seo = json_decode($seo->value);

        JsonLdMulti::setTitle('Contact Us');
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/logo.png'));

        SEOMeta::setTitle('Contact Us');
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle('Contact Us');
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::setCanonical($seo->canonical ?? url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
        SEOTools::twitter()->setTitle('Contact Us');
        SEOTools::twitter()->setSite('Contact Us');
        SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));
        return view(base_view().'.'.'contact');
    }

    public function offers()
    {
        $seo = Option::where('key', 'seo')->first();
        $seo = json_decode($seo->value);

        JsonLdMulti::setTitle('offers');
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/logo.png'));

        SEOMeta::setTitle('offers');
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle('offers');
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::setCanonical($seo->canonical ?? url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
        SEOTools::twitter()->setTitle('offers');
        SEOTools::twitter()->setSite('offers');
        SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));
        $user_id = domain_info('user_id');

          $latest_products = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')->latest()->Paginate(5);

        return view(base_view().'.'.'offers',compact('latest_products'));
    }


    public function search()
    {   
        $seo = Option::where('key', 'seo')->first();
        $seo = json_decode($seo->value);

        JsonLdMulti::setTitle('search');
        JsonLdMulti::setDescription($seo->description ?? null);
        JsonLdMulti::addImage(asset('uploads/logo.png'));

        SEOMeta::setTitle('search');
        SEOMeta::setDescription($seo->description ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle('search');
        SEOTools::setDescription($seo->description ?? null);
        SEOTools::setCanonical($seo->canonical ?? url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
        SEOTools::twitter()->setTitle('search');
        SEOTools::twitter()->setSite('search');
        SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));
        $user_id = domain_info('user_id');
  
   $search=request('search');
         $products = Term::where('user_id', $user_id)->where('status', 1)->where('type', 'product')->with('preview', 'attributes', 'category', 'price', 'options', 'stock')->withCount('reviews')
      // ->where('title','LIKE','%'.$search.'%')
  
        ->paginate(6);
        
        return view(base_view().'.'.'search',compact('products','search'));
    }

    public function QuickView( )
    {
      
        $id = request('id');
        $user_id = domain_info('user_id');


          $info = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->with('medias', 'content', 'categories', 'brands', 'seo', 'price', 'options', 'stock','preview')->findorFail($id);

       
 
        $variations = collect($info->attributes)->groupBy(function ($q) {
            return $q->attribute->name;
            //return json_decode($q->attribute->name)->ar;
        });
       
       $exampleModal_price_detail='
 <h3 class="price-detail">
 '.$info->price->price.'
 <del>
  '.$info->price->regular_price.'
 </del>
 <span>

 '.$info->price->special_price.'  

 '.__('off') .' 
 </span>

 </h3>
       ';
 $items='';
         foreach(Termoption::where('p_id','!=',null)->where('term_id',$info->id)->get() as $option )
         {
              
            $items.='<li class="bg-light1"></li>'.$option->name.'';
                                   
         }

          $color_variant=' <ul class="color-variant">
          '.$items.'                          
             </ul>';
 $content = json_decode($info->content->value);
        $seo = $info->seo->value ?? '';

   if(Session::get('locale') == 'ar')
   {
     $content= $content->content->ar;
   }
       
     else
     {
$content=  $content->content->en;

     }
          $url=url('/');

      $cart= $url.'/addtocart?id='.$info->id.'&&qty=1';

       $wishlist=url('/').'/add_to_wishlist/'.$info->id;
     

      $productbuttons=' <div class="product-buttons">
                            <a href="'.$cart.'"   class="btn btn-solid hover-solid" id="cartEffect">
                                <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i>
                               '. __('add to cart') .' 
                            </a>

                            <a href="'.$wishlist.'"   class="btn btn-solid hover-solid" id="cartEffect"><i class="fa fa-bookmark fz-16 me-2"
                                    aria-hidden="true"></i>
                               '. __('wishlist') .' 
                            </a>
                            
    
                             </form>
                        </div>';

  $cats_ids=[];
 foreach(Attribute::where('term_id',$info->id)->groupBy('category_id')->get() as $category )
        {
           array_push($cats_ids,$category->category_id);
        }
      $sizebox='';
           $sizebox_item='';
 
      foreach(Attribute::whereIn('category_id',$cats_ids)->where('term_id',$info->id)->get() as $variation ) 
        {

      $sizebox_item.='<li  ><a href="javascript:void(0)">'.$variation->variation->name.'</a></li>';
        }

         $sizebox.='<div class="size-box">
                                        <ul>
        
                         '.$sizebox_item.'
           
             
                                           
                                        </ul>
                                    </div>';
   
       


    $view_img=asset($info->preview->media->url ?? 'uploads/default.png'); 
        $quick_view_img='<img src="'.$view_img.'" alt="" class="img-fluid">';
      
         

        $success_output = '<div class="alert alert-success">
             '.__("done").'
             </div>';  
                      $output = array(
                        'success'     =>  $success_output,
                        'title'     =>  $info->title,
         'exampleModal_price_detail'     =>  $exampleModal_price_detail,
         'color_variant'     =>  $color_variant,
         'content'     =>  $content,
         'productbuttons'     =>  $productbuttons,
         'sizebox'     =>  $sizebox,
         'quick_view_img'=>$quick_view_img
                  
                        

                    );

            return  $output;
    }
           public function termoptions_price( )
           {  
                if (request('type') =='termoptions')
                 {
        $term_id=request('term_id');

 
    $user_id=domain_info('user_id');
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$term_id);
         $term= $term->first();
         $main_price=$term->price->price;


        $price=Termoption::where('id',request('id'))->first()->amount;
        $option=Termoption::where('id',request('id'))->first();

         Session::put('option_price'.$term_id, $option);
            Session::get('option_price'.$term_id);

                      $output = array(
                        'success'     =>  $price+$main_price,
                        
                        

                    );

            return  $output;

                }
           }

           public function varent_selction( )
           {    
                   $term_id=request('term_id');
                   $id=request('id');
          $Category=Category::where('id',request('id'))->first();
             Session::put('varent_selction'.$term_id, $Category);
             Session::get('varent_selction'.$term_id);
             $output = array(
                        'success'     =>  $Category,
                        
                        

                    );

            return  $output;
                
           }


            public function termoptions_pricePOS( )
           {  
                if (request('type') =='termoptions')
                 {
         
 
        $term_id=Termoption::where('id',request('id'))->first()->term_id;
        $option=Termoption::where('id',request('id'))->first();

         Session::put('option_price'.$term_id, $option);
            Session::get('option_price'.$term_id);


           $success_output = '<div class="alert alert-success">
             '.__("done select add").'
             </div>'; 

             $success_output2 = ''.__("done select add").'';  
                      $output = array(
                        'success'     =>  $success_output,
                        'success2'     =>  $success_output2
                        
                        

                    );

            return  $output;

                }
           }

           public function varent_selctionPOS( )
           {  //return 'varent_selctionPOS';  
                  // $term_id=request('term_id');
                    $id=request('id');
          $Category=Category::where('id',$id)->first();
             //Session::put('varent_selction'.$term_id, $Category);
             //Session::get('varent_selction'.$term_id);
             $output = array(
                        'success'     =>  $Category,
                        
                        

                    );

            return  $output;
                
           }

           public function testmail()
           {

  
         $info = Order::where('customer_id', getUserId())->where('user_id', domain_info('user_id'))->with('order_item_with_file', 'order_content', 'shipping_info', 'payment_method')
            ->withCount('order_items_refunded')
            ->findorFail(125);      
         $order_content = json_decode($info->order_content->value);
    
        SEOTools::setTitle('Order No ' . $info->order_no);

     
        SEOTools::setTitle('Order No ' . $info->order_no);


               return view('testmail',compact('info','order_content'));

              
           }

     
    
}
