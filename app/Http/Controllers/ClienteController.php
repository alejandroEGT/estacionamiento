<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Tarifatiempo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function listar($id)
    {
        $tarifa = Tarifatiempo::where('activo','S')->first();
        
        $lista =  DB::select("SELECT
                            id,
                            patente,
                            case when tipo_vehiculo = 1 then 'Coche' 
                            when tipo_vehiculo = 2 then 'Moto' 
                            when tipo_vehiculo = 3 then 'Otro' end as tipo,
                            to_char(fecha,'dd/MM/YYYY') fecha,
                            hora hora_llegada,
                            to_char(now(),'HH24:MI:SS') hora_actual,
                            to_char((now()::TIME-hora),'HH24:MI:SS') diferencia,
                            now()
                        from ingreso_vehiculo where id = $id");

        foreach ($lista as $key) {
            $minutos = $this->hora_a_minutos($key->diferencia);
            $val = ($minutos / $tarifa->minutos) * $tarifa->valor;
            $key->monto = $val;
        }

        return ['lista'=>$lista, 'tarifa' => $tarifa ];
    }

    public function hora_a_minutos($hora)
    {
        $horaEntrada = (string)$hora;	
 
        //realizamos una partición que separe la parte de la hora y la parte de los minutos
        $v_HorasPartes = explode(":", $horaEntrada);
        
        //la parte de la hora la multiplicamos por 60 para pasarla a minutos y así realizar la suma de los minutos totales
        $minutosTotales= ($v_HorasPartes[0] * 60) + $v_HorasPartes[1];
        
        return $minutosTotales;
    }
}
