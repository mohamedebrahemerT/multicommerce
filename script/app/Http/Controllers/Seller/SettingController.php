<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plan;
use Auth;
use App\Usermeta;
use App\Useroption;
use App\Category;
use App\Domain;
use App\Models\User;
use Hash;
class SettingController extends Controller
{


    public function settings_view(){

           
        return view('seller.settings');
    }

    public function profile_update(Request $request){

    $user=User::find(getUserId());
      if ($request->password) {
           $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


           $check=Hash::check($request->password_current,auth()->user()->password);

           if ($check==true) {
              $user->password= Hash::make($request->password);
            }
        else{

            $returnData['errors']['password']=array(0=>"Enter Valid Password");
            $returnData['message']="given data was invalid.";

            return response()->json($returnData, 401);

        }
    }
    else{
        $validatedData = $request->validate([
           'name' => 'required|max:255',
           'email'  =>  'required|email|unique:users,email,'.getUserId()

       ]);
        $user->name=$request->name;
        $user->email=$request->email;
    }
    $user->save();

//    return response()->json(['Profile Updated Successfully']);
        return response()->json([trans('success')]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         
       if ($request->type=='general') {
             $user_id=getUserId();

             $validatedData = $request->validate([
                'shop_name' => 'required|max:20',
                'shop_name_ar' => 'required|max:20',
                'shop_description' => 'required|max:250',
               // 'store_email' => 'required|max:50|email',
                'order_prefix' => 'required|max:20',
                'currency_position' => 'required',
                'currency_name' => 'required|max:10',
                'currency_icon' => 'required|max:10',
              //  'lanugage' => 'required',
                'local' => 'required',
            ]);

            $shop_name= Useroption::where('user_id',$user_id)->where('key','shop_name')->first();
            if (empty($shop_name)) {
                $shop_name=new Useroption;
                $shop_name->key='shop_name';
            }
            $shop_name->value=$request->shop_name;
            $shop_name->user_id=$user_id;
            $shop_name->save();

            ////////////////////////////////////
            $shop_name_ar= Useroption::where('user_id',$user_id)->where('key','shop_name_ar')->first();
            if (empty($shop_name_ar)) {
                $shop_name_ar=new Useroption;
                $shop_name_ar->key='shop_name_ar';
            }
            $shop_name_ar->value=$request->shop_name_ar;
            $shop_name_ar->user_id=$user_id;
            $shop_name_ar->save();

            ///////////////////////////////////////////
            
            $google_map_link= Useroption::where('user_id',$user_id)->where('key','google_map_link')->first();
            if (empty($google_map_link)) {
                $google_map_link=new Useroption;
                $google_map_link->key='google_map_link';
            }
            $google_map_link->value=$request->google_map_link;
            $google_map_link->user_id=$user_id;
            $google_map_link->save();
            ///////////////////////////////////////////

            /////////////////////////////// about_ar
             $about_ar= Useroption::where('user_id',$user_id)->where('key','about_ar')->first();
            if (empty($about_ar)) {
                $about_ar=new Useroption;
                $about_ar->key='about_ar';
            }
            $about_ar->value=$request->about_ar;
            $about_ar->user_id=$user_id;
            $about_ar->save();

            ///////////////////////////////

            /////////////////////////////// about_en
             $about_en= Useroption::where('user_id',$user_id)->where('key','about_en')->first();
            if (empty($about_en)) {
                $about_en=new Useroption;
                $about_en->key='about_en';
            }
            $about_en->value=$request->about_en;
            $about_en->user_id=$user_id;
            $about_en->save();

            ///////////////////////////////

            /////////////////////////////// Terms_and_Conditions_ar
             $Terms_and_Conditions_ar= Useroption::where('user_id',$user_id)->where('key','Terms_and_Conditions_ar')->first();
            if (empty($Terms_and_Conditions_ar)) {
                $Terms_and_Conditions_ar=new Useroption;
                $Terms_and_Conditions_ar->key='Terms_and_Conditions_ar';
            }
            $Terms_and_Conditions_ar->value=$request->Terms_and_Conditions_ar;
            $Terms_and_Conditions_ar->user_id=$user_id;
            $Terms_and_Conditions_ar->save();

            ///////////////////////////////

            /////////////////////////////// Terms_and_Conditions_en
             $Terms_and_Conditions_en= Useroption::where('user_id',$user_id)->where('key','Terms_and_Conditions_en')->first();
            if (empty($Terms_and_Conditions_en)) {
                $Terms_and_Conditions_en=new Useroption;
                $Terms_and_Conditions_en->key='Terms_and_Conditions_en';
            }
            $Terms_and_Conditions_en->value=$request->Terms_and_Conditions_en;
            $Terms_and_Conditions_en->user_id=$user_id;
            $Terms_and_Conditions_en->save();

            ///////////////////////////////

            /////////////////////////////// Goods_Return_Policy_ar
             $Goods_Return_Policy_ar= Useroption::where('user_id',$user_id)->where('key','Goods_Return_Policy_ar')->first();
            if (empty($Goods_Return_Policy_ar)) {
                $Goods_Return_Policy_ar=new Useroption;
                $Goods_Return_Policy_ar->key='Goods_Return_Policy_ar';
            }
            $Goods_Return_Policy_ar->value=$request->Goods_Return_Policy_ar;
            $Goods_Return_Policy_ar->user_id=$user_id;
            $Goods_Return_Policy_ar->save();

            ///////////////////////////////

            /////////////////////////////// Goods_Return_Policy_en
             $Goods_Return_Policy_en= Useroption::where('user_id',$user_id)->where('key','Goods_Return_Policy_en')->first();
            if (empty($Goods_Return_Policy_en)) {
                $Goods_Return_Policy_en=new Useroption;
                $Goods_Return_Policy_en->key='Goods_Return_Policy_en';
            }
            $Goods_Return_Policy_en->value=$request->Goods_Return_Policy_en;
            $Goods_Return_Policy_en->user_id=$user_id;
            $Goods_Return_Policy_en->save();

            ///////////////////////////////

            //////////////////////////////
             if ($request->about_photo) 
             {
        $request->about_photo->move('uploads/'.$user_id, 'about_photo.png');
             }
            //////////////////////////////

            $shop_description= Useroption::where('user_id',$user_id)->where('key','shop_description')->first();
            if (empty($shop_description)) {
                $shop_description=new Useroption;
                $shop_description->key='shop_description';
            }
            $shop_description->value=$request->shop_description;
            $shop_description->user_id=$user_id;
            $shop_description->save();

            $shop_description_ar= Useroption::where('user_id',$user_id)->where('key','shop_description_ar')->first();
            if (empty($shop_description_ar)) {
                $shop_description_ar=new Useroption;
                $shop_description_ar->key='shop_description_ar';
            }
            $shop_description_ar->value=$request->shop_description_ar;
            $shop_description_ar->user_id=$user_id;
            $shop_description_ar->save();


            $store_email= Useroption::where('user_id',$user_id)->where('key','store_email')->first();
            if (empty($store_email)) {
                $store_email=new Useroption;
                $store_email->key='store_email';
            }
            $store_email->value=$request->store_email;
             $store_email->user_id=$user_id;
            $store_email->save();

            $order_prefix= Useroption::where('user_id',$user_id)->where('key','order_prefix')->first();
            if (empty($order_prefix)) {
                $order_prefix=new Useroption;
                $order_prefix->key='order_prefix';
            }
            $order_prefix->value=$request->order_prefix;
            $order_prefix->user_id=$user_id;
            $order_prefix->save();

            $local= Useroption::where('user_id',$user_id)->where('key','local')->first();
            if (empty($local)) {
                $local=new Useroption;
                $local->key='local';
            }
            $local->value=$request->local;
            $local->user_id=$user_id;
            $local->save();



            $currency= Useroption::where('user_id',$user_id)->where('key','currency')->first();
            if (empty($currency)) {
                $currency=new Useroption;
                $currency->key='currency';
            }
            $currencyInfo['currency_position']=$request->currency_position;
            $currencyInfo['currency_name']=$request->currency_name;
            $currencyInfo['currency_name_ar']=$request->currency_name_ar;
            $currencyInfo['currency_icon']=$request->currency_icon;
            $currencyInfo['currency_icon_ar']=$request->currency_icon_ar;

            $currency->value=json_encode($currencyInfo);
            $currency->user_id=$user_id;
            $currency->save();
            \Cache::forget(getUserId().'currency_info');

           /* $langs=[];
            foreach ($request->lanugage as $key => $value) {
                $str=explode(',', $value);
                $langs[$str[0]]=$str[1];
            }
            $languages= Useroption::where('user_id',$user_id)->where('key','languages')->first();
            if (empty($languages)) {
                $languages=new Useroption;
                $languages->key='languages';
                $languages->user_id=$user_id;
            }
            $languages->value=json_encode($langs);
            $languages->save();*/

        // $tax= Useroption::where('user_id',$user_id)->where('key','tax')->get();
            
            if (request()->has('name') && request()->has('value')) 
               {
                  
            $i=0;

           $c= Useroption::where('key','tax')->where('user_id',$user_id);
             $c->delete();

        foreach (request('name') as $name )
                 {  
                 
                       $value=request('value')[$i];
                       
                 
                     $Useroptionvat=new Useroption;
                $Useroptionvat->key='tax';
                $Useroptionvat->name=$name;
                $Useroptionvat->value=$value;
                 
                $Useroptionvat->user_id=$user_id;
            $Useroptionvat->save();

              $Useroptionvat;

           
                    $i=$i+1;
                }

           



                
               }


            \Cache::forget('tax'.getUserId());

            $domain_id=domain_info('domain_id');
            $domain=Domain::find($domain_id);
            $domain->shop_type=$request->shop_type;
            $domain->save();
            //\Cache::forget('domain');
//            return response()->json(['Settings Updated']);
           return response()->json([trans('success')]);
       }

       if ($request->type=='location') {
        $user_id=getUserId();
        $validatedData = $request->validate([
                //'company_name' => 'required|max:20',
                'address' => 'required|max:250',
               // 'city' => 'required|max:20',
              //  'state' => 'required|max:20',
               // 'zip_code' => 'required|max:20',
                'email' => 'required|max:30',
                'phone' => 'required|max:15',
        ]);

         $location= Useroption::where('user_id',$user_id)->where('key','location')->first();
         if (empty($location)) {
            $location=new Useroption;
            $location->key='location';
         }
         $data['company_name']=$request->company_name;
         $data['address']=$request->address;
         $data['address_ar']=$request->address_ar;
         $data['city']=$request->city;
         $data['state']=$request->state;
         $data['zip_code']=$request->zip_code;
         $data['email']=$request->email;
         $data['email_ar']=$request->email_ar;
         $data['phone']=$request->phone;
         $data['invoice_description']=$request->invoice_description;

         $location->value=json_encode($data);
         $location->user_id=$user_id;
         $location->save();

//         return response()->json(['Location Updated']);
           return response()->json([trans('success')]);
       }

       if ($request->type=='theme_settings') {
        $user_id=getUserId();
        $validatedData = $request->validate([
                'theme_color' => 'required|max:50',
                'logo' => 'dimensions:max_width=141,max_height=49|max:1000|mimes:png',
                'favicon' => 'max:100|mimes:ico',
        ]);


         $theme_color= Useroption::where('user_id',$user_id)->where('key','theme_color')->first();
         if (empty($theme_color)) {
            $theme_color=new Useroption;
            $theme_color->key='theme_color';
         }

           $theme_color_menue= Useroption::where('user_id',$user_id)->where('key','theme_color_menue')->first();
         if (empty($theme_color_menue)) {
            $theme_color_menue=new Useroption;
            $theme_color_menue->key='theme_color_menue';
         }

         $Available_Offer= Useroption::where('user_id',$user_id)->where('key','Available_Offer')->first();
         if (empty($Available_Offer)) {
            $Available_Offer=new Useroption;
            $Available_Offer->key='Available_Offer';
         }

         $before_footer= Useroption::where('user_id',$user_id)->where('key','before_footer')->first();
         if (empty($before_footer)) {
            $before_footer=new Useroption;
            $before_footer->key='before_footer';
         }

         $footer= Useroption::where('user_id',$user_id)->where('key','footer')->first();
         if (empty($footer)) {
            $footer=new Useroption;
            $footer->key='footer';
         }

        if ($request->logo) {
             $request->logo->move('uploads/'.$user_id, 'logo.png');
        }

        if ($request->logo_footer) {
        $request->logo_footer->move('uploads/'.$user_id, 'logo_footer.png');
        }

        

        if ($request->favicon) {
             $request->favicon->move('uploads/'.$user_id, 'favicon.ico');
        }


         $theme_color->value=$request->theme_color;
         $theme_color->user_id=$user_id;
         $theme_color->save();

           $theme_color_menue->value=$request->theme_color_menue;
         $theme_color_menue->user_id=$user_id;
         $theme_color_menue->save();

          $Available_Offer->value=$request->Available_Offer;
         $Available_Offer->user_id=$user_id;
         $Available_Offer->save();

           $before_footer->value=$request->before_footer;
         $before_footer->user_id=$user_id;
         $before_footer->save();

           $footer->value=$request->footer;
         $footer->user_id=$user_id;
         $footer->save();


         $social= Useroption::where('user_id',$user_id)->where('key','socials')->first();
         if (empty($social)) {
            $social=new Useroption;
            $social->key='socials';
         }

         $links=[];
         if(isset($request->icon)){
             foreach ($request->icon as $key => $value) {
                 $data['icon']=$value;
                 $data['url']=$request->url[$key];
                 array_push($links, $data);
             }
         }
           $social->value=json_encode($links);
           $social->user_id=$user_id;
           $social->save();


//         return response()->json(['Theme Settings Updated']);
           return response()->json([trans('success')]);
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if ($slug=='shop-settings') {
            $user_id=getUserId();

            $langlist=\App\Option::where('key','languages')->first();
            $langlist=json_decode($langlist->value ?? '');

            $languages= Useroption::where('user_id',$user_id)->where('key','languages')->first();
            $active_languages= json_decode($languages->value ?? '');
            $my_languages=[];
            foreach ($active_languages ?? [] as $key => $value) {
                array_push($my_languages, $value);
            }

            $shop_name=Useroption::where('key','shop_name')->where('user_id',$user_id)->first();

             $shop_name_ar=Useroption::where('key','shop_name_ar')->where('user_id',$user_id)->first();

            
            $shop_description=Useroption::where('key','shop_description')->where('user_id',$user_id)->first();

             $shop_description_ar=Useroption::where('key','shop_description_ar')->where('user_id',$user_id)->first();

            
            $store_email=Useroption::where('key','store_email')->where('user_id',$user_id)->first();
            $order_prefix=Useroption::where('key','order_prefix')->where('user_id',$user_id)->first();
            $currency=Useroption::where('key','currency')->where('user_id',$user_id)->first();
            $location=Useroption::where('key','location')->where('user_id',$user_id)->first();

            $theme_color=Useroption::where('key','theme_color')->where('user_id',$user_id)->first();

              $theme_color_menue=Useroption::where('key','theme_color_menue')->where('user_id',$user_id)->first();

                $Available_Offer=Useroption::where('key','Available_Offer')->where('user_id',$user_id)->first();

                $before_footer=Useroption::where('key','before_footer')->where('user_id',$user_id)->first();

                  $footer=Useroption::where('key','footer')->where('user_id',$user_id)->first();



            $currency=json_decode($currency->value ?? '');
            $location=json_decode($location->value ?? '');
        $taxs= Useroption::where('user_id',$user_id)->where('key','tax')->get();
            $local= Useroption::where('user_id',$user_id)->where('key','local')->first();
            $socials= Useroption::where('user_id',$user_id)->where('key','socials')->first();
            $local=$local->value ?? '';
            $socials=json_decode($socials->value ?? '');

           return view('seller.settings.general',compact(
                'theme_color_menue',
'Available_Offer',
'before_footer',
'footer',
             'shop_name','shop_description_ar','shop_name_ar','shop_description','store_email','order_prefix','currency','location','theme_color','langlist','my_languages','taxs','local','socials'));
        }
        if ($slug=='payment') {
            $posts=Category::with('description','active_getway')->where('type','payment_getway')->where('slug','!=','cod')->where('featured',1)->get();
            $cod=Category::with('description','active_getway')->where('type','payment_getway')->where('slug','cod')->get();
           return view('seller.settings.payment_method',compact('posts','cod'));
        }
        if ($slug=='plan') {
            $posts=Plan::where('status',1)->latest()->get();
           return view('seller.plan.index',compact('posts'));
        }

        return back();
    }


}
