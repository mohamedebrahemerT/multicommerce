<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTermsChangeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terms', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            
        });
        Schema::table('terms', function (Blueprint $table) {
           
            $table->string('employee_id')->nullable()->change();
            $table->integer('time_required')->nullable()->change();
            $table->string('time_type')->nullable() ;
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
            $table->dropColumn(['time_type']);
        });
    }
}
