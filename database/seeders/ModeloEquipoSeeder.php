<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModeloEquipo;

class ModeloEquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModeloEquipo::create([
            'modelo_equipo' => 'HS-21',
            'tipo_equipo_id' => 1,
            'marca_equipo_id' => 2
        ]);

        ModeloEquipo::create([
            'modelo_equipo' => 'HS-21T',
            'tipo_equipo_id' => 1,
            'marca_equipo_id' => 2
        ]);

        ModeloEquipo::create([
            'modelo_equipo' => 'HS-22',
            'tipo_equipo_id' => 1,
            'marca_equipo_id' => 2
        ]);

        ModeloEquipo::create([
            'modelo_equipo' => 'WR820',
            'tipo_equipo_id' => 1,
            'marca_equipo_id' => 3
        ]);

        ModeloEquipo::create([
            'modelo_equipo' => 'WR720',
            'tipo_equipo_id' => 1,
            'marca_equipo_id' => 3
        ]);

        ModeloEquipo::create([
            'modelo_equipo' => '808',
            'tipo_equipo_id' => 2,
            'marca_equipo_id' => 2
        ]);
    }
}
