<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifatiempo extends Model
{
    protected $table = 'tarifa_tiempo';

    protected function ingreso($r)
    {
        $i = $this;
        $i->minutos = $r->minutos;
        $i->valor = $r->valor;
        $i->minutos_gratis = ($r->check == true)? 'S':'N';
        $i->valor_minutos_gratis = $r->minutos_gratis; // cantidad de minutos
        $i->activo = 'N';

        if ($i->save()) {
            return [
                'estado' => 'success',
                'mensaje' => 'Tarifa ingresada'
            ];
        }else{
            return [
                'estado' => 'failed',
                'mensaje' => 'Error al ingresar'
            ];
        }

    }

    protected function lista()
    {
        $l = $this->orderBy('id')->get();

        if ($l) {
            return [
                'estado' => 'success',
                'lista' => $l
            ];
        }
        return [
            'estado' => 'failed',
            'lista' => null
        ];
    }
}
