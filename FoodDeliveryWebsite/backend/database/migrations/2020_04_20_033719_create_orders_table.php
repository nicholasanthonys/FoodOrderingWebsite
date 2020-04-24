<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->bigInteger('total_price');
            $table->string('order_status');
            $table->tinyInteger('paid');
            $table->timestamp('order_time');
            $table->timestamp('shipped_time')->nullable();

        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('customer')
                ->references('email')
                ->on('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
