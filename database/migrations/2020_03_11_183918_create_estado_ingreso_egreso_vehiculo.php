<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoIngresoEgresoVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_ingreso_egreso_vehiculo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ingreso_vehiculo_id');
            $table->bigInteger('egreso_vehiculo_id')->nullable();
            $table->integer('estado'); // 1-en Servicio, 2-Fuera servicio
            $table->integer('tarifa_tiempo_id');
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
        Schema::dropIfExists('estado_ingreso_egreso_vehiculo');
    }
}
