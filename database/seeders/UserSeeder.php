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
        $user1 = User::Create([
            'email' => 'patrickaguilar2403@gmail.com',
            'foto' => '',
            'name' => 'Patricio',
            'apellido' => 'Aguilar V',
            'fecha_nacimiento' => '1999-03-24',
            'ci' => '11387268',
            'celular_personal' => '69112517',
            'celular_referencia' => '77644422',
            'domicilio' => 'b/ virgen de guadalupe 8vo anillo',
            'zona' => 'Norte',
            'codigo' => '2617',
            'password' => '2324234',
            'estado' => 1,
            'sucursal_id' => 1,
            'tipo_usuario_id' => 1,
        ]);
      /*   $user1->assignRole('Admin'); */

        $user2=User::Create([
            'email' => 'alejandrobarja@gmail.com',
            'foto' => '',
            'name' => 'Alejandro',
            'apellido' => 'Barja',
            'fecha_nacimiento' => '1996-05-16',
            'ci' => '23325',
            'celular_personal' => '76644332',
            'celular_referencia' => '6433322',
            'domicilio' => '2do anillo b/donesco',
            'zona' => 'Sur',
            'codigo' => '5566',

            'password' => '2323255',
            'estado' => 1,
            'sucursal_id' => 1,
            'tipo_usuario_id' => 1,
        ]);
        /* $user2->assignRole('Admin'); */

        $user3=User::Create([
            'email' => 'migurlgarron@gmail.com',
            'foto' => '',
            'name' => 'Miguel',
            'apellido' => 'Garron',
            'fecha_nacimiento' => '1990-07-02',
            'ci' => '657543',
            'celular_personal' => '7766553',
            'celular_referencia' => '712245',
            'domicilio' => '2do anillo b/donesco',
            'zona' => 'Sur',
            'codigo' => '2444',

            'password' => '878744',
            'estado' => 1,
            'sucursal_id' => 1,
            'tipo_usuario_id' => 1,
        ]);

       /*  $user3->assignRole('Encargado'); */

        User::Create([
            'email' => 'jhonathan@gmail.com',
            'foto' => '',
            'name' => 'Jhonathan',
            'apellido' => 'Coyo',
            'fecha_nacimiento' => '1999-09-11',
            'ci' => '656344',
            'celular_personal' => '7676544',
            'celular_referencia' => '6325232',
            'domicilio' => 'Plan 300 mechero',
            'zona' => 'Norte',
            'codigo' => '7766',

            'password' => '7565654',
            'estado' => 1,
            'sucursal_id' => 1,
            'tipo_usuario_id' => 1,
        ]);
        User::Create([
            'email' => 'silvia@gmail.com',
            'foto' => '',
            'name' => 'Silvia',
            'apellido' => 'Alvarez',
            'fecha_nacimiento' => '1999-09-11',
            'ci' => '454654',
            'celular_personal' => '78979842',
            'celular_referencia' => '63252321',
            'domicilio' => 'BARRIO EL FUERTE CALLE IMPERIAL 8VO ANILLO',
            'zona' => 'Norte',
            'codigo' => '1111',

            'password' => '46546513',
            'estado' => 1,
            'sucursal_id' => 6,
            'tipo_usuario_id' => 2,
        ]);
        User::Create([
            'email' => 'silvia@gmail.com',
            'foto' => '',
            'name' => 'Silvia',
            'apellido' => 'Alvarez',
            'fecha_nacimiento' => '1999-09-11',
            'ci' => '454654',
            'celular_personal' => '78979842',
            'celular_referencia' => '63252321',
            'domicilio' => 'BARRIO EL FUERTE CALLE IMPERIAL 8VO ANILLO',
            'zona' => 'Norte',
            'codigo' => '2222',

            'password' => '46546513',
            'estado' => 1,
            'sucursal_id' => 6,
            'tipo_usuario_id' => 2,
        ]);
        User::Create([
            'email' => 'cabernetvilla@gmail.com',
            'foto' => '',
            'name' => 'Rayza',
            'apellido' => 'Unzueta',
            'fecha_nacimiento' => '1995-12-11',
            'ci' => '484842',
            'celular_personal' => '76328118',
            'celular_referencia' => '63252321',
            'domicilio' => 'VILLA PRIMERO DE MAYO',
            'zona' => 'Norte',
            'codigo' => '3333',

            'password' => '46546513',
            'estado' => 1,
            'sucursal_id' => 8,
            'tipo_usuario_id' => 2,
        ]);
        User::Create([
            'email' => 'qdelibajio@gmail.com',
            'foto' => '',
            'name' => 'Aylin',
            'apellido' => 'Llanos',
            'fecha_nacimiento' => '1995-12-11',
            'ci' => '484842',
            'celular_personal' => '61352564',
            'celular_referencia' => '63252321',
            'domicilio' => 'AV DOBLE VIA',
            'zona' => 'Norte',
            'codigo' => '5555',

            'password' => '46546513',
            'estado' => 1,
            'sucursal_id' => 15,
            'tipo_usuario_id' => 2,
        ]);
        User::Create([
            'email' => 'cabernetroca@gmail.com',
            'foto' => '',
            'name' => 'Fabiola',
            'apellido' => 'Urquiza',
            'fecha_nacimiento' => '1995-12-11',
            'ci' => '484842',
            'celular_personal' => '76388489',
            'celular_referencia' => '64548125',
            'domicilio' => 'av roca y coronado',
            'zona' => 'Roca',
            'codigo' => '6666',

            'password' => '46546513',
            'estado' => 1,
            'sucursal_id' => 10,
            'tipo_usuario_id' => 2,
        ]);
    }
}
