<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terms', function (Blueprint $table) {

            $table->time('time_required')->nullable() ;
            $table->unsignedBigInteger('employee_id')->nullable() ;
            $table->unsignedBigInteger('location_id')->nullable() ;

            $table->foreign('employee_id')
            ->references('id')->on('users')
            ->onDelete('set null'); 

            $table->foreign('location_id')
            ->references('id')->on('categories')
            ->onDelete('set null'); 
  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('terms', function (Blueprint $table) {
            // $table->dropForeign(['employee_id']);
            $table->dropForeign(['location_id']);
         
        });
        Schema::table('terms', function (Blueprint $table) {
            $table->dropColumn('time_required');
            $table->dropColumn('employee_id');
            $table->dropColumn('location_id');
         
        });
    }
}
