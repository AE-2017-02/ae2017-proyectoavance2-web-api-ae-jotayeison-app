<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('paciente_id');
            $table->string('nombre',30)->nullable();
            $table->string('ape_paterno',30)->nullable();
            $table->string('ape_materno',30)->nullable();
            $table->date('fecha_naci')->nullable();
            $table->string('sexo',1)->nullable();
            $table->decimal('peso',18,2)->nullable();
            $table->decimal('peso_habitual',18,2)->nullable();
            $table->decimal('altura' , 18,2)->nullable();
            $table->decimal('precion_arteria',18,0)->nullable();
            $table->string('lugar_naci',80)->nullable();
            $table->string('domicilio',80)->nullable();
            $table->string('telefono',30)->nullable();
            $table->string('email',30);
            $table->string('alcohol',1)->nullable();
            $table->string('obesidad',1)->nullable();
            $table->string('tabaco',1)->nullable();
            $table->string('colesterol',1)->nullable();
            $table->string('diabetes',1)->nullable();
            $table->string('hipertencion',1)->nullable();
            $table->string('hipotencion',1)->nullable();
            $table->string('antibioticos',700)->nullable();
            $table->string('alimentos_unlike',700)->nullable();
            $table->string('pwd',500);
            $table->date('fecha_reg')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
