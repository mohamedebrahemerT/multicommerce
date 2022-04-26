<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_options', function (Blueprint $table) {
            $table->id();
           
            $table->enum('multy_tasking_employee',['1','0'])->default('0');
            $table->integer('limit_booking')->default('0')->nullable();
            $table->enum('allow_employee_selection',['1','0'])->default('0');
            $table->enum('disable_slot_duration',['1','0'])->default('0');
            $table->enum('disable_slot_duration_values',['sum','avg','min','max'])->nullable();
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
        Schema::dropIfExists('booking_options');
    }
}
