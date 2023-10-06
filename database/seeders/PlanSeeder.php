<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Plan::create([
            'plan' => '2MB',
            'descripcion' => 'Internet 2MB',
            'tarifa' => 10.00,
            'divisa_id' => 1
        ]);

        // 2
        Plan::create([
            'plan' => '2MB + TV',
            'descripcion' => 'Internet 2MB + TV',
            'tarifa' => 15.00,
            'divisa_id' => 1
        ]);

        // 3
        Plan::create([
            'plan' => '4MB',
            'descripcion' => 'Internet 4MB',
            'tarifa' => 12.00,
            'divisa_id' => 1
        ]);

        // 4
        Plan::create([
            'plan' => '4 MB + TV',
            'descripcion' => 'Internet 4MB + TV',
            'tarifa' => 17.00,
            'divisa_id' => 1
        ]);

        // 5
        Plan::create([
            'plan' => '5MB',
            'descripcion' => 'Internet 5MB',
            'tarifa' => 15.00,
            'divisa_id' => 1
        ]);

        // 6
        Plan::create([
            'plan' => '5MB + TV',
            'descripcion' => 'Internet 5MB + TV',
            'tarifa' => 20.00,
            'divisa_id' => 1
        ]);

        // 7
        Plan::create([
            'plan' => '10MB',
            'descripcion' => 'Internet 10MB',
            'tarifa' => 15.00,
            'divisa_id' => 1
        ]);

        // 8
        Plan::create([
            'plan' => '10MB + TV',
            'descripcion' => 'Internet 10MB + TV',
            'tarifa' => 20.00,
            'divisa_id' => 1
        ]);


        // 9
        Plan::create([
            'plan' => '20MB',
            'descripcion' => 'Internet 20MB, incluye TV',
            'tarifa' => 21.00,
            'divisa_id' => 1
        ]);

        // 10
        Plan::create([
            'plan' => '50MB',
            'descripcion' => 'Internet 50MB, incluye TV',
            'tarifa' => 35.00,
            'divisa_id' => 1
        ]);
    }
}
