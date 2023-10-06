<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoEquipo;

class TipoEquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoEquipo::create([
            'tipo_equipo' => 'Router'
        ]);

        TipoEquipo::create([
            'tipo_equipo' => 'Switch'
        ]);
    }
}
