<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponses', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('numQuestion');
            $table->integer('idQuizz');
            $table->integer('idUser');
            $table->integer('idPossibilites')->nullable();
            $table->string('reponseSimple')->nullable();
            $table->timestamps();

            $table->foreign('idQuizz')->references('id')->on('quizzes')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('idPossibilites')->references('id')->on('possibilites')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reponses');
    }
}
