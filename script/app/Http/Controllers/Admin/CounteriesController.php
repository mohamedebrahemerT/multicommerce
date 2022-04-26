<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\country;
use  App\Category;

class CounteriesController extends Controller
{

     public function __construct() {
           
        $this->middleware('AdminRole:counteries_show', [
            'only' => ['index', 'show'],
        ]);
        $this->middleware('AdminRole:counteries_add', [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('AdminRole:counteries_edit', [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('AdminRole:counteries_delete', [
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
        $posts=country::latest()->paginate(20);
        return view('admin.Counteries.list',compact('posts'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Counteries.create');
         
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
                'currency' => ['required', 'string', 'max:255'],
                 'code' => ['required', 'string', 'max:255'],
                // 'logo' => 'required|image|mimes:jpg,png,gif,jpeg',
                 
                   
         
            
            ],[],[
          'name_ar'=>trans('admin.name_ar'),
            'name_en'=>trans('admin.name_en'),
            'currency'=>trans('admin.currency'),
            'code'=>trans('admin.code'),
            'logo'=>trans('admin.logo'),
            


            ]);

 
             

         $country=country::create($data);

         //////////////////////////////
             if ($request->logo) 
             {
        $request->logo_country->move('uploads/'.$country->id, 'logo_country.png');
             }
            //////////////////////////////

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
       country::where('id',$id)->delete();
        
    session()->flash('success', __('success'));

          return redirect('/admin/counteries');
        
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
          $post=country::where('id',$id)->first();
        return view('admin.Counteries.edite',compact('post'));

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
                'currency' => ['required', 'string', 'max:255'],
                 'code' => ['required', 'string', 'max:255'],
             
                 
                   
         
            
            ],[],[
          'name_ar'=>trans('admin.name_ar'),
            'name_en'=>trans('admin.name_en'),
            'currency'=>trans('admin.currency'),
            'code'=>trans('admin.code'),
          
            


            ]);

 
             

         $country=country::where('id',$id)->update($data);

         //////////////////////////////
             if ($request->logo) 
             {
        $request->logo_country->move('uploads/'.$country->id, 'logo_country.png');
             }
            //////////////////////////////

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
          
    }
}
