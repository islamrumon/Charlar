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
        Schema::create('callings', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['audio_call','video_call']);
            $table->bigInteger('message_id');
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->boolean('call_drop')->default(0); // active deactive status ar maddome call manage kora jete pare like internet check
            $table->string('from_token')->nullable();
            $table->string('to_token')->nullable();
            $table->string('channel')->nullable();

            $table->bigInteger('from_id'); //host
            $table->bigInteger('to_id'); //attendes

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
        Schema::dropIfExists('callings');
    }
};
