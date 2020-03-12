<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Tarifatiempo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Estadoingresoegresovehiculo;

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
                            fecha fecha_llegada,
                            hora hora_llegada,
                            concat(fecha,' ',hora) time_inicio,
                            concat(to_char(now(),'YYYY-mm-dd'),' ',to_char(now(),'HH24:MI:SS')) time_actual,
                            to_char(now(),'dd/mm/YYYY') fecha_actual,
                            to_char(now(),'HH24:MI:SS') hora_actual,
                            to_char((now()::TIME-hora),'HH24:MI:SS') diferencia,
                            now()
                        from ingreso_vehiculo where id = $id");

        $eiev = Estadoingresoegresovehiculo::where('ingreso_vehiculo_id', $id)->first();
        $tarifa = Tarifatiempo::find($eiev->tarifa_tiempo_id);

        foreach ($lista as $key) {

            $start  = new Carbon($key->time_inicio);
            $actual  = new Carbon($key->time_actual);

            $key->intervalo =  $start->diffInHours($actual) . ':' . $start->diff($actual)->format('%I:%S');

            $minutos = $this->hora_a_minutos($key->intervalo);
            $val = ($minutos / $tarifa->minutos) * $tarifa->valor;
            $key->monto = round($val);
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

    public function test()
    {
        $start  = new Carbon('2020-03-10 18:30:00');
        $end    = new Carbon('2020-03-11 09:15:44');

        return $start->diff($end)->format('%H:%I:%S');
        
    }
}
