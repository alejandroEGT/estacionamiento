<?php

namespace App\Http\Controllers;

use App\Tarifatiempo;
use App\Ingresovehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngresovehiculoController extends Controller
{
    public function ingreso(Request $r)
    {
        $validator = Validator::make($r->all(), 
		 	[
                'patente' => 'required',
                'tipo' => 'required',
                'fecha' => 'required',
                'hora' => 'required',
                'detalle' => 'required'
	            // 'detalle' => 'required|unique:cuenta_bienestar,numero_documento_1',
	            
            ]);
            
            if ($validator->fails()){ 
                return ['estado' => 'failed_v', 'mensaje' => $validator->errors()];
            }
            
            return Ingresovehiculo::ingreso($r);
    }

    public function registrar_tarifa(Request $r)
    {
        $validator = Validator::make($r->all(), 
		 	[
                'minutos' => 'required',
                'valor' => 'required',
	            // 'detalle' => 'required|unique:cuenta_bienestar,numero_documento_1',
            ]);
            
            if ($validator->fails()){ 
                return ['estado' => 'failed_v', 'mensaje' => $validator->errors()];
            }
            
            return Tarifatiempo::ingreso($r);
        
    }

    public function listar_ingreso()
    {
        $lista = Ingresovehiculo::listar();

        return $lista;
    }

    public function listar_config_tiempo()
    {
        $t = Tarifatiempo::lista();
        return $t;
    }


    public function activar_config_tiempo($estado, $id)
    {
        switch ($estado) {
            case 'S':
                $t = Tarifatiempo::get(); //cambiar estado a todo
                foreach ($t as $k) {
                   $k->activo = 'N';
                   $k->save();
                }

            break;

            case 'N':
               $t = Tarifatiempo::get(); //cambiar estado a todo
                foreach ($t as $k) {
                   $k->activo = 'N';
                   $k->save();
                }

               $t2 = Tarifatiempo::find($id);
               $t2->activo = 'S';
               $t2->save();
            break;
            
            default:
                # code...
                break;
        }
    }
    public function textopuro($txt)
    {
        return str_replace(['-','.','*','_'], '', $txt);
    }
}
