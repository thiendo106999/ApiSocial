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
            $table->integer('user_id');
            $table->string('phone_number');
            $table->string('address');
            $table->string('image');
            $table->string('date');
            $table->integer('hexta');     
            $table->integer('kind_id');       
            $table->timestamps();

            $table->foreign('kind_id')->references('id')->on('type_of_agricultural_products')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('user_infos')->cascadeOnDelete();
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
