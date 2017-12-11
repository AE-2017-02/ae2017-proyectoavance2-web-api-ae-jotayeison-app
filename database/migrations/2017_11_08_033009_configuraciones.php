<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Configuraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->increments('config_id');
            $table->string('consultorio',150)->nullable();
            $table->string('telefono',50)->nullable();
            $table->string('direccion',150)->nullable();
            $table->json('horario')->nullable();
            $table->string('usuario',50);
            $table->string('email',50);
            $table->string('pwd_email',100);
            $table->string('pwd',500);
            $table->string('logo',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuraciones');
    }
}
