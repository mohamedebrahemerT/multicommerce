<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOption extends Model
{
    
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','multy_tasking_employee','limit_booking','allow_employee_selection','disable_slot_duration','disable_slot_duration_values'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
