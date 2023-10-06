<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;

class ClientesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Cliente([
            'nombres' => $row['nombres'],
            'apellidos' => $row['apellidos'],
            'cedula' => $row['cedula'],
            'codigo' => hash('sha256', (string)($row['cedula'])),
            'telefono_fijo' => $row['telefono_fijo'],
            'telefono_celular' => $row['telefono_celular'],
            'email' => $row['email'],
            'foto' => '',
            'imagen_cedula' => '',
            'direccion' => $row['direccion'],
            'olt' => $row['olt'],
            'tarjeta' => $row['tarjeta'],
            'puerto' => $row['puerto'],
            /* 'fecha_instalacion' => date("Y-m-d", strtotime(
                $row['fecha_instalacion']
            )), */
            'fecha_instalacion' => date("Y-m-d", strtotime(
                Carbon::now()
            )),
            'cortado' => $row['cortado'],
            'activo' => $row['activo'],
            'zona_id' => $row['zona'],
            'plan_id' => $row['plan'],
            'otro' => $row['otro'],
        ]);
    }
}