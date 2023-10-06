<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Taquilla;

class TaquillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Taquilla::create([
            'taquilla' => 'Baquisimeto 1',
            'tipo_taquilla' => 'Física',
            'direccion' => 'La Carucieña',
            'ciudad_id' => 1
        ]);

        Taquilla::create([
            'taquilla' => 'Baquisimeto 2',
            'tipo_taquilla' => 'Física',
            'direccion' => 'Av. Pedro Leon Torres',
            'ciudad_id' => 1
        ]);

        Taquilla::create([
            'taquilla' => 'Baquisimeto 3',
            'tipo_taquilla' => 'Física',
            'direccion' => 'El Carmen',
            'ciudad_id' => 1
        ]);

        Taquilla::create([
            'taquilla' => 'Web',
            'tipo_taquilla' => 'Web',
            'direccion' => 'Web',
            'ciudad_id' => 1
        ]);

        Taquilla::create([
            'taquilla' => 'Carora 1',
            'tipo_taquilla' => 'Física',
            'direccion' => 'Carora',
            'ciudad_id' => 3
        ]);

        Taquilla::create([
            'taquilla' => 'Cabudare 1',
            'tipo_taquilla' => 'Física',
            'direccion' => 'Av. Libertador',
            'ciudad_id' => 2
        ]);

        Taquilla::create([
            'taquilla' => 'Duaca 1',
            'tipo_taquilla' => 'Física',
            'direccion' => 'Duaca',
            'ciudad_id' => 4
        ]);

        Taquilla::create([
            'taquilla' => 'El Tocuyo 1',
            'tipo_taquilla' => 'Física',
            'direccion' => 'El Tocuyo',
            'ciudad_id' => 9
        ]);
    }
}
