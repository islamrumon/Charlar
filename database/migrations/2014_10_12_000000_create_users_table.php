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
            $table->longText('avatar')->nullable();
            $table->timestamp('login_time')->nullable();
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
            // $table->string('state')->nullable();

            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twiter')->nullable();
            $table->string('instragram')->nullable();
            // $table->string('tiktok')->nullable();
            $table->string('whats_app')->nullable();
            $table->string('telegram')->nullable();
            $table->longText('cover')->nullable();
            
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
