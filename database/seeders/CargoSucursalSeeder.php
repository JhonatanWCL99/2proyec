<?php

namespace Database\Seeders;

use App\Models\CargoSucursal;
use App\Models\CargoSucursalUser;
use App\Models\User;
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

        $user=User::find(1);
        $user->cargosucursals()->sync([1,2,3]);

        $user=User::find(2);
        $user->cargosucursals()->sync([1,2]);

        $user=User::find(3);
        $user->cargosucursals()->sync([3,4]);

        $user=User::find(4);
        $user->cargosucursals()->sync([1,2,3,4]);
    }
}
