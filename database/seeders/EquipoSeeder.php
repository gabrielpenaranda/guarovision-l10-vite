<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Equipo;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipo::create([
            'modelo_equipo_id' => 1,
            'serial' => '52136597139661SD85FF',
            'pon' =>
            'P52136597139661SD85FF',
            'codigo' => hash('sha256', 'P52136597139661SD85FF'),
            'usuario' => 'admin',
            'password' => 'adminpw',
            'asignado' => false
        ]);

        Equipo::create([
            'modelo_equipo_id' => 1,
            'serial' => '5218521452K39661SD85FF',
            'pon' =>
            'P52136597139661SD85FA',
            'codigo' => hash('sha256', 'P52136597139661SD85FA'),
            'usuario' => 'admin',
            'password' => 'adminpw',
            'asignado' => false
        ]);

        Equipo::create([
            'modelo_equipo_id' => 1,
            'serial' => 'N344136597139661SD85FF',
            'pon' =>
            'P52136597139661SD85FB',
            'codigo' => hash('sha256', 'P52136597139661SD85FB'),
            'usuario' => 'admin',
            'password' => 'adminpw',
            'asignado' => false
        ]);

        Equipo::create([
            'modelo_equipo_id' => 2,
            'serial' => '521365HSS39661SD85FP',
            'pon' =>
            'P52136597139661SD85FC',
            'codigo' => hash('sha256', 'P52136597139661SD85FC'),
            'usuario' => 'admin',
            'password' => 'adminpw',
            'asignado' => false
        ]);

        Equipo::create([
            'modelo_equipo_id' => 2,
            'serial' => 'KRM36597139661SD85ZF',
            'pon' =>
            'P52136597139661SD85FD',
            'codigo' => hash('sha256', 'P52136597139661SD85FD'),
            'usuario' => 'admin',
            'password' => 'adminpw',
            'asignado' => false
        ]);

        Equipo::create([
            'modelo_equipo_id' => 3,
            'serial' => '33456597139661SD85FD',
            'pon' =>
            'P52136597139661SD85FE',
            'codigo' => hash('sha256', 'P52136597139661SD85FE'),
            'usuario' => 'admin',
            'password' => 'adminpw',
            'asignado' => false
        ]);
    }
}
