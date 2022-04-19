<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::Create([
            'codigo'=>1010,
            'nombre'=>'Alitas de Pollo',
            'estado'=>1,
            'categoria_id'=>10,
        ]);
        Producto::Create([
            'codigo'=>1011,
            'nombre'=>'Albondigas',
            'estado'=>1,
            'categoria_id'=>2,
        ]);
        Producto::Create([
            'codigo'=> 1012,
            'nombre'=>'Ace Patito',
            'estado'=>1,
            'categoria_id'=>5,

        ]);
        Producto::Create([
            'codigo'=>1013,
            'nombre'=>'Aquarius Pomelo 2lts',
            'estado'=>1,
            'categoria_id'=>4,
        ]);
        Producto::Create([
            'codigo'=>1014,
            'nombre'=>'Bolsa Arrobera',
            'estado'=>1,
            'categoria_id'=>6,
        ]);
    }
}
