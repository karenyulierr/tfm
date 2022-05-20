<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTouristSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tourist_sites', function (Blueprint $table) {
            $table->string('main_image')->after('phone');
            $table->string('address')->after('main_image');
            $table->string('latitude')->after('address');
            $table->string('longitude')->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tourist_sites', function (Blueprint $table) {
            //
        });
    }
}
