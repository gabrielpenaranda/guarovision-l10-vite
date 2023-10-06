<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(EstadoSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(BancoSeeder::class);
        $this->call(DivisaSeeder::class);
        $this->call(ImpuestoSeeder::class);
        $this->call(ZonaSeeder::class);
        // $this->call(TaquillaSeeder::class);
        // $this->call(TipoEquipoSeeder::class);
        // $this->call(MarcaEquipoSeeder::class);
        // $this->call(ModeloEquipoSeeder::class);
        // $this->call(EquipoSeeder::class);
        $this->call(PlanSeeder::class);
        // $this->call(ConceptoSeeder::class);
    }
}