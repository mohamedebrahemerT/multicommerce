<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSchedule extends Model
{
    
    protected $table = 'booking_schedule' ;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','day','open_time','close_time','allow_booking','slot_duration','allow_multiple_booking','max_booking_allowed','status'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
