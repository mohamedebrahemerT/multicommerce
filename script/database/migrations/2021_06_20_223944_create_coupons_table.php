<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('use_limit')->default(0);
            $table->string('coupons_code');
            $table->enum('coupons_type', ['rate', 'value']);
            $table->decimal('coupons_value', $precision = 8, $scale = 2)->default(0.00);
            $table->decimal('minimun_purchase_amount', $precision = 8, $scale = 2)->nullable();
            $table->string('days_applied')->nullable();
            $table->enum('status', ['1', '0'])->default(1);
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
        Schema::dropIfExists('coupons');
    }
}
