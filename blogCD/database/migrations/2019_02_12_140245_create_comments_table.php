<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser');
            $table->text('text');
            $table->integer('idSujet');
            $table->text('debut')->nullable();
            $table->integer('reponse')->nullable();
            $table->timestamps();

             $table->foreign('idUser')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');

             $table->foreign('idSujet')->references('id')->on('sujets')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
