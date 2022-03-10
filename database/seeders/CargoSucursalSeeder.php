<?php

namespace Database\Seeders;

use App\Models\CargoSucursal;
use Illuminate\Database\Seeder;

class CargoSucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CargoSucursal::create([
            'nombre_cargo'=>'Encargado/Cajero',
            'descripcion'=>'Funcionario Encargado de la sucursal',
        ]);
        CargoSucursal::create([
            'nombre_cargo'=>'Cocinero',
            'descripcion'=>'Funcionario Encargado de la cocina',
        ]);
        CargoSucursal::create([
            'nombre_cargo'=>'Parilla',
            'descripcion'=>'Funcionario Encargado de la parilla',
        ]);
        CargoSucursal::create([
            'nombre_cargo'=>'Atencion',
            'descripcion'=>'Funcionario Encargado de la atencion al cliente',
        ]);
    }
}
