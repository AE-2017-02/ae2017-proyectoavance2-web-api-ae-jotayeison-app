<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Consultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('citas_id');
            $table->timestamp('fec_hor');
            $table->date('cancelada')->nullable();
            $table->string('motivo',150)->nullable();
            $table->integer('paciente_id')->nullable();
            $table->foreign('paciente_id')->references('paciente_id')->on('pacientes');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
