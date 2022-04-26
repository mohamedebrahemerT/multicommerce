<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Orderitem;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Useraddresses;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerOrderMail;

use App\Models\Userplanmeta;
use App\Models\UserVisa;

use Hash;
use App\Order;
use Cache;
use App\Useroption;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use Session;
use DB;
use App\Mail\Email_verfiy_user;
use carbon\carbon;

class UserController extends Controller
{
    public function __construct()
    {
        if (env('MULTILEVEL_CUSTOMER_REGISTER') != true) {
            abort(404);
        }
    }

    public function login()
    {
          //dd(Session::get('locale'));
       /* if (Auth::check()) {

            return redirect('/user/dashboard');
        }

        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Login - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Login - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Login - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Login - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }  */
  
        return view(base_view() . '.account.login');
    }
    public function logout( )
    {
   
             auth()->logout();
             return redirect('/');
    }

    public function login_post(Request $request)
    {   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
         if(auth::guard('web')->attempt( ['email'=>Request('email'),'password'=>Request('password') ]) )
        {
                 if (auth()->user()->RequestCode == 1) 
                 {
                      
                         
                        if (auth()->user()->status == 0)
                         {
                     $ReasonForBan=auth()->user()->ReasonForBan;
        session()->flash('danger', __('Your account has been locked Because '.$ReasonForBan));
                             auth()->logout();
                            return  Redirect('contact');
                                      
                        }
                        else
                        {
                            return  Redirect('checkout');
                        }
                   
                     
                 }
                 else
                 {
          
                    

                    $user=auth()->user();

                      $user->RequestCode = null;


            $user->save();


     


        $RequestCode = rand(1111, 9999);

 


        $user->RequestCode = $RequestCode;


        $user->save();


        $email = $user->email;


        $data['email'] = $email;


 

        $data['code'] = $RequestCode;


        $token = app('auth.password.broker')->createToken($user);


        $data = DB::table('password_resets')->insert([


                'email' => $user->email,


                'token' => $token,


                'created_at' => Carbon::now(),


            ]


        );


        $url=url('/');

        Mail::to($user->email)->send(new Email_verfiy_user(['user' => $user, 'token' => $token, 'code' => $RequestCode, 'url' => $url]));


        session()->flash('success', __('Code Send To You Sucessfully'));
          
               auth()->logout();
        return view(base_view() . '.account.veryfying', compact('user'));
                 }

            
        }
        else
        {
            session()->flash('danger',__('invald email or password'));

            return back();
        }
    }

    public function register()
    {
        if (Auth::check()) {

            return redirect('/user/dashboard');
        }

        if (Cache::has(domain_info('user_id') . 'seo')) {
            $seo = json_decode(Cache::get(domain_info('user_id') . 'seo'));
        } else {
            $data = Useroption::where('user_id', domain_info('user_id'))->where('key', 'seo')->first();
            $seo = json_decode($data->value ?? '');
        }
        if (!empty($seo)) {
            JsonLdMulti::setTitle('Register - ' . $seo->title ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->description ?? null);
            JsonLdMulti::addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));

