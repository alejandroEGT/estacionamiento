<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Salidavehiculo extends Model
{
    protected $table = 'egreso_vehiculo';


    protected function lista()
    {
        $lista = DB::select("SELECT
                                e.id egreso_vehiculo_id,
                                patente,
                                i.fecha fecha_ingreso,
                                i.hora hora_ingreso,
                                e.fecha fecha_egreso,
                                e.hora hora_egreso
                        from egreso_vehiculo e
                inner join ingreso_vehiculo i on i.id = e.ingreso_vehiculo_id");

        if (count($lista) > 0) {
            return $lista;
        }
    }
}
