<?php

namespace Database\Seeders;


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

        $this->call(RoleSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(TipoUsuarioSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ContratoSeeder::class);
        $this->call(TurnoSeeder::class);
        $this->call(CategoriaSancion::class);
        $this->call(CargoSucursalSeeder::class);
        $this->call(HorarioSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ProveedorSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
