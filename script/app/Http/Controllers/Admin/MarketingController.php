<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Option;
use Cache;
use Auth;
class MarketingController extends Controller
{
     public function __construct() {
           
        $this->middleware('AdminRole:marketing_show', [
            'only' => ['index', 'show'],
        ]);
        $this->middleware('AdminRole:marketing_add', [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('AdminRole:marketing_edit', [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('AdminRole:marketing_delete', [
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

        if (!Auth()->user()->can('marketing.tools')) {
            return abort(401);
        }
        $info=Option::where('key','marketing_tool')->first();
        $info=json_decode($info->value ?? '');
        return view('admin.marketing.index',compact('info'));
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

            'file' => 'mimes:json|max:50',

        ]);
        if ($request->file) {
           $path='uploads/';
           $fileName = 'service-account-credentials.'.$request->file->extension();
           $request->file->move($path,$fileName);
       }

        $info=Option::where('key','marketing_tool')->first();
        if (empty($info)) {

            $data['ga_measurement_id']=$request->ga_measurement_id ?? '';
            $data['analytics_view_id']=$request->analytics_view_id ?? '';
            $data['google_status']=$request->google_status ?? '';
            $data['fb_pixel']=$request->fb_pixel ?? '';
            $data['fb_pixel_status']=$request->fb_pixel_status ?? '';
            $data['ChatCode']=$request->ChatCode ?? '';
           
            $data['PixcelInsta']=$request->PixcelInsta ?? '';
            $data['PixcelTwiter']=$request->PixcelTwiter ?? '';
            $data['PixcelSnap']=$request->PixcelSnap ?? '';
            $data['PixcelTecToc']=$request->PixcelTecToc ?? '';

            $info=new Option;
            $info->key="marketing_tool";
        }
        else{
            $old=json_decode($info->value);

            $data['ga_measurement_id']=$request->ga_measurement_id ?? $old->ga_measurement_id;
            $data['analytics_view_id']=$request->analytics_view_id ?? $old->analytics_view_id;
            $data['google_status']=$request->google_status ?? $old->google_status;
            $data['fb_pixel']=$request->fb_pixel ?? $old->fb_pixel;
            $data['fb_pixel_status']=$request->fb_pixel_status ?? $old->fb_pixel_status;

            $data['ChatCode']=$request->ChatCode ?? '';
 
            $data['PixcelInsta']=$request->PixcelInsta ?? '';
            $data['PixcelTwiter']=$request->PixcelTwiter ?? '';
            $data['PixcelSnap']=$request->PixcelSnap ?? '';
            $data['PixcelTecToc']=$request->PixcelTecToc ?? '';


        }

        $info->value=json_encode($data);
        $info->save();

        Cache::forget('marketing_tool');
//        return response()->json(['Tools Updated']);
        return response()->json([trans('success')]);
    }


}
