<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Concepto;

class ConceptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Concepto::create([
            'concepto' => 'Cambio de plan',
            'descripcion' => 'Cambio de plan',
            'tarifa' => 5.00,
            'divisa_id' => 2,
            'cantidad' => false,
        ]);

        // 2
        Concepto::create([
            'concepto' => 'Reconexión',
            'descripcion' => 'Reconexión',
            'tarifa' => 2.00,
            'divisa_id' => 2,
            'cantidad' => false,
        ]);

        // 3
        Concepto::create([
            'concepto' => 'Punto Adicional',
            'descripcion' => 'Punto Adicional',
            'tarifa' => 4.00,
            'divisa_id' => 2,
            'cantidad' => true,
        ]);
    }
}
