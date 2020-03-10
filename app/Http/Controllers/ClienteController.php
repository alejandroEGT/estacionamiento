<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function listar($id)
    {
       
        $lista =  DB::select("SELECT
                            id,
                            patente,
                            case when tipo_vehiculo = 1 then 'Coche' 
                            when tipo_vehiculo = 2 then 'Moto' 
                            when tipo_vehiculo = 3 then 'Otro' end as tipo,
                            to_char(fecha,'dd/MM/YYYY') fecha,
                            hora hora_llegada,
                            to_char(now(),'HH24:MI:SS') hora_actual,
                            (now()::TIME-hora) diferencia,
                            now()
                        from ingreso_vehiculo where id = $id");

        // foreach ($lista as $key) {
        //     $cDate = Carbon::parse($key->hora);
    
        //     $key->diff = $cDate->diffInDays();
        // }

        return $lista;
    }
}
