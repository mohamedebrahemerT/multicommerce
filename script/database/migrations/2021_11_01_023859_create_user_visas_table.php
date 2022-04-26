<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_visas', function (Blueprint $table) {
            $table->id();
                       $table->string('CardNum');
                       $table->string('CardName');
                       $table->string('expir');
                       $table->string('code');

                         $table->unsignedBigInteger('user_id')->nullable();
            
              $table->foreign('user_id')
            ->references('id')->on('users')
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
        Schema::dropIfExists('user_visas');
    }
}
