<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('email')->unique();
            $table->string('slug')->unique();
            $table->string('type')->nullable();
            $table->string('phone')->nullable();
            $table->enum('genders',['Male','Female','Other'])->nullable();
            $table->boolean('banned')->default(false); // User cannot login if banned
            $table->string('avatar')->default('images/avatar.jpg');
            $table->timestamp('login_time')->nullable();
            $table->string('fb_id')->nullable(); //for social login
            $table->string('google_id')->nullable(); //for social login
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('code')->nullable();
            $table->string('device_token')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->longText('bio')->nullable();
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('address')->nullable();
            $table->string('designation')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('website')->nullable();
            $table->longText('abount_me')->nullable();
            
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
};
