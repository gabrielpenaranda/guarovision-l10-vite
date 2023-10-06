<?php

namespace App\Imports;

use App\Models\Equipo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EquiposImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Equipo([
            'modelo_equipo_id' => $row['modelo_equipo_id'],
            'serial' => $row['serial'],
            'pon' => $row['pon'],
            'codigo' => hash('sha256', (string)($row['pon'])),
            'asignado' => 0,
            'usuario' => $row['usuario'],
            'password' => $row['password'],
        ]);
    }
}
