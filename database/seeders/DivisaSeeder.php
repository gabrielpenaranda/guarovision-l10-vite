<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Divisa;

class DivisaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Divisa::create([
            'divisa' => 'USD',
            'descripcion' => 'Dólar US',
            'simbolo' => 'US$',
            'tasa' => '5.6194'
        ]);
    }
}