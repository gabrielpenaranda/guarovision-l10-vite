<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create(
            ['estado' => 'Lara',]
        );

        Estado::create(
            ['estado' => 'Portuguesa',]
        );

        Estado::create(
            ['estado' => 'Yaracuy',]
        );

        Estado::create(
            ['estado' => 'Falcon',]
        );

        Estado::create(
            ['estado' => 'Carabobo',]
        );

        Estado::create(
            ['estado' => 'Zulia',]
        );

        Estado::create(
            ['estado' => 'Cojedes',]
        );

        Estado::create(
            ['estado' => 'Aragua',]
        );

        Estado::create(
            ['estado' => 'Barinas',]
        );

        Estado::create(
            ['estado' => 'Apure',]
        );

        Estado::create(
            ['estado' => 'Trujillo',]
        );

        Estado::create(
            ['estado' => 'Mérida',]
        );

        Estado::create(
            ['estado' => 'Táchira',]
        );

        Estado::create(
            ['estado' => 'Guárico',]
        );

        Estado::create(
            ['estado' => 'Aragua',]
        );

        Estado::create(
            ['estado' => 'Miranda',]
        );

        Estado::create(
            ['estado' => 'Amazonas',]
        );

        Estado::create(
            ['estado' => 'Bolívar',]
        );

        Estado::create(
            ['estado' => 'La Guaira',]
        );

        Estado::create(
            ['estado' => 'Dtto. Capital',]
        );

        Estado::create(
            ['estado' => 'Anzoátegui',]
        );

        Estado::create(
            ['estado' => 'Nueva Esparta',]
        );

        Estado::create(
            ['estado' => 'Monagas',]
        );

        Estado::create(
            ['estado' => 'Delta Amacuro',]
        );
    }
}
