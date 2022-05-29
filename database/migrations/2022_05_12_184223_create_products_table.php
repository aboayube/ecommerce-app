<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->string('image');
            $table->string('product_number');
            $table->string('discription');
            $table->string('discription_en');
            $table->string('url');
            $table->string('count');
            $table->string('vendor_name');
            $table->string('country');
            $table->string('city');
            $table->string('phone');
            $table->string('whatsapp');
            $table->string('type');
            $table->enum('status', [0, 1])->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
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
        Schema::dropIfExists('products');
    }
}
