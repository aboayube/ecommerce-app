<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('name_en');
            $table->String('phone');
            $table->String('country');
            $table->String('city_governorate');
            $table->String('district_district'); //منطقة/الحي
            $table->String('street');
            $table->String('gada');
            $table->String('house_building');
            $table->String('floor_apartment');
            $table->String('special_mark');





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
        Schema::dropIfExists('vendors');
    }
}
