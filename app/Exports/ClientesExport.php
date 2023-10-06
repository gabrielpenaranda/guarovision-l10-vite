<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;


use App\Models\Cliente;
use App\Models\Zona;
use App\Models\Plan;

class ClientesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $clientes = Cliente::all();


        foreach ($clientes as $cliente) {
            if ($cliente->cortado==0) {
                $cliente->cortado='NO';
            } elseif ($cliente->cortado==1) {
                $cliente->cortado='SI';
            }
            if ($cliente->activo==0) {
                $cliente->activo='NO';
            } elseif ($cliente->activo==1) {
                $cliente->activo='SI';
            }
            $cliente->zona_nombre = $cliente->zona->zona;
            $cliente->plan_nombre = $cliente->plan->plan;
            $cliente->plan_descripcion = $cliente->plan->descripcion;
        }

        return $clientes;
    }


}
