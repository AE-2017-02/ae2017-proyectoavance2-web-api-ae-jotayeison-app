<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetPacMen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_pac_men', function (Blueprint $table) {
            $table->integer('paciente_id');
            $table->integer('menu_id');
            $table->primary(['paciente_id' , 'menu_id']);
            $table->foreign('paciente_id')->references('paciente_id')->on('pacientes');
            $table->foreign('menu_id')->references('menu_id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det_pac_men');
    }
}
