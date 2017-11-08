<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Programacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('programacion', function (Blueprint $table) {
            $table->increments('progra_id');
            $table->string('dia',10);
            $table->integer('menu_id')->nullable();;
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
        Schema::dropIfExists('programacion');
    }
}
