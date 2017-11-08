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
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('consulta_id');
            $table->time('hora')->nullable();;
            $table->date('date')->nullable();;
            $table->date('cancelada')->nullable();;
            $table->string('motivo',150)->nullable();;
            $table->integer('paciente_id')->nullable();;
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
        Schema::dropIfExists('consultas');
    }
}
