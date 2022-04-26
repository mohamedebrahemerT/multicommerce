<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Review;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts=Review::where('shop_id', getUserId())->with('post')->latest()->paginate(20);


         foreach ($posts as $key => $post)
          {
             $post->status='1';
             $post->save();
             
         }
        return view('seller.review.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //

           $Review=Review::
           where('id', $id)->
           where('shop_id', getUserId())
           ->with('post')->first();

           $Review->status='1';
             $Review->save();
        return view('seller.review.edit',compact('Review'));

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
        //
              $data= $this->validate(request(),[
               'comment' => ['required', 'string', 'max:255'],
        
            
            ],[],[
          'comment'=>trans('admin.comment'),
 


            ]);

 
             

         $Review=Review::where('id',$id)->update($data);

       
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
        
      if($request->method == 'delete')
      {
        if($request->ids)
        {
            foreach($request->ids as $id)
            {
                Review::where('shop_id',getUserId())->where('id',$id)->delete();
            }
        }
         
      }

//      return response()->json('Review Deleted');
        return response()->json([trans('success')]);
    }
}
