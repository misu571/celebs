<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 35)->unique();
            $table->string('username', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('0');
            $table->enum('type', ['0', '1'])->default('0');
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('post_code')->nullable();
            $table->string('provider_id')->default('0');
            $table->string('provider_name')->default('0');
            $table->boolean('status')->default(false);
            $table->string('status_changed_by')->nullable();
            $table->timestamp('status_changed_at')->nullable();
            $table->boolean('subscribe')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
