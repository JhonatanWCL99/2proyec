<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
            'email'=>'patrickaguilar2403@gmail.com',
            'foto'=> '',
            'name'=>'Patricio',
            'apellido'=>'Aguilar V',
            'fecha_nacimiento'=> '1999-03-24',
            'ci'=>'11387268',
            'celular_personal'=>'69112517',
            'celular_referencia'=>'77644422',
            'domicilio'=>'b/ virgen de guadalupe 8vo anillo',
            'zona'=>'Norte',
            'codigo'=>'2617',
            'password'=>'2324234',
            'estado'=> 1,
            'sucursal_id'=>1,
            'tipo_usuario_id'=>1, 
        ]);
        User::Create([
            'email'=>'alejandrobarja@gmail.com',
            'foto'=> '',
            'name'=>'Alejandro',
            'apellido'=>'Barja',
            'fecha_nacimiento'=> '1996-05-16',
            'ci'=>'23325',
            'celular_personal'=>'76644332',
            'celular_referencia'=>'6433322',
            'domicilio'=>'2do anillo b/donesco',
            'zona'=>'Sur',
            'codigo'=>'5566',
           
            'password'=>'2323255',
            'estado'=> 1,
            'sucursal_id'=>1,
            'tipo_usuario_id'=>1,
        ]);

        User::Create([
            'email'=>'migurlgarron@gmail.com',
            'foto'=> '',
            'name'=>'Miguel',
            'apellido'=>'Garron',
            'fecha_nacimiento'=> '1990-07-02',
            'ci'=>'657543',
            'celular_personal'=>'7766553',
            'celular_referencia'=>'712245',
            'domicilio'=>'2do anillo b/donesco',
            'zona'=>'Sur',
            'codigo'=>'2444',
           
            'password'=>'878744',
            'estado'=> 1,
            'sucursal_id'=>1,
            'tipo_usuario_id'=>1,
        ]);
        User::Create([
            'email'=>'jhonathan@gmail.com',
            'foto'=> '',
            'name'=>'Jhonathan',
            'apellido'=>'Coyo',
            'fecha_nacimiento'=> '1999-09-11',
            'ci'=>'656344',
            'celular_personal'=>'7676544',
            'celular_referencia'=>'6325232',
            'domicilio'=>'Plan 300 mechero',
            'zona'=>'Norte',
            'codigo'=>'7766',
           
            'password'=>'7565654',
            'estado'=> 1,
            'sucursal_id'=>1,
            'tipo_usuario_id'=>1,
        ]);

        
    }

}
