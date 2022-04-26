<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id') ;
            $table->unsignedBigInteger('service_id') ;
             
            $table->foreign('employee_id')
            ->references('id')->on('users')
            ->onDelete('cascade'); 

            $table->foreign('service_id')
            ->references('id')->on('terms')
            ->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_services');
    }
}
