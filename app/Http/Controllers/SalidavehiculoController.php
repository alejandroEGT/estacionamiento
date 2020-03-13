<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalidavehiculoController extends Controller
{
    public function salida_vehiculo(Request $r)
    {
        return $this->textopuro($r->patente);
    }

    public function textopuro($txt)
    {
        return str_replace(['-','.','*','_'], '', $txt);
    }

   
}
