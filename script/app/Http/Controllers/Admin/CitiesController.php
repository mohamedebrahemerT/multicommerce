<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\city;

class CitiesController extends Controller
{
      public function __construct() {
           
        $this->middleware('AdminRole:cities_show', [
            'only' => ['index', 'show'],
        ]);
        $this->middleware('AdminRole:cities_add', [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('AdminRole:cities_edit', [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('AdminRole:cities_delete', [
            'only' => ['destroy', 'multi_delete'],
        ]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=city::latest()->paginate(20);
        return view('admin.cities.list',compact('posts'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create');
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
                $data= $this->validate(request(),[
               'name_ar' => ['required', 'string', 'max:255'],
                'name_en' => ['required', 'string', 'max:255'],
                'country_id' => 'required',
               
                 
                   
         
            
            ],[],[
          'name_ar'=>trans('admin.name_ar'),
            'name_en'=>trans('admin.name_en'),
            'country_id'=>trans('admin.country'),
             
            


            ]);

 
             

         $cities=city::create($data);

        

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
       city::where('id',$id)->delete();
        
    session()->flash('success', __('success'));

          return redirect('/admin/cities');
        
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
          $post=city::where('id',$id)->first();
        return view('admin.cities.edite',compact('post'));

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

     $data= $this->validate(request(),[
               'name_ar' => ['required', 'string', 'max:255'],
                'name_en' => ['required', 'string', 'max:255'],
                'country_id' => 'required',
               
                 
                   
         
            
            ],[],[
          'name_ar'=>trans('admin.name_ar'),
            'name_en'=>trans('admin.name_en'),
            'country_id'=>trans('admin.country'),
             
            


            ]);
 
             

         $cities=city::where('id',$id)->update($data);

        return response()->json([trans('success')]);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         AdminGroupRole::where('admin_groups_id', $id)->delete();
        $admingroups->delete();
        return backWithSuccess(__('deleted'));
          
    }
}
