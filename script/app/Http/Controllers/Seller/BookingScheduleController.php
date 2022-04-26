<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\BookingSchedule;
use App\BookingOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 

class BookingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $booking_schedules = BookingSchedule::where('user_id',getUserId())->get();
        $booking_options = BookingOption::where('user_id',getUserId())->first();
        if(sizeof($booking_schedules) == 0){
            $booking_schedules =  $this->createDefaultSchedule() ;
        }
        if(!$booking_options){
            $booking_options = $this->createDefaultOption() ;
        }
       
        return view('seller.booking_schedules.index', compact('booking_schedules','booking_options'));
    }

    public function createDefaultSchedule(){
        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'] ;
        $data = [] ;
        $data['user_id'] = getUserId() ;
        $data['open_time'] = "07:30" ;
        $data['close_time'] = "22:29" ;
        $data['allow_booking'] = "1";
        $data['slot_duration'] = "60" ;
        $data['allow_multiple_booking'] = "1" ;
        $data['max_booking_allowed'] = "5" ;
        $data['status'] = "1" ;

        foreach($days as $day){
            $data['day'] = $day ;
            BookingSchedule::create($data);
        }
        return BookingSchedule::where('user_id',getUserId())->get();
    }

    public function createDefaultOption(){
       
        $data = [] ;
        $data['user_id'] = getUserId() ;
        $data['multy_tasking_employee'] = "1" ;
        $data['limit_booking'] = "1";
        $data['allow_employee_selection'] = "1";
        $data['disable_slot_duration'] = "1" ;
        $data['disable_slot_duration_values'] = "sum" ;
  
        BookingOption::create($data);
      
        return BookingOption::where('user_id',getUserId())->first();
    }
 
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking_schedule =  BookingSchedule::where('id',$id)->first();
        return view('seller.booking_schedules.edit', compact('booking_schedule'));
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
        // Validation Data
        // $request->validate([
        //     'name' => 'required|max:100|unique:roles,name,' . $id
        // ], [
        //     'name.requried' => 'Please give a role name'
        // ]);

        $booking_schedule = BookingSchedule::find($id);
        $booking_schedule->update($request->all());
    
        return response()->json([trans('success')]);
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBookingOption(Request $request, $id)
    {
        if(!$request->multy_tasking_employee){
            $request['multy_tasking_employee'] = "0" ;
        }
        if(!$request->allow_employee_selection){
            $request['allow_employee_selection'] = "0" ;
        }
        if(!$request->disable_slot_duration){
            $request['disable_slot_duration'] = "0" ;
        }
        $booking_option = BookingOption::find($id);
        $booking_option->update($request->all());
        
        return response()->json([trans('success')]);
    }
    
     
}
