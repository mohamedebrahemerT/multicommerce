<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Categorymeta;
use Str;
use Auth;
class GalleryController extends Controller
{

   public function __construct() {
           
        $this->middleware('AdminRole:Gallery_show', [
            'only' => ['index', 'show'],
        ]);
        $this->middleware('AdminRole:Gallery_add', [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('AdminRole:Gallery_edit', [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('AdminRole:Gallery_delete', [
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
        if (!Auth()->user()->can('gallery.list')) {
        return abort(401);
        }
        $posts=Category::where('is_admin',1)->where('type','gallery')->with('preview')->latest()->paginate(20);
        return view('admin.gallery.index',compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth()->user()->can('gallery.create')) {
        return abort(401);
        }
       $validatedData = $request->validate([
        'name_ar' => 'required|max:255',
        'name_en' => 'required|max:255',
        'file' => 'required|image|max:1000',
        ]);
        if(isset($request->name_ar) || isset($request->name_en)){
            $name = json_encode([
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ]);
            $slug = json_encode([
                'ar' => Str::slug($request->name_ar),
                'en' => Str::slug($request->name_en),
            ]);
        }

       //$slug=Str::slug($request->name);
       $check=Category::where('is_admin',1)->where('type','gallery')->where('slug',$slug)->count();
       if ($check > 0 ) {
           $slug=$slug.$check;
       }
       $category=new Category;
       $category->name=$name;
       $category->slug=$slug;
       $category->is_admin=1;
       $category->user_id=getUserId();
       $category->type='gallery';
       $category->save();

       $fileName = time().'.'.$request->file->extension();
       $request->file->move('uploads/admin/1/'.date('Y/m/'), $fileName);

       $meta=new Categorymeta;
       $meta->category_id =$category->id;
       $meta->type ='preview';
       $meta->content ='uploads/admin/1/'.date('Y/m/').$fileName;
       $meta->save();

//       return response()->json(['Gallery Created']);
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
        if ($request->status=='delete') {
            if ($request->ids) {
                foreach ($request->ids as $id) {
                   $row=Category::with('preview')->find($id);
                   if (file_exists($row->preview->content)) {
                       unlink($row->preview->content);
                   }
                   $row->delete();
                }
            }
        }
//        return response()->json('Success');
        return response()->json([trans('success')]);
    }
}
