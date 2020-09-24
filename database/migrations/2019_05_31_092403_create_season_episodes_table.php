<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_episodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('episode_title');
            $table->string('episode_description');
            $table->string('episode_duration');
            $table->string('episode_link');
            $table->string('episode_link_trailor');
            $table->integer('season_id')->unsigned();
            $table->foreign('season_id')->references('id')->on('seasons')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('season_no_s')->unsigned();
            $table->foreign('season_no_s')->references('id')->on('season_nos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('status');
            $table->integer('delete_status');
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
        Schema::dropIfExists('season_episodes');
    }
}
