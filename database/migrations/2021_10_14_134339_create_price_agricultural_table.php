<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceAgriculturalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_agricultural', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('kind');
            $table->string('price');
            $table->string('province')->nullable();
            $table->string('date');
            $table->timestamps();
            $table->foreign('kind')->references('id')->on('type_of_agricultural_products');
            $table->unique(['name', 'province', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_agricultural');
    }
}
