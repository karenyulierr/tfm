<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('state',['active','inactive']);
            $table->unsignedBigInteger('plan_tourist_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            //Relations
            $table->foreign('plan_tourist_id')->references('id')->on('plan_tourist');
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
        Schema::dropIfExists('plan_images');
    }
}
