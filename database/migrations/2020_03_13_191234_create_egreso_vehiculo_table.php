<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresoVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egreso_vehiculo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ingreso_vehiculo_id');
            $table->date('fecha');
            $table->time('hora');
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
        Schema::dropIfExists('egreso_vehiculo');
    }
}
