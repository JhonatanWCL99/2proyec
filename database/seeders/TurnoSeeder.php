<?php

namespace Database\Seeders;

use App\Models\Turno;
use Illuminate\Database\Seeder;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turno::create([
            'turno'=>'AM',
            'hora_inicio'=>'08:30:00',
            'hora_fin'=>'16:00:00',
            'usuario_id'=>'1',
        ]);
        Turno::create([
            'turno'=>'PM',
            'hora_inicio'=>'17:00:00',
            'hora_fin'=>'23:30:00',
            'usuario_id'=>'2',
        ]);
        Turno::create([
            'turno'=>'AM',
            'hora_inicio'=>'08:30:00',
            'hora_fin'=>'16:00:00',
            'usuario_id'=>'4',
        ]);
        Turno::create([
            'turno'=>'PM',
            'hora_inicio'=>'17:00:00',
            'hora_fin'=>'23:30:00',
            'usuario_id'=>'1',
        ]);
    }
}
