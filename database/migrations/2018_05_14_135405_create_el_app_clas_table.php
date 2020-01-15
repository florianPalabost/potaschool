<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElAppClasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('el_app_clas', function (Blueprint $table) {
            $table->integer('idEleve');
            $table->integer('idClasse');
            $table->timestamps();

            $table->primary('idEleve');
            $table->foreign('idClasse')->references('id')->on('classes');
        });
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn('listEleves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('el_app_clas');
        $table->string('listEleves')->nullable();
    }
}
