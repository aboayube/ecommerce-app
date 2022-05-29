<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductdetialsInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productdetials_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('input1')->default("مقاس");
            $table->string('input1_en')->default("measuring");
            $table->string('input2')->default("شكل");
            $table->string('input2_en')->default("appearance");


            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('productdetials_inputs');
    }
}