            SEOMeta::setTitle('Register - ' . $seo->title ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->description ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle('Register - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::setDescription($seo->description ?? null);
            SEOTools::setCanonical($seo->canonical ?? url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->tags ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/' . domain_info('user_id') . '/logo.png'));
            SEOTools::twitter()->setTitle('Register - ' . $seo->title ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitterTitle ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/' . domain_info('user_id') . '/logo.png'));
        }
        return view(base_view() . '.account.register');
    }

    public function settings()
    {
        SEOTools::setTitle('Settings');
        return view(base_view() . '.account.account');
    }

    public function settings_update(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|max:15',
            'mobile' => 'required|max:20',
            'email' => 'required|email|unique:users,email,' . getUserId()

        ]);

        if ($request->password) {
            $validatedData = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        $user = User::find(getUserId());
        $oldmail = $user->email;
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        
        $user->email = $request->email;
        if ($request->password) {
            $check = Hash::check($request->password_current, auth()->user()->password);

            if ($check == true) {
                $user->password = Hash::make($request->password);
            } else {

                $returnData['errors']['password'] = array(0 => "Enter Valid Password");
                $returnData['message'] = "given data was invalid.";

                return response()->json($returnData, 401);

            }
        }
        $user->save();

        if ($request->image) 
        {
            $request->image->move('uploads/'.$user->id, 'photo.png');
            $user->image = '0';
            $user->save();
        }



            $user->RequestCode = null;


            $user->save();


        $RequestCode = rand(1111, 9999);

  

 


        $data['email'] =$user->email;


        $data['phone'] = $user->phone;


        $data['code'] = $RequestCode;


        $token = app('auth.password.broker')->createToken($user);


        $data = DB::table('password_resets')->insert([


                'email' => $user->email,


                'token' => $token,


                'created_at' => Carbon::now(),


            ]


        );


 


        $data = DB::table('password_resets')->insert([


                'email' => $request->email,


                'token' => $token,


                'created_at' => Carbon::now(),


            ]


        );





        $url=url('/');

        Mail::to($oldmail)->send(new Email_verfiy_user(['user' => $user, 'token' => $token, 'code' => $RequestCode, 'url' => $url]));


        Mail::to($request->email)->send(new Email_verfiy_user(['user' => $user, 'token' => $token, 'code' => $RequestCode, 'url' => $url]));

 


        return response()->json([__('Profile Updated Successfully')]);
    }

    public function addresses()
    {
        return view(base_view() . '.account.addresses');
    }

    public function payment()
    {
        return view(base_view() . '.account.payment');
    }

    public function type($type)
    {
         
         $type = request()->route()->parameter('type');

        SEOTools::setTitle('Orders');
         $orders = Order::
         where('customer_id', getUserId())
         ->where('user_id', domain_info('user_id'))
         ->where('status', $type)
         ->with('payment_method')
         ->latest()->paginate(20);

        return view(base_view() . '.account.orders',compact('orders'));
    }

    public function orders()
    {
        SEOTools::setTitle('Orders');
         $orders = Order::where('customer_id', getUserId())->where('user_id', domain_info('user_id'))->with('payment_method')->latest()->paginate(20);
        return view(base_view() . '.account.orders',compact('orders'));
    }

    public function order_view($id)
    {
        $id = request()->route()->parameter('id');
         $info = Order::where('customer_id', getUserId())->where('user_id', domain_info('user_id'))->with('order_item_with_file', 'order_content', 'shipping_info', 'payment_method')
            ->withCount('order_items_refunded')
            ->findorFail($id);
         $order_content = json_decode($info->order_content->value);
         
        SEOTools::setTitle('Order No ' . $info->order_no);

     // return  $info->order_item->->preview->media->url ;
        return view(base_view() . '.account.order_view', compact('info', 'order_content'));
    }

     public function order_viewQR($id)
    {
        $id = request()->route()->parameter('id');
         $info = Order::with('order_item_with_file', 'order_content', 'shipping_info', 'payment_method')
            ->withCount('order_items_refunded')
            ->findorFail($id);
         $order_content = json_decode($info->order_content->value);
         
        SEOTools::setTitle('Order No ' . $info->order_no);

     // return  $info->order_item->->preview->media->url ;
        return view('frontend.bigbag.order_viewQR', compact('info', 'order_content'));
    }

    public function request_refund()
    {
        $id = request()->route()->parameter('id');
        $order_code = request()->route()->parameter('order_code');
        $info = Order::where('customer_id', getUserId())->where('user_id', domain_info('user_id'))->findorFail($order_code);
        // $order_content = json_decode($info->order_content->value);
        SEOTools::setTitle('Order No ' . $info->order_no);
        return view(base_view() . '.account.refund', compact('order_code'));
    }

    public function submit_request_refund(Request $request)
    {

        //return request();
        $info = Order::where('customer_id', getUserId())
        ->where('user_id', domain_info('user_id'))
        ->where('order_no',$request['order_no'])->first();
        //dd($info);
        if (!$request['productId']) {
            $info->is_fully_refunded = 1;
            $info->reason = $request['reason'];
            $info->refund_status = 'pending';
            $info->save();
            \Session::flash('success', 'wow');
            return back();
        }

        $orderItem = Orderitem::where('order_id', $info->id )->where('term_id', $request['productId'])->first();
        if ($orderItem) {
            $orderItem->is_refundable = 1;
            $orderItem->reason = $request['reason'];
            $orderItem->refund_status = 'pending';
            $orderItem->save();
            $info->is_partially_refunded = 1;
            $info->save();
            if(Session::get('locale') == 'en')  
            {
                \Session::flash('success', 'operation accomplished successfully');
            }
            else
            {
                \Session::flash('success', ' تمت العملية بنجاح');
            }

            $domain_user_id = domain_info('user_id');
            $domain_user_email =User::where('id', $domain_user_id)->first()->email;
            $order = $info;
            $orderItem = $orderItem;

           // Mail::to($domain_user_email)->send(new CustomerOrderMail($order,$orderItem));
            return back();
        }

        \Session::flash('error', 'Can not refund!!');
        return back();
    }

    public function register_user(Request $request)
    {   //return Request();
  
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|min:3|max:15',
            'phone' => 'required|min:3|max:15',
            'password' => 'required|min:8|max:50',
        ]);
        $domain_id = domain_info('domain_id');
        $user_id = domain_info('user_id');

