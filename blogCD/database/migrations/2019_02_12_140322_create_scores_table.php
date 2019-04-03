<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser');
            $table->integer('idQuizz');
            $table->integer('score');
            $table->integer('numTentative');
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('idQuizz')->references('id')->on('quizzes')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
