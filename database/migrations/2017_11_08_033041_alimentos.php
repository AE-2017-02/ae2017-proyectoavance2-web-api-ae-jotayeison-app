    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentos', function (Blueprint $table) {
            $table->increments('alimento_id');
            $table->string('descripcion',400)->nullable();
            $table->string('um',45)->nullable();
            $table->decimal('can_recomendada')->nullable();
            $table->integer('grupo_id')->nullable();
            $table->foreign('grupo_id')->references('grupo_id')->on('grupos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alimentos');
    }
}
