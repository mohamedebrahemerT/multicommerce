<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Categorymeta;
use Auth;
use Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Category::where('user_id',getUserId())->where('type','category')->with('preview')->latest()->paginate(20);
        return view('seller.category.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $limit  =user_limit();
         $posts_count=\App\Category::where('user_id',getUserId())->where('type','category')->count();
       
        if ($limit['category_limit'] <= $posts_count) {

         $error['errors']['error']=trans('Maximum category limit exceeded');
         return response()->json($error,401);
        }
       
         if ($limit['storage_limit'] <= str_replace(',', '', folderSize('uploads/'.getUserId()))) {
         \Session::flash('error', trans('Maximum storage limit exceeded'));
         $error['errors']['error']=trans('Maximum storage limit exceeded');
         return response()->json($error,401);
        }

        $validated = $request->validate([
            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'file' => 'image|max:500',
        ]);

        $slug=Str::slug($request->name_en);

        $user_id=getUserId();

        $name = json_encode([
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ]);
//        $slug = json_encode([
//            'ar' => Str::slug($request->name_ar),
//            'en' => Str::slug($request->name_en),
//        ]);

        $category= new Category;
        $category->name=$name;
        $category->slug=$slug;
        if ($request->p_id) {
           $category->p_id=$request->p_id;
        }

        $category->featured=$request->featured;
        $category->menu_status=$request->menu_status;
        $category->user_id=$user_id;
        $category->save();

        if($request->file){

            $fileName = time().'.'.$request->file->extension();
            $path='uploads/'.$user_id.'/'.date('y/m');
            $request->file->move($path, $fileName);
            $name=$path.'/'.$fileName;

            $meta= new Categorymeta;
            $meta->category_id =$category->id;
            $meta->type="preview";
            $meta->content=$name;
            $meta->save();

        }

//        return response()->json(['Category Created']);
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
        $info= Category::where('user_id',getUserId())->findOrFail($id);
        return view('seller.category.edit',compact('info'));
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
        $validated = $request->validate([
            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'file' => 'image|max:500',
        ]);
        $user_id=getUserId();

        $category= Category::where('user_id',$user_id)->with('preview')->findOrFail($id);

        $name = json_encode([
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ]);

        $category->name=$name;

        if ($request->p_id) {
           $category->p_id=$request->p_id;
        }

        $category->featured=$request->featured;
        $category->menu_status=$request->menu_status;
        $category->save();

        if($request->file){
            $limit=user_limit();
            if ($limit['storage_limit'] <= str_replace(',', '', folderSize('uploads/'.getUserId()))) {
               \Session::flash('error', trans('Maximum storage limit exceeded'));
               $error['errors']['error']=trans('Maximum storage limit exceeded');
               return response()->json($error,401);
            }

            if(!empty($category->preview)){
                if(file_exists($category->preview->content)){
                    unlink($category->preview->content);
                }
            }

            $fileName = time().'.'.$request->file->extension();
            $path='uploads/'.$user_id.'/'.date('y/m');
            $request->file->move($path, $fileName);
            $name=$path.'/'.$fileName;
            $meta =  Categorymeta::where('category_id',$category->id)->where('type','preview')->first();
            if (empty($meta)){
              $meta= new Categorymeta;
            }

            $meta->category_id =$category->id;
            $meta->type="preview";
            $meta->content=$name;
            $meta->save();

        }

//        return response()->json(['Category Updated']);
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
        if ($request->type=='delete') {
            foreach ($request->ids as $key => $row) {
                $id=base64_decode($row);
                $category= Category::destroy($id);
            }
        }

//        return response()->json(['Category Deleted']);
        return response()->json([trans('success')]);
    }
}
