<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GruposAlimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('grupo_id');
            $table->string('grupo',200)->nullable();
            $table->decimal('proteinas',10,2)->nullable();
            $table->decimal('grasas',10,2)->nullable();
            $table->decimal('energia',10,2)->nullable();
            $table->decimal('carbohidratos',10,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
