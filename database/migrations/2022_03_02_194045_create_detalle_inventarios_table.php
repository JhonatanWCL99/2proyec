<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleInventariosTable extends Migration
{
    /**
     *
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_inventarios', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->integer('precio');
            $table->integer('sub_total');
            
            $table->unsignedBigInteger('inventario_numero');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('sucursal_id');

            $table->foreign('producto_id')->on('productos')->references('id');
            $table->foreign('sucursal_id')->on('sucursals')->references('id');

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
        Schema::dropIfExists('detalle_inventarios');
    }
}
