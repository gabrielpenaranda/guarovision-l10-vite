<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Impuesto;

class ImpuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Impuesto::create([
            'impuesto' => 'IVA',
            'tasa' => 16.00,
            'es_activo' =>  true
        ]);

        /*  Impuesto::create([
            'impuesto' => 'Lujo',
            'tasa' => 5.00,
            'es_activo' =>  true
        ]);

        Impuesto::create([
            'impuesto' => 'IVA 8',
            'tasa' => 8,
            'es_activo' =>  false
        ]); */
    }
}