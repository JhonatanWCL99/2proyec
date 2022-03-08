<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->float('total');
            $table->date('fecha');
            $table->time('hora');

            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('usuario_id');

          

            $table->foreign('sucursal_id')->on('sucursals')->references('id');
            $table->foreign('usuario_id')->on('users')->references('id');
      
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
        Schema::dropIfExists('inventarios');
    }
}
