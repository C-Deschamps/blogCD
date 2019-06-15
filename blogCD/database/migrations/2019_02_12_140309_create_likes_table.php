<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idSujet');
            $table->integer('idUser');
            $table->integer('idComment');
            $table->integer('idQuizz');
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');

             $table->foreign('idSujet')->references('id')->on('sujets')->onDelete('restrict')->onUpdate('restrict');
             $table->foreign('idComment')->references('id')->on('comments')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('likes');
    }
}
