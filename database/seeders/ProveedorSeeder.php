<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedor::Create([
            'nombre' => 'Sofia',
        ]);
        Proveedor::Create([
            'nombre' => 'Frigor',
        ]);
        Proveedor::Create([
            'nombre' => 'Impastas S.A.',
        ]);
        Proveedor::Create([
            'nombre' => 'EMBOL SA',
        ]);
        Proveedor::Create([
            'nombre' => 'MAXIMILIANA',
        ]);
    }
}
