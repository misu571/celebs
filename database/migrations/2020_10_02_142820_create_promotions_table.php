<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->unique();
            $table->enum('discount_type', ['Cash', 'Item']);
            $table->string('thumbnail')->nullable();
            $table->string('details')->nullable();
            $table->timestamp('valid_from')->default(now());
            $table->timestamp('valid_until')->nullable();
            $table->bigInteger('uses_limit')->unsigned()->default(1);
            $table->boolean('enable')->default(false);
            $table->bigInteger('created_by')->unsigned();
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
        Schema::dropIfExists('promotions');
    }
}
