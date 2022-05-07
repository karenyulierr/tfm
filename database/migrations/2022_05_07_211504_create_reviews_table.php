<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name_person');
            $table->string('email')->uniqid();
            $table->enum('stars',['0','1','2','3','4','5']);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('tourist_sities_id');
            $table->timestamps();
            //Relations
            $table->foreign('tourist_sities_id')->references('id')->on('tourist_sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
