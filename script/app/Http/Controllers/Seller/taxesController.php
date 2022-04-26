<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Useroption;

class taxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user_id=getUserId();
  $taxes= Useroption::where('user_id',$user_id)->where('key','tax')->paginate(10);

        return view('seller.taxes.index',compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('seller.taxes.create');
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
       $validatedData = $request->validate([
        'name' => 'required|max:50',
        'value' => 'required|max:50',
       ]);

               if ($request->status == 'on') 
               {
                    $status=1;
               }
               else
               {
                    $status=0;

               }
              

                $Useroptionvat=new Useroption;
                $Useroptionvat->key='tax';
                $Useroptionvat->name=$request->name;
                $Useroptionvat->value=$request->value;
                $Useroptionvat->status=$status;
                $Useroptionvat->user_id=getUserId();
                $Useroptionvat->save();


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
   

  $tax=Useroption::where('user_id',getUserId())->findorFail($id);
        return view('seller.taxes.edit',compact('tax'));
         
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
        'name' => 'required|max:50',
        'value' => 'required|max:50',
       ]);

               if ($request->status == 'on') 
               {
                    $status=1;
               }
               else
               {
                    $status=0;

               }

    $Useroptionvat = Useroption::where('user_id',getUserId())->findorFail($id);
               $Useroptionvat->key='tax';
                $Useroptionvat->name=$request->name;
                $Useroptionvat->value=$request->value;
                $Useroptionvat->status=$status;
                $Useroptionvat->user_id=getUserId();
                $Useroptionvat->save();
        return response()->json([trans('success')]);

       return response()->json(['location Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {  

             
        $auth_id=getUserId();
        if ($request->method=='delete') {
           foreach ($request->ids as $key => $id) {
               $post = Useroption::findorFail($id);
               $post->delete();
           }
        }

//        return response()->json(['Success']);
        return response()->json([trans('success')]);
    }

    public function update_Actived(Request $request)
                 {
             
           $request->status ;
         $user = Useroption::where('id', $request->id)->first();
          $user->status=$request->status;
               $user->save();
         
         $user = Useroption::where('id', $request->id)->first();

          return 1;
              }
    

}
