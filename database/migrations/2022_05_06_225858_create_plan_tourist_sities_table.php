<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTouristSitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_tourist_sities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_tourist_id');
            $table->unsignedBigInteger('tourist_sities_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('plan_tourist_id')->references('id')->on('plan_tourist');
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
        Schema::dropIfExists('plan_tourist_sities');
    }
}
