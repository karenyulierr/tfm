<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserAdminToTouristSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('tourist_sites', function (Blueprint $table) {
            $table->integer('user_admin')->after('state');
            $table->string('start_time')->after('user_admin');
            $table->string('end_time')->after('start_time');
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
