<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_vehiculo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patente');
            $table->integer('tipo_vehiculo');//1 - coche, 2 - moto - 3 - otros
            $table->date('fecha');
            $table->time('hora');
            $table->text('detalle');
            $table->char('activo');
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
        Schema::dropIfExists('ingreso_vehiculo');
    }
}
