<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifaTiempoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifa_tiempo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('minutos');
            $table->integer('valor');
            $table->char('minutos_gratis',1);
            $table->integer('valor_minutos_gratis')->nullable();
            $table->char('activo',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarifa_tiempo');
    }
}
