<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SellerRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth()->user()->can('role.list')) {
            $roles = Role::where('user_id',getUserId())->get();
            return view('seller.role.index', compact('roles'));
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (Auth()->user()->can('role.create')) {
            $permisionsAvailable = ['admin','Customer','dashboard','gallery','menu','Orders','Pages','Report','role','Settings'] ;
            $permisions = Permission::all();
            $permission_groups = User::getPermissionGroup()->whereIn('group_name',$permisionsAvailable);
            // dd($permission_groups);
            return view('seller.role.create', compact('permisions', 'permission_groups'));
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //    $validatedData = $request->validate([
        //        'name_ar' => 'required|unique:roles|max:100',
        //        'name_en' => 'required|unique:roles|max:100',
        //    ]);
        $name = json_encode([
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ]);
        $role = Role::create(['name' => $name,'user_id'=>getUserId()]);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {

            $role->syncPermissions($permissions);
        }

//        return response()->json(['Role created successfully']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (Auth()->user()->can('role.edit')) {
            $role = Role::findById($id);
            $permisionsAvailable = ['admin','Customer','dashboard','gallery','menu','Orders','Pages','Report','role','Settings'] ;
            $all_permissions = Permission::all();
            $permission_groups = User::getpermissionGroups()->whereIn('name',$permisionsAvailable);
            // $permission_groups = User::getpermissionGroups();
            // dd($permission_groups );
            return view('seller.role.edit', compact('role', 'all_permissions', 'permission_groups'));
        // }
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
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $role = Role::findById($id);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

//        return response()->json(['Role has been updated !!']);
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
        // if (Auth()->user()->can('role.delete')) {
            if ($request->status == 'delete') {
                if ($request->ids) {
                    foreach ($request->ids as $id) {
                        Role::destroy($id);
                    }
                }
            }
        //    return response()->json('Role Removed');
            return response()->json([trans('success')]);
        // }
    }
}
