<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonNosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_nos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('season_id')->unsigned();
            $table->foreign('season_id')->references('id')->on('seasons')->onUpdate('cascade')->onDelete('cascade');
            $table->string('season_no');
            $table->integer('status');
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
        Schema::dropIfExists('season_nos');
    }
}
