<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zona;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Zona::create([
            'zona' => 'Carucieña',
            'ciudad_id' => 1
        ]);

        // 2
        Zona::create([
            'zona' => 'Cleofe Andrade',
            'ciudad_id' => 1
        ]);

        // 3
        Zona::create([
            'zona' => 'Piedras Blancas, Las Americas, Las Bastidas',
            'ciudad_id' => 1
        ]);

        // 4
        Zona::create([
            'zona' => 'San Francisco',
            'ciudad_id' => 1
        ]);

        // 5
        Zona::create([
            'zona' => 'Santa Isabel',
            'ciudad_id' => 1
        ]);

        // 6
        Zona::create([
            'zona' => 'El Carmen',
            'ciudad_id' => 1
        ]);

        // 7
        Zona::create([
            'zona' => 'Nueva Segovia',
            'ciudad_id' => 1
        ]);

        // 8
        Zona::create([
            'zona' => 'Jose Felix Ribas',
            'ciudad_id' => 1
        ]);

        // 9
        Zona::create([
            'zona' => '12 de Octubre',
            'ciudad_id' => 1
        ]);

        // 10
        Zona::create([
            'zona' => 'El Tostao',
            'ciudad_id' => 1
        ]);

        // 11
        Zona::create([
            'zona' => 'Urb. Jose Angel Alamos',
            'ciudad_id' => 1
        ]);

        // 12
        Zona::create([
            'zona' => 'La Concordia',
            'ciudad_id' => 1
        ]);

        // 13
        Zona::create([
            'zona' => 'Pueblo Nuevo',
            'ciudad_id' => 1
        ]);
    }
}
