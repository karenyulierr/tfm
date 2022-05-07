<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('start_time');
            $table->string('end_time');
            $table->enum('state',['active','inactive']);
            $table->unsignedBigInteger('tourist_sities_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            //Relations
            $table->foreign('tourist_sities_id')->references('id')->on('tourist_sites');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
