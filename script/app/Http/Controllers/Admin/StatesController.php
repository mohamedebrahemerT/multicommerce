<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\stat;
use  App\Models\city;

  use Form; 
class StatesController extends Controller
{

    public function __construct() {
           
        $this->middleware('AdminRole:states_show', [
            'only' => ['index', 'show'],
        ]);
        $this->middleware('AdminRole:states_add', [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('AdminRole:states_edit', [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('AdminRole:states_delete', [
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
        $posts=stat::latest()->paginate(20);
        return view('admin.stats.list',compact('posts'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stats.create');
         
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
                'city_id' => 'required',
               
                 
                   
         
            
            ],[],[
          'name_ar'=>trans('admin.name_ar'),
            'name_en'=>trans('admin.name_en'),
            'city_id'=>trans('admin.city_id'),
             
            


            ]);

 
             

         $stats=stat::create($data);

        

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
       stat::where('id',$id)->delete();
        
    session()->flash('success', __('success'));

          return redirect('/admin/states');
        
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
          $post=stat::where('id',$id)->first();
        return view('admin.stats.edite',compact('post'));

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
                'city_id' => 'required',
               
                 
                   
         
            
            ],[],[
          'name_ar'=>trans('admin.name_ar'),
            'name_en'=>trans('admin.name_en'),
            'city_id'=>trans('admin.city_id'),
            'country_id'=>trans('admin.country_id'),
             
            


            ]);
 
             

         $stats=stat::where('id',$id)->update($data);

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

    

     public function get_city()
    {  
        if (request()->ajax()) 
                 {

                    if (request()->has('country_id'))
                     {
              

           $select=request()->has('select')?request('select'):'';          

  $output=Form::select('city_id',city::where('country_id',request('country_id'))->pluck('name_ar','id'),$select,['class'=>'form-control city_id',"placeholder"=>"........"] );


              return   $output ;

                  }  

                  else
                  {
                
                   $select=request()->has('select')?request('select'):'';          

 return Form::select('stat_id',states::where('city_id',request('city_id'))->pluck('states_name_en','id'),$select,['class'=>'form-control',"placeholder"=>"........"] );

                 

                  }




                    }
           
                    
 
                  
       
      
    }
}
