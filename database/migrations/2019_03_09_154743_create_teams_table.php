<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create teams table
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name')->unique();
            $table->timestamps();
        });

        // add team to user
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('team_id');

            // relations
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_team_id_foreign');
            $table->dropColumn('team_id');
        });
        Schema::dropIfExists('teams');
    }
}
