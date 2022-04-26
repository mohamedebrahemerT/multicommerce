<?php

namespace App\Http\Controllers\Beauty;

use App\Http\Controllers\Controller;
use App\Orderitem;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Useraddresses;

use App\Models\Userplanmeta;
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

class UserController extends Controller
{
    public function __construct()
    {
        if (env('MULTILEVEL_CUSTOMER_REGISTER') != true) {
            abort(404);
        }
    }

    public function login(Request $request)
    {
        return view(base_view() . '.account.login');
    }
    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view(base_view() . '.account.register');
    }
    public function logout( )
    {
        auth()->logout();
        return redirect('/');
    }

    public function login_post(Request $request)
    {
        // return $request ;
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if(auth::guard('web')->attempt( ['email'=>Request('email'),'password'=>Request('password') ]) )
        {
            return  Redirect('/checkout');
        }
        else
        {
            return back()->with('error',__('beauty.emailOrPasswordInvalid'));
        }
    }

   

    public function settings()
    {
        SEOTools::setTitle('Settings');
        return view(base_view() . '.account.account');
    }

    public function settings_update(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . getUserId()

        ]);

        if ($request->password) {
            $validatedData = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        $user = User::find(getUserId());
        $user->name = $request->name;
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

            Mail::to($domain_user_email)->send(new CustomerOrderMail($order,$orderItem));
            return back();
        }

        \Session::flash('error', 'Can not refund!!');
        return back();
    }

    public function register_user(Request $request)
    {
        // return $request ;
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
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
        $user->password = Hash::make($request->password);
        $user->domain_id = $domain_id;
        $user->created_by = $user_id;
        $user->role_id = 2;
        $user->save();
        Auth::loginUsingId($user->id);
        \Session::flash('user_limit', 'user created successfully');

        return redirect('/checkout');
        //return redirect('/user/dashboard');
    }

    public function addresses_post(Request $request)
    {
 
        $data=$validated = $request->validate([
            'Phone' => 'required',
            'CountryCode' => 'required',
            'PO' => 'required',
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


            \Session::flash('user_limit', 'user addresses created successfully');

            

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
}
