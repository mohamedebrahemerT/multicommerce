<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;
class CustomerController extends Controller
{


    public function __construct()
    {
       if(env('MULTILEVEL_CUSTOMER_REGISTER') != true){
        abort(404);
       }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->src) {
            $posts=User::where('created_by',getUserId())->where('role_id',2)->where($request->type,'LIKE','%'.$request->src.'%')->orderBy('id','desc')->paginate(50);
        }
       else{
         $posts=User::where('created_by',getUserId())->withCount('orders')->orderBy('orders_count','DESC')->where('role_id',2)->orderBy('id','desc')->paginate(20);
       }

       $src=$request->src ?? '';

        return view('seller.customer.index',compact('posts','src'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.customer.create');
    }

    public function user(Request $request)
    {
      $user=User::where('created_by',getUserId())->where('email',$request->email)->first();

      if (!empty($user)) {
        return $user->id;
      }
      else{
        return response()->json('Customer Not Found',404);
      }
    }

    public function login($id){
     $user=User::where('created_by',getUserId())->findorFail($id);
     Auth::logout();
     Auth::loginUsingId($user->id);

     return redirect('/user/dashboard');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $limit=user_limit();
        $posts_count=\App\Models\User::where('created_by',getUserId())->count();
         if ($limit['customer_limit'] <= $posts_count) {

         $error['errors']['error']=trans('Maximum customers limit exceeded');
         return response()->json($error,401);
        }


       $validatedData = $request->validate([
        'email' => 'required|email|unique:users,email|max:50',
        'mobile' => 'required',
        'CountryCode' => 'required',
        'name' => 'required|max:20',
        'password' => 'required|min:6',
       ]);

       $data=Auth::user();


       $user= new User;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->mobile = $request->mobile;
       $user->CountryCode = $request->CountryCode;
       $user->role_id = 2;
       $user->created_by = $data->id;
       $user->domain_id = $data->domain_id;
       $user->password = Hash::make($request->password);
       $user->save();

//       return response()->json(['User Created Successfully']);
        return response()->json([trans('success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $info=User::where('created_by',getUserId())->where('role_id',2)->withCount('orders','orders_complete','orders_processing')->findorFail($id);
       $earnings=\App\Order::where('customer_id',$id)->where('payment_status',1)->sum('total');
       $orders=\App\Order::where('customer_id',$id)->with('payment_method')->withCount('order_item')->latest()->paginate(20);
       return view('seller.customer.show',compact('info','earnings','orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $info=User::where('created_by',getUserId())->where('role_id',2)->findorFail($id);
       return view('seller.customer.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $validatedData = $request->validate([
        'email' => 'required|max:50|email|unique:users,email,' . $id,
        'name' => 'required|max:20',
        'mobile' => 'required',
        'CountryCode' => 'required',

       ]);

        if ($request->change_password) {
          $validatedData = $request->validate([
            'password' => 'required|min:6',
          ]);
        }
       $user=  User::where('created_by',getUserId())->where('role_id',2)->findorFail($id);
       $user->name = $request->name;
       $user->mobile = $request->mobile;
       $user->CountryCode = $request->CountryCode;
       $user->ReasonForBan = $request->ReasonForBan;
       
       $user->email = $request->email;
       if ($request->change_password) {
          $user->password = Hash::make($request->password);
       }

       $user->save();

//       return response()->json(['User Updated Successfully']);
        return response()->json([trans('success')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {


         if ($request->type=='delete') 
         {
            $auth_id=getUserId();
            foreach ($request->ids as $key => $id) 
            {
                $user=  User::where('created_by',$auth_id)->where('role_id',2)->findorFail($id);
                $user->delete();
            }
//            return response()->json(['Customer Deleted']);
             return response()->json([trans('success')]);
        }
        elseif ($request->type=='block') 
        {

           $auth_id=getUserId();
            foreach ($request->ids as $key => $id) 
            {
                $user=  User::where('created_by',$auth_id)->where('role_id',2)->findorFail($id);
                $user->status=0;
                $user->save();
            }
             return response()->json([trans('success')]);

          }

            elseif ($request->type=='active') 
        {

           $auth_id=getUserId();
            foreach ($request->ids as $key => $id) 
            {
                $user=  User::where('created_by',$auth_id)->where('role_id',2)->findorFail($id);
                $user->status=1;
                $user->save();
            }
//            return response()->json(['Customer Deleted']);
             return response()->json([trans('success')]);

        }


    }
}
