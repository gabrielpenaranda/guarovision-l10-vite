<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Ciudad;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudad::create(
            [ 'ciudad' => 'Barquisimeto', 'estado_id' => 1,]
        );

        Ciudad::create(
            ['ciudad' => 'Cabudare', 'estado_id' => 1,]
        );

        Ciudad::create(
            ['ciudad' => 'Carora', 'estado_id' => 1,]
        );

        Ciudad::create(
            ['ciudad' => 'Duaca', 'estado_id' => 1,]
        );

        Ciudad::create(
            ['ciudad' => 'Acarigua', 'estado_id' => 2,]
        );

        Ciudad::create(
            ['ciudad' => 'Guanare', 'estado_id' => 2,]
        );

        Ciudad::create(
            ['ciudad' => 'Yaritagua', 'estado_id' => 3,]
        );

        Ciudad::create(
            ['ciudad' => 'San Felipe', 'estado_id' => 3,]
        );

        Ciudad::create(
            ['ciudad' => 'El Tocuyo', 'estado_id' => 1,]
        );

    }
}
