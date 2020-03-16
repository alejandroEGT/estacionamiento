<?php

namespace App;

use Carbon\Carbon;
use App\Tarifatiempo;
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
                                 to_char(i.fecha,'dd/mm/YYYY') fecha_ingreso,
                                i.fecha  fecha_ingreso_c,
                                i.hora hora_ingreso,
                                e.fecha  fecha_egreso_c,
                                to_char(e.fecha,'dd/mm/YYYY') fecha_egreso,
                                e.hora hora_egreso,
                                eiev.tarifa_tiempo_id
                        from egreso_vehiculo e
                inner join ingreso_vehiculo i on i.id = e.ingreso_vehiculo_id
                inner join estado_ingreso_egreso_vehiculo eiev on eiev.egreso_vehiculo_id = e.id
                ");

        if (count($lista) > 0) {

            foreach ($lista as $key) {
                $tarifa = Tarifatiempo::find($key->tarifa_tiempo_id);
                $time_inicio = $key->fecha_ingreso_c.' '.$key->hora_ingreso;
                $time_cierre = $key->fecha_egreso_c.' '.$key->hora_egreso;
                $start  = new Carbon($time_inicio);
                $actual  = new Carbon($time_cierre);

                $key->intervalo =  $start->diffInHours($actual) . ':' . $start->diff($actual)->format('%I:%S');

                $minutos = $this->hora_a_minutos($key->intervalo);
                $val = ($minutos / $tarifa->minutos) * $tarifa->valor;
                $key->monto = round($val);

            }

            return $lista;
        }
    }

    protected function boleta($e_id)
    {
        $r = DB::select("SELECT
                            iv.id ingreso_vehiculo_id,
                            ev.id egreso_vehiculo_id,
                            upper(iv.patente) patente,
                            to_char(iv.fecha,'dd/mm/YYYY') fecha_ingreso,
                            iv.fecha fecha_ingreso_c,
                            iv.hora hora_ingreso,
                            to_char(ev.fecha, 'dd/mm/YYYY') fecha_egreso,
                            ev.fecha fecha_egreso_c,
                            ev.hora hora_egreso,
                            eiev.tarifa_tiempo_id,

                            tt.minutos,
                            tt.valor,
                            'aqui, ubicacion de estacionamiento' ubicacion
                        from egreso_vehiculo ev
                        inner join estado_ingreso_egreso_vehiculo eiev on eiev.egreso_vehiculo_id = ev.id
                        inner join ingreso_vehiculo iv on iv.id = eiev.ingreso_vehiculo_id
                        inner join tarifa_tiempo tt on tt.id = eiev.tarifa_tiempo_id
                        where ev.id = $e_id");
        
        if (count($r) > 0) {
            foreach ($r as $key) {
                $tarifa = Tarifatiempo::find($key->tarifa_tiempo_id);
                $time_inicio = $key->fecha_ingreso_c.' '.$key->hora_ingreso;
                $time_cierre = $key->fecha_egreso_c.' '.$key->hora_egreso;
                $start  = new Carbon($time_inicio);
                $actual  = new Carbon($time_cierre);

                $key->intervalo =  $start->diffInHours($actual) . ':' . $start->diff($actual)->format('%I:%S');

                $minutos = $this->hora_a_minutos($key->intervalo);
                $val = ($minutos / $tarifa->minutos) * $tarifa->valor;
                $key->monto = round($val);

            }
            return $r;
        }
        return null;
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
