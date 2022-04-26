<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Userplan;
use App\Term;
use Spatie\Analytics;
use Spatie\Analytics\Period;
use App\Domain;
use Carbon\Carbon;

class EmployeeController extends Controller
{

    public function make_local(Request $request)
    {
        Session::put('locale', $request->lang);
        \App::setlocale($request->lang);
        return redirect()->back();
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        // if (Auth()->user()->can('admin.list')) {
             $users = User::where('user_id',getUserId())->latest()->get();
            // dd($users)
            return view('seller.employees.index', compact('users'));
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (Auth()->user()->can('admin.create')) {
            $roles = Role::where('user_id',getUserId())->get();
            $auth_id = getUserId();
            $services = Term::where('type', 'product')->where('status', '1')->where('user_id', $auth_id)->get();
            
            return view('seller.employees.create', compact('roles','services'));
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
       
            'branche_id' => 'sometimes|nullable',

            'email' => 'required|max:100|email|unique:users',
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required|min:6|confirmed',
            'group_id'=>'required',
        ]);
       
        // Create New User
        $user            = new User();
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->mobile     = $request->mobile;
        $user->role_id   = Auth()->user()->role_id;
        $user->shop_type = Auth()->user()->shop_type;
        $user->domain_id = Auth()->user()->domain_id;
        $user->user_id   = getUserId();
        $user->is_admin  = 0;
        $user->password  = Hash::make($request->password);
        $user->branche_id     = $request->branche_id;
        $user->group_id     = $request->group_id;
        $user->save();


            $user->assignRole(1);
      
        if ($request->services) {
            $user->services()->sync($request->services);
        }

        if($request->file){
            $user_id=getUserId();

            $fileName = time().'.'.$request->file->extension();
            $path='uploads/'.$user_id.'/'.date('y/m');
            $request->file->move($path, $fileName);
            $name=$path.'/'.$fileName;

            $user->image  = $name;
            $user->save();

        }


        //    return response()->json(['User has been created !!']);
        return response()->json([trans('success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (Auth()->user()->can('admin.edit')) {
            $user = User::find($id);
            $roles = Role::where('user_id',getUserId())->get();

            $auth_id = getUserId();
            $services = Term::where('type', 'product')->where('status', '1')->where('user_id', $auth_id)->get();
            // return $services ;
            return view('seller.employees.edit', compact('user', 'roles','services'));
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Create New User
        $user = User::find($id);
   
        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,' . $id,
            'mobile' => 'required|numeric|unique:users,mobile,' . $id,
                'branche_id' => 'sometimes|nullable',

            'password' => 'nullable|min:6|confirmed',
            'group_id'=>'required',
        ]);

        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->mobile  = $request->mobile;
        $user->status = $request->status;
        $user->branche_id = $request->branche_id;
        $user->group_id = $request->group_id;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->roles()->detach();
         
            $user->assignRole(1);
         
        if ($request->services) {
            $user->services()->sync($request->services);
        }

        if($request->file){
            $user_id=getUserId();

            $fileName = time().'.'.$request->file->extension();
            $path='uploads/'.$user_id.'/'.date('y/m');
            $request->file->move($path, $fileName);
            $name=$path.'/'.$fileName;

            $user->image  = $name;
            $user->save();

        }

        //    return response()->json(['User has been updated !!']);
        return response()->json([trans('success')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        // if (Auth()->user()->can('admin.delete')) {

            if ($request->status == 'delete') {
                if ($request->ids) {
                    foreach ($request->ids as $id) {
                        User::destroy($id);
                    }
                }
            } else {

                if ($request->ids) {
                    foreach ($request->ids as $id) {
                        $post = User::find($id);
                        $post->status = $request->status;
                        $post->save();
                    }
                }
            }

        // }

              return redirect('seller/users');
    }
}