        $plan = Userplanmeta::where('user_id', $user_id)->first();
        $user_limit = $plan->customer_limit ?? 0;
        $total_customers = User::where('created_by', $user_id)->count();

        if ($user_limit <= $total_customers) 
        {
            \Session::flash('user_limit', 'Opps something wrong please contact with us..!!');
            return back();
        }
    
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->mobile = $request->phone;
        
        $user->password = Hash::make($request->password);
        $user->domain_id = $domain_id;
        $user->created_by = $user_id;
        $user->role_id = 2;
        $user->save();

                 $RequestCode = rand(1111, 9999);

 

              
                $user->RequestCode = $RequestCode;
                $user->save();
          



        $token = app('auth.password.broker')->createToken($user);


        $data = DB::table('password_resets')->insert([


                'email' => $user->email,


                'token' => $token,


                'created_at' => Carbon::now(),


            ]


        );
             $url=url('/');


                      try {

    
        Mail::to($user->email)->send(new Email_verfiy_user(['user' => $user, 'token' => $token, 'code' => $RequestCode, 'url' => $url]));

         session()->flash('success', __('Code Send To You Sucessfully'));

} catch (\Exception $e) {

         $e->getMessage();

        session()->flash('danger',__('Invalid email'));
        return back();

}


       

        return view(base_view() . '.account.veryfying', compact('user'));
              
                      
 


        Auth::loginUsingId($user->id);
        \Session::flash('user_limit', 'user created successfully');

