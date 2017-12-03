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
            $table->boolean('alcohol')->nullable();
            $table->boolean('obesidad')->nullable();
            $table->boolean('tabaco')->nullable();
            $table->boolean('colesterol')->nullable();
            $table->boolean('diabetes')->nullable();
            $table->boolean('hipertencion')->nullable();
            $table->boolean('hipotencion')->nullable();
            $table->string('meta',500)->nullable();
            $table->string('alergias',500)->nullable();
            $table->string('patologias',500)->nullable();
            $table->string('antibioticos',700)->nullable();
            $table->string('alimentos_unlike',700)->nullable();
            $table->string('pwd',500)->nullable();
            $table->date('fecha_reg')->nullable();
            $table->boolean('activo')->nullable();
            $table->boolean('pre_registro')->nullable();
            $table->string('foto',30)->nullable()->default('hombre.jpg');

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
