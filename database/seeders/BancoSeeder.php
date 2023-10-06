<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Banco;

class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banco::create([
            'codigo' => '0102',
            'banco' => 'Venezuela'
        ]);

        Banco::create([
            'codigo' => '0104',
            'banco' => 'Venezolano de Crédito'
        ]);

        Banco::create([
            'codigo' => '0105',
            'banco' => 'Mercantil'
        ]);

        Banco::create([
            'codigo' => '0108',
            'banco' => 'Provincial'
        ]);

        Banco::create([
            'codigo' => '0114',
            'banco' => 'Bancaribe'
        ]);

        Banco::create([
            'codigo' => '0115',
            'banco' => 'Exterior'
        ]);

        Banco::create([
            'codigo' => '0116',
            'banco' => 'Occidental de Descuento'
        ]);

        Banco::create([
            'codigo' => '0128',
            'banco' => 'Caroní'
        ]);

        Banco::create([
            'codigo' => '0134',
            'banco' => 'Banesco'
        ]);

        Banco::create([
            'codigo' => '0137',
            'banco' => 'Sofitasa'
        ]);

        Banco::create([
            'codigo' => '0138',
            'banco' => 'Plaza'
        ]);

        Banco::create([
            'codigo' => '0146',
            'banco' => 'Banco de la Gente Emprendedora'
        ]);

        Banco::create([
            'codigo' => '0149',
            'banco' => 'Banco del Pueblo Soberano'
        ]);

        Banco::create([
            'codigo' => '0151',
            'banco' => 'BFC Banco Fondo Común'
        ]);

        Banco::create([
            'codigo' => '0156',
            'banco' => '100% Banco'
        ]);

        Banco::create([
            'codigo' => '0157',
            'banco' => 'DelSur'
        ]);

        Banco::create([
            'codigo' => '0163',
            'banco' => 'Banco del Tesoro'
        ]);

        Banco::create([
            'codigo' => '0166',
            'banco' => 'Agrícola de Venezuela'
        ]);

        Banco::create([
            'codigo' => '0168',
            'banco' => 'Bancrecer'
        ]);

        Banco::create([
            'codigo' => '0169',
            'banco' => 'Mi Banco'
        ]);

        Banco::create([
            'codigo' => '0172',
            'banco' => 'Bancamiga'
        ]);

        Banco::create([
            'codigo' => '0173',
            'banco' => 'Internacional de Desarrollo'
        ]);

        Banco::create([
            'codigo' => '0174',
            'banco' => 'Banplus'
        ]);

        Banco::create([
            'codigo' => '0175',
            'banco' => 'Bicentenario'
        ]);

        Banco::create([
            'codigo' => '0177',
            'banco' => 'BANFANB'
        ]);

        Banco::create([
            'codigo' => '0190',
            'banco' => 'Citybsnk'
        ]);

        Banco::create([
            'codigo' => '0191',
            'banco' => 'Nacional de Crédito'
        ]);
    }
}