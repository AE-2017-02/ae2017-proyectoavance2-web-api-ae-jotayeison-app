<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetAliMen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_ali_men', function (Blueprint $table) {
            $table->integer('alimento_id');
            $table->integer('menu_id');
            $table->primary(['alimento_id' , 'menu_id']);
            $table->foreign('alimento_id')->references('alimento_id')->on('alimentos');
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
        Schema::dropIfExists('det_ali_men');
    }
}
