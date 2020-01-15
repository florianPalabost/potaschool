<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestDepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_departs', function (Blueprint $table) {
            $table->integer('idEleve');
            $table->integer('idMatiere');
            $table->integer('appreciation');
            $table->string('aime');
            $table->timestamps();
            $table->primary(['idEleve', 'idMatiere']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_departs');
    }
}
