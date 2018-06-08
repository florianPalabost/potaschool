<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvancementExercicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avancement_exercices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idEleve');
            $table->integer('idEx');
            $table->integer('scoreAct');
            $table->integer('meilleurScore');
            $table->integer('nbErreur');
            $table->timestamps();

            $table->unique(['idEleve', 'idEx']);
            $table->foreign('idEx')->references('id')->on('exercices')->onDelete('cascade');
            $table->foreign('idEleve')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avancement_exercices');
    }
}
