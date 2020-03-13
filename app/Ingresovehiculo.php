<?php

namespace App;

use Illuminate\Support\Facades\DB;
use App\Estadoingresoegresovehiculo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Ingresovehiculo extends Model
{
    protected $table = 'ingreso_vehiculo';

    protected function ingreso($r){

        try{
            
            $tarifa = Tarifatiempo::where('activo','S')->first();

            if (!$tarifa) {
                return ['estado' => 'failed', 'mensaje' => 'No hay una tarifa predeterminada'];
            }

            $pat = strtoupper($this->textopuro($r->patente));

            $verify = DB::select("SELECT id, patente, regexp_replace(patente,'[-,.,*]', '','g') 
                                from ingreso_vehiculo
                                where upper(regexp_replace(patente,'[-,.,*]', '','g')) ='$pat' and activo='S'");
            
            if(count($verify) > 0){
                return ['estado'=>'failed','mensaje'=>'Ya esta activa esta patente'];
            }else{
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
                    $i->fecha_cl = date('d/m/Y',strtotime($i->fecha));

                    $ie = new Estadoingresoegresovehiculo;
                    $ie->ingreso_vehiculo_id = $i->id;
                    $ie->estado = 1; //en servicio
                    $ie->tarifa_tiempo_id = $tarifa->id;
                    if ($ie->save()) {
                        return [
                            'estado'=>'success',
                            'mensaje'=>'Ingreso exitoso',
                            'ingreso' => $i,
                            'server' => $_SERVER
                        ];
                    }
                    return ['estado'=>'failed','mensaje'=>'No se ha ingresado el formulario'];        
                    
                }
                return ['estado'=>'failed','mensaje'=>'No se ha ingresado el formulario'];
        
            }
        }catch(QueryException $e){
			return[
				'estado'  => 'failed', 
                'mensaje' => 'QEx: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
                'error' => $e
			];
		}
		catch(\Exception $e){
			return[
				'estado'  => 'failed', 
                'mensaje' => 'Ex: No se ha podido seguir con el proceso de guardado, intente nuevamente o verifique sus datos',
                'error' => $e
        	];
		}


    }

    protected function listar()
    {
        $lista = DB::select("SELECT 
                                iv.id, UPPER(patente) patente, 
                                to_char(fecha,'dd/mm/YYYY') fecha, 
                                hora, 
                                case 
                                    when tipo_vehiculo = 1 then 'Coche'
                                    when tipo_vehiculo = 2 then 'Moto'
                                    when tipo_vehiculo = 3 then 'Otro'
                                end tipo,
                               -- eiev.estado,
                                case 
                                    when eiev.estado = 1 then 'En servicio'
                                    when eiev.estado = 2 then 'Fuera de servicio'
                                    when eiev.estado is null then '(sin registro)'
                                end estado

                            from ingreso_vehiculo iv
                            left join estado_ingreso_egreso_vehiculo eiev on eiev.ingreso_vehiculo_id = iv.id
                            where iv.activo='S' order by iv.id desc 
        ");

        if (count($lista)>0) {
            return [
                'estado' => 'success',
                'lista' => $lista
            ];
        }
        return [
                'estado' => 'failed',
                'lista' => null
            ];
    }

    public function textopuro($txt)
    {
        return str_replace(['-','.','*','_'], '', $txt);
    }
}
