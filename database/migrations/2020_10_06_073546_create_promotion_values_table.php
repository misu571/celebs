<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_values', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('promo_id')->unsigned()->unique();
            $table->integer('base_value')->unsigned()->nullable();
            $table->integer('percent')->unsigned()->nullable();
            $table->integer('max_value')->unsigned()->nullable();
            $table->integer('min_value')->unsigned()->nullable();
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
        Schema::dropIfExists('promotion_values');
    }
}
