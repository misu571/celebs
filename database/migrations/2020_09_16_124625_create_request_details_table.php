<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('submit_by')->unsigned();
            $table->bigInteger('talent_id')->unsigned();
            $table->string('to');
            $table->string('from');
            $table->enum('pronoun', ['She/Her', 'He/Him', 'They/Them', 'Other']);
            $table->enum('occasion', ['None', 'Birthday', 'Anniversary', 'Give Thanks', 'Wedding', 'Gift', 'Announcement', 'Roast', 'Get advice', 'Question', 'Pep talk', 'Just cuz']);
            $table->longText('instruction');
            $table->boolean('hide');
            $table->bigInteger('payment_id')->unsigned()->unique();
            $table->string('video')->default('0');
            $table->enum('status', ['NOT Verified', 'Pending', 'Submitted', 'Rejected']);
            $table->enum('rate', [0, 1, 2, 3, 4, 5])->default(0);
            $table->string('comment', 100)->nullable()->default('0');
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
        Schema::dropIfExists('request_details');
    }
}
