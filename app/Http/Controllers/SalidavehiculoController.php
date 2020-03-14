<?php

namespace App\Http\Controllers;

use App\Salidavehiculo;
use App\Ingresovehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Estadoingresoegresovehiculo;

class SalidavehiculoController extends Controller
{
    public function salida_vehiculo(Request $r)
    {
        // try{
            DB::beginTransaction();
                $pat = strtoupper($this->textopuro($r->patente));
                $verify = DB::select("SELECT id, patente, regexp_replace(patente,'[-,.,*]', '','g') 
                                        from ingreso_vehiculo
                                        where upper(regexp_replace(patente,'[-,.,*]', '','g')) ='$pat' and activo='S'");
                
                

                if(count($verify) > 0){
                $i = Ingresovehiculo::find($verify[0]->id);
                $i->activo = 'N';
                    if($i->save()){

                            $time = DB::select("SELECT to_char(now(),'YYYY-mm-dd') fecha_actual, to_char(now(),'HH24:MI:SS') hora_actual");
                            $t = [
                                'fecha' =>$time[0]->fecha_actual,
                                'hora' => $time[0]->hora_actual
                            ];

                            // dd($t['fecha'].', '.$t['hora']);
                          //dd($i->id);
                            $e = new Salidavehiculo;
                            $e->ingreso_vehiculo_id = $i->id;
                            $e->fecha = $t['fecha'];
                            $e->hora = $t['hora'];
                            $e->activo = 'S';

                            if ($e->save()) {
                                //return $e->id;
                                $eiev = Estadoingresoegresovehiculo::where('ingreso_vehiculo_id', $i->id)->first();
                                
                                // dd($eiev);
                                $eiev->egreso_vehiculo_id = $e->id;
                                $eiev->estado = 2; // fuera de servicio.
                            

                                if ($eiev->save()) {
                                    DB::commit();
                                    return ['estado'=>'success','Insert'];
                                }
                            }
                            return ['estado'=>'falied','error'];
                      
                    }
                    DB::rollback();
                    return ['estado'=>'falied','error1'];

                }
                return ['estado'=>'falied','error2', 'query'=>"SELECT id, patente, regexp_replace(patente,'[-,.,*]', '','g') 
                                        from ingreso_vehiculo
                                        where upper(regexp_replace(patente,'[-,.,*]', '','g')) ='$pat' and activo='S'"];
        //     }catch(QueryException $e){
        //         DB::rollback();
		// 	return[
		// 		'estado'  => 'failed', 
        //         'mensaje' => 'QEx: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
        //         'error' => $e
		// 	];
		// }
		// catch(\Exception $e){
        //     DB::rollback();
		// 	return[
		// 		'estado'  => 'failed', 
        //         'mensaje' => 'Ex: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
        //         'error' => $e
        // 	];
		// }
    }

    public function traer_salidas()
    {
        return Salidavehiculo::lista();
    }

    public function textopuro($txt)
    {
        return str_replace(['-','.','*','_'], '', $txt);
    }

   
}
