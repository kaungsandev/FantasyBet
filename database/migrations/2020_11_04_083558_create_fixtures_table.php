<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->string('matchday');
            $table->string('homeTeam');
            $table->string('awayTeam');
            $table->string('time');
            $table->string('result')->default("Vs");
            $table->string('winner')->default('unknown');
            $table->string('status')->default("UpComing");
            $table->float('team1_point', 4, 2)->default(0.96);
            $table->float('team2_point', 4, 2)->default(0.96);
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
        Schema::dropIfExists('fixtures');
    }
}
