<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristSiteServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_site_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourist_site_id');
            $table->unsignedBigInteger('service_id');
            $table->enum('start_day',['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo','Todos los días','Entre semana','Los fines de semana']);
            $table->enum('end_day',['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo','Todos los días','Entre semana','Los fines de semana']);
            $table->string('value');
            $table->enum('state',['active','inactive']);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            //Relations
            $table->foreign('tourist_site_id')->references('id')->on('tourist_sites');
            $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('tourist_site_services');
    }
}
