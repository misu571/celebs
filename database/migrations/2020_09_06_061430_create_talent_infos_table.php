<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talent_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->string('about_me')->nullable();
            $table->enum('rating', [0, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5])->default(0);
            $table->string('intro_video')->nullable();
            $table->integer('vid_price')->unsigned()->default(0);
            $table->integer('chat_price')->unsigned()->default(0);
            $table->tinyInteger('cut_ratio')->unsigned()->default(75);
            $table->double('total_income', 15, 8)->unsigned()->default(0);
            $table->double('total_withdrawal', 15, 8)->unsigned()->default(0);
            $table->string('currency', 11)->default('BDT');
            $table->smallInteger('response_time')->unsigned()->default(3);
            $table->bigInteger('category_id')->unsigned()->default(1);
            $table->boolean('feature')->default(false);
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('acc_name')->nullable();
            $table->string('acc_id')->nullable();
            $table->string('swift_code')->nullable();
            $table->boolean('available')->default(true);
            $table->longText('follower_id_list')->nullable();
            $table->text('notify_id_list')->nullable();
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
        Schema::dropIfExists('talent_infos');
    }
}
