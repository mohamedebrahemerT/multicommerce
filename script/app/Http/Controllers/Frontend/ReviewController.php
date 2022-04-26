<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Order;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$id,$order_id)
    {
               $order_id=Request('order_id');
              $Order=Order::where('id',$order_id)->first();

              if  ($Order->status != 'completed') 
              {
                   session()->flash('danger',__('Comments can only be made after receiving the request'));

                     return back();
              }


        $id=request()->route()->parameter('id');
        $validated = $request->validate([
            'shop_id' => 'required',
            'name' => 'required|max:30',
            'rating' => 'required|max:30',
            'email' => 'required|email|max:30',
            'comment' => 'max:250',
        ]);

        $user_id=auth()->user()->id;
                $Reviewcount = Review::where('user_id',$user_id)->where('term_id',request('id'))->count();

                if ($Reviewcount > 1 ) 
                {
            session()->flash('danger',__('This product has already been rated'));

                     return back();
                }
        $rating = new Review;
        $rating->user_id = $user_id;
        $rating->term_id = request('id');
        $rating->rating = $request->rating;
        $rating->name = $request->name;
        $rating->email = $request->email;
        $rating->comment = $request->comment;
        $rating->shop_id = $request->shop_id;
        $rating->save();
    session()->flash('success', __('Thanks For Your Review'));


    return redirect('user/order/view/'.request('order_id'));

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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        //

          $data = $request->validate([
           
            'comment' => 'max:250',
        ]);

             Review::where('id',$request->Review_id)->update($data);

              session()->flash('success', __('Thanks For Your Review'));


                 return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        //

          $id= request('id');
           $Review = Review::findorFail($id);
               $Review->delete();
              session()->flash('danger', __('deleted'));
               return redirect('user/reviews');
       
    }

    public function reviews($value='')
    {
        $user_id=auth()->user()->id;
              
          $reviews = Review::where('user_id',$user_id)->get();
                     return view( base_view() . '.account.reviews',compact('reviews'));
        
    }
}
