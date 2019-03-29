<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availables', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('available')->default(1);
            $table->integer('idQuizz');
            $table->integer('idUser')->default(null)->nullable();
            $table->timestamps();

            $table->foreign('idQuizz')->references('id')->on('quizzes')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availables');
    }
}
