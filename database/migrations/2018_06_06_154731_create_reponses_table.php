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
            $table->integer('idExo');
            $table->string('typeRep');
            $table->string('reponse');
            $table->string('choix2')->nullable();
            $table->string('choix3')->nullable();
            $table->string('choix4')->nullable();
            $table->timestamps();
            $table->unique(['id', 'idExo']);
            $table->foreign('idExo')->references('id')->on('exercices')->onDelete('cascade');
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
