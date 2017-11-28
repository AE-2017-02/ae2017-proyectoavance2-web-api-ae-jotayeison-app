<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumenCitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumen_citas', function (Blueprint $table) {
            $table->increments('resumen_cita_id');
            $table->decimal('brazo',18,2)->nullable();
            $table->decimal('bcontraido',18,2)->nullable();
            $table->decimal('cintura',18,2)->nullable();
            $table->decimal('muslo',18,2)->nullable();
            $table->decimal('cadera',18,2)->nullable();
            $table->decimal('pantorrilla',18,2)->nullable();
            $table->decimal('muneca',18,2)->nullable();
            $table->decimal('tricipital',18,2)->nullable();
            $table->decimal('sespinale',18,2)->nullable();
            $table->decimal('sescapular',18,2)->nullable();
            $table->decimal('abdominal',18,2)->nullable();
            $table->decimal('bicipital',18,2)->nullable();
            $table->decimal('pmuslo',18,2)->nullable();
            $table->decimal('sliaco',18,2)->nullable();
            $table->decimal('ppantorrillas',18,2)->nullable();
            $table->decimal('pliegues4',18,2)->nullable();
            $table->decimal('pliegues8',18,2)->nullable();

            $table->decimal('tipodieta',18,2)->nullable();
            $table->string('observacion',30)->nullable();

            $table->integer('paciente_id')->nullable();
            $table->integer('cita_id')->nullable();
            $table->foreign('paciente_id')->references('paciente_id')->on('pacientes');
            $table->foreign('cita_id')->references('cita_id')->on('citas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumen_citas');
    }
}
