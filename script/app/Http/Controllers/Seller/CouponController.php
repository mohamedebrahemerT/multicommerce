<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Auth;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $posts=Category::where('user_id',getUserId())->where('type','coupon')->latest()->paginate(20);
        return view('seller.coupon.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('seller.coupon.create');
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
        $posts_count=\App\Term::where('user_id',getUserId())->count();
         if ($limit['product_limit'] <= $posts_count) {
         \Session::flash('error', trans('Maximum posts limit exceeded'));
         $error['errors']['error']=trans('Maximum posts limit exceeded');
         return response()->json($error,401);
        }

         if ($limit['storage_limit'] <= str_replace(',', '', folderSize('uploads/'.getUserId()))) {
         \Session::flash('error', trans('Maximum storage limit exceeded'));
         $error['errors']['error']=trans('Maximum storage limit exceeded');
         return response()->json($error,401);
        }
              
       $validatedData = $request->validate([
        'coupon_code' => 'required|max:50',
        'date' => 'required|max:50',
        'percent' => 'required|max:2',

      ]);
         $Category=Category::where('user_id',getUserId())->where('name',$request->coupon_code)->first();
                         if ($Category) 
                         {
                            if ($Category->count() > 0)
                 {
        return response()->json([trans('Coupon already exists')]);
                    
                }
                         }

                 
        $post=new Category;
        $post->name=$request->coupon_code;
        $post->slug=$request->date;
        $post->type='coupon';
        $post->user_id=getUserId();
        $post->featured=$request->percent;
        $post->save();

//        return response()->json(['Coupon Created']);
        return response()->json([trans('success')]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info= Category::where('user_id',getUserId())->findOrFail($id);

        return view('seller.coupon.edit',compact('info'));
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
        'coupon_code' => 'required|max:50',
        'date' => 'required|max:50',
        'percent' => 'required|max:2',

      ]);

        $post= Category::where('user_id',getUserId())->findOrFail($id);
        $post->name=$request->coupon_code;
        $post->slug=$request->date;
        $post->type='coupon';
        $post->featured=$request->percent;
        $post->save();

//        return response()->json(['Coupon Updated']);
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
         $auth_id=getUserId();
        if ($request->method=='delete') {
           foreach ($request->ids as $key => $id) {
               $post = Category::where('user_id',$auth_id)->findorFail($id);
               $post->delete();
           }
        }

//        return response()->json(['Coupon Deleted']);
        return response()->json([trans('success')]);
    }
}
