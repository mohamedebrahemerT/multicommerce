<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->date('order_date')->nullable();
            $table->time('order_time')->nullable();
            $table->string('coupons_code')->nullable();
            $table->enum('coupons_type',['rate','value'])->nullable();
            $table->decimal('coupons_value', $precision = 8, $scale = 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_date');
            $table->dropColumn('order_time');
            $table->dropColumn('coupons_code');
            $table->dropColumn('coupons_type');
            $table->dropColumn('coupons_value');
        });
    }
}
