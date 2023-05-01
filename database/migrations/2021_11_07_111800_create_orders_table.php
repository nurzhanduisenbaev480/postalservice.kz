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

            $table->string('order_code');
            $table->string('from_name');
            $table->string('from_company');
            $table->string('from_city');
            $table->string('from_address');
            $table->string('from_phone');
            $table->string('to_name')->nullable();
            $table->string('to_company')->nullable();
            $table->string('to_city')->nullable();
            $table->string('to_address')->nullable();
            $table->string('to_phone')->nullable();
            $table->string('type');
            $table->string('speed');
            $table->string('payment');
            $table->string('payment_type');
            $table->text('description');
            $table->integer('status_id');
            $table->integer('author');
            $table->integer('courier_id')->nullable();
            $table->bigInteger('install_price')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
