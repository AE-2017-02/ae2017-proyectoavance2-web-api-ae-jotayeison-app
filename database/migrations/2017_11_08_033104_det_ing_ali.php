<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetIngAli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_ing_ali', function (Blueprint $table) {
            $table->integer('ingrediente_id');
            $table->integer('alimento_id');
            $table->primary(['ingrediente_id' , 'alimento_id']);
            $table->foreign('ingrediente_id')->references('ingrediente_id')->on('ingredientes');
            $table->foreign('alimento_id')->references('alimento_id')->on('alimentos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det_ing_ali');
    }
}
