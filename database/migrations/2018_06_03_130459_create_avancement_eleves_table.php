<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvancementElevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avancement_eleves', function (Blueprint $table) {
            $table->integer('idEleve');
            $table->integer('idClasse');
            $table->integer('idCours');
            $table->integer('scoreActuel');
            $table->integer('scoreMax');
            $table->timestamps();
            $table->primary(['idEleve', 'idClasse','idCours']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avancement_eleves');
    }
}
