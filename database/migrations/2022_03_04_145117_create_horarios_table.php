<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('horario_ingreso');
            $table->time('horario_entrada');
            $table->time('horario_salida')->nullable();
            $table->string('turno');

            $table->unsignedBigInteger('encargado_id');
            $table->foreign('encargado_id')->on('encargados')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
}
