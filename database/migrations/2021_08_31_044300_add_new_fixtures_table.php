<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures',function(Blueprint $table){
            $table->integer('event');
            $table->boolean('finished')->default(false);
            $table->dateTime('kickoff_time');
            $table->boolean('started')->default(false);
            $table->string('home_team');
            $table->string('away_team');
            $table->integer('home_team_score');
            $table->integer('away_team_score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
