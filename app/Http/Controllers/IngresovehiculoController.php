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
}