        return redirect('/checkout');
        //return redirect('/user/dashboard');
    }

    public function addresses_post(Request $request)
    {
 
        $data=$validated = $request->validate([
            'Phone' => 'required|max:15',
            'CountryCode' => 'required',
            'PO' => 'required|max:10',
            'Country' => 'required',
            'City' => 'required',
            'Address' => 'required',
            'user_id' => 'required',
        ]);

           Useraddresses::create([
            'Phone'=>$request->Phone,
            'CountryCode'=>$request->CountryCode,
            'PO'=>$request->PO,
            'Country'=>$request->Country,
            'City'=>$request->City,
            'Address'=>$request->Address,
            'user_id'=>$request->user_id,
           ]);


            \Session::flash('success', __('user addresses created successfully'));

            

        return redirect('/user/addresses');
    

    }

    public function addresses_update(Request $request)
    {
 
        $data=$validated = $request->validate([
            'Phone' =>  'required|max:15',
            'CountryCode' => 'required',
            'PO' => 'required|max:10',
            'Country' => 'required',
            'City' => 'required',
            'Address' => 'required',
            'user_id' => 'required',
        ]);

           Useraddresses::where('id',$request->addresse_id)->update([
            'Phone'=>$request->Phone,
            'CountryCode'=>$request->CountryCode,
            'PO'=>$request->PO,
            'Country'=>$request->Country,
            'City'=>$request->City,
            'Address'=>$request->Address,
            'user_id'=>$request->user_id,
           ]);


            \Session::flash('success', __('addresses updated successfully'));

            

        return redirect('/user/addresses');
    

    }

    public function addresses_trash()
    {
        $id=request('id');
        useraddresses::where('id',$id)->delete();
        \Session::flash('user_limit', 'addresse deleted successfully');

        return redirect('/user/addresses');

    }
    
    public function dashboard()
    {
        if (Auth::check()) {
            SEOTools::setTitle('Dashboard');
            return view(base_view() . '.account.dashboard');
        }
        return redirect('/user/login');
    }

       
        public function Email_verfiy($token)


    {


         $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();


        if (!empty($check_token)) 
        {


             user::where('email', $check_token->email)->update([


                'RequestCode' => 1,


            ]);


              $user = user::where('email', $check_token->email)->first();


    

            DB::table('password_resets')->where('email', $check_token->email)->delete();

                Auth::loginUsingId($user->id);
        \Session::flash('user_limit', 'user created successfully');

        return redirect('/checkout');
             


        }


    }


      public function postverfiy(Request $request)


    {


        if ($user = User::where('RequestCode', $request->code)->first()) 
        {


            $code = $user->code;
            $user->RequestCode = 1;
            $user->save();

            session()->flash('success', __('yhaveAcout'));


          
                Auth::loginUsingId($user->id);
        \Session::flash('user_limit', __('user created successfully'));

        return redirect('/checkout');


        } else 
        {


            session()->flash('success', 'code is not correct');


            return redirect('verify_user');


        }


    }


      public function request_new_code(Request $request)


    {

                     
        $email = $request->new_email;


        $phone = $request->new_phone;


        if ($user = User::where('email', $request->new_email)->first()) {


            $user->RequestCode = null;


            $user->save();


        }


        $RequestCode = rand(1111, 9999);

 


        $user->RequestCode = $RequestCode;


        $user->save();


        $email = $request->new_email;


        $phone = $request->new_phone;


        $data['email'] = $email;


        $data['phone'] = $phone;


        $data['code'] = $RequestCode;


        $token = app('auth.password.broker')->createToken($user);


        $data = DB::table('password_resets')->insert([


                'email' => $user->email,


                'token' => $token,


                'created_at' => Carbon::now(),


            ]


        );


        $url=url('/');

        Mail::to($user->email)->send(new Email_verfiy_user(['user' => $user, 'token' => $token, 'code' => $RequestCode, 'url' => $url]));


        session()->flash('success', __('Code Send To You Sucessfully'));
          
            
        return view(base_view() . '.account.veryfying', compact('user'));
          


    }

                public function UserVisa(Request $request)
                {
                     
                      $data=$validated = $request->validate([
            'user_id' => 'required',
            'CardNum' => 'required|max:14',
            'CardName' => 'required|max:20',
            'code' => 'required|max:3',
            'expir' => 'required',
           
        ]);

           UserVisa::create([
            'user_id'=>$request->user_id,
            'CardNum'=>$request->CardNum,
            'CardName'=>$request->CardName,
            'expir'=>$request->expir,

            'code'=>$request->code,
            
           ]);


            \Session::flash('success',__('user payment created successfully'));

            

        return redirect('/user/payment');
                }
               public function deleteUserVisa($id)
               {

                   $UserVisa=UserVisa::where('id',$id);
                   $UserVisa->delete();

                    \Session::flash('success', __('user payment delete successfully'));

            
          return back();
               }
                


                       public function invoice($id)
    {
        
        $order = Order::with('order_item', 'customer', 'order_content', 'shipping_info')->findorFail($id);
   
        $location = \App\Useroption::where('key', 'location')->where('user_id',auth()->user()->id)->first();
        $location = json_decode($location->value ?? '');

           $order_content = json_decode($order->order_content->value ?? '');
     
    
        
        return view(base_view() . '.invoice.invoice',  compact('order', 'order_content', 'location'));


        $pdf = \PDF::loadView('email.invoice', compact('order', 'order_content', 'location'));
        return $pdf->download('invoice.pdf');
    }
}
