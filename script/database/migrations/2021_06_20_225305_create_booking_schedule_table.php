<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_schedule', function (Blueprint $table) {
            $table->id();
           
            $table->string('day')->nullable() ;
            $table->time('open_time')->nullable() ;
            $table->time('close_time')->nullable() ;
            $table->enum('allow_booking',['1','0'])->default('1') ;
            $table->tinyInteger('slot_duration')->default(0) ;
            $table->enum('allow_multiple_booking',['1','0'])->default('1') ;
            $table->tinyInteger('max_booking_allowed')->nullable() ;
            $table->enum('status',['1','0'])->default('1') ;
            // $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_schedule');
    }
}
