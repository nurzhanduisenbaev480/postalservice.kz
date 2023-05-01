<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverheadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overheads', function (Blueprint $table) {
            $table->id();

            $table->string('overhead_code');
            $table->integer('order_id')->nullable();

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



            $table->bigInteger('mass')->nullable();
            $table->bigInteger('volume')->nullable();

            $table->bigInteger('length')->nullable();
            $table->bigInteger('width')->nullable();
            $table->bigInteger('height')->nullable();
            $table->bigInteger('place')->nullable();

            $table->text('description')->nullable();
            $table->integer('author');

            $table->date('date_s');
            $table->date('date_e');

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
        Schema::dropIfExists('overheads');
    }
}
