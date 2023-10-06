<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MarcaEquipo;

class MarcaEquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarcaEquipo::create([
            'marca_equipo' => 'DLink'
        ]);

        MarcaEquipo::create([
            'marca_equipo' => 'Huawei'
        ]);

        MarcaEquipo::create([
            'marca_equipo' => 'TP-Link'
        ]);

        MarcaEquipo::create([
            'marca_equipo' => 'Tenda'
        ]);

        MarcaEquipo::create([
            'marca_equipo' => 'Mercusys'
        ]);
    }
}
