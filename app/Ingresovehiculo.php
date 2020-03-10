<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Ingresovehiculo extends Model
{
    protected $table = 'ingreso_vehiculo';

    protected function ingreso($r){

        // try{
            // dd($r->tipo);
            switch ($r->tipo) {
                case 'Automovil': $tipo = 1;break;
                case 'Motocicleta': $tipo = 2;break;
                case 'Otros': $tipo = 3; break;
                default: break;
            }
            $i = $this;
            $i->patente = $r->patente;
            $i->tipo_vehiculo = $tipo;
            $i->fecha = date('Y-m-d',strtotime($r->fecha));
            $i->hora = $r->hora;
            $i->detalle = $r->detalle;
            $i->activo = 'S';

            if($i->save()){
                return [
                    'estado'=>'success',
                    'mensaje'=>'Ingreso exitoso',
                    'ingreso' => $i,
                    'server' => $_SERVER
                ];
            }
            return ['estado'=>'failed','mensaje'=>'No se ha ingresado el formulario'];
        
        // }catch(QueryException $e){
		// 	return[
		// 		'estado'  => 'failed', 
        //         'mensaje' => 'QEx: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
        //         'error' => $e
		// 	];
		// }
		// catch(\Exception $e){
		// 	return[
		// 		'estado'  => 'failed', 
        //         'mensaje' => 'Ex: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
        //         'error' => $e
        // 	];
		// }


    }
}
