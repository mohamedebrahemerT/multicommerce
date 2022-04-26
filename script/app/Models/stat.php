<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stat extends Model
{
    use HasFactory;


  protected $fillable =[

        "name_ar","name_en","country_id","city_id"
    ];

    function country()
   {
               return $this->hasOne('App\Models\country','id','country_id');
   }

   function city()
   {
               return $this->hasOne('App\Models\city','id','city_id');
   }


}
