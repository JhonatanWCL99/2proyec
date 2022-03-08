<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('celular');
            $table->string('empresa');
            $table->string('direccion');
            $table->bigInteger('nit');
            $table->boolean('estado');

            /*$table->unsignedBigInteger('tipo_categoria');
            $table->foreign('tipo_categoria')->references('id')->on('categorias');

            $table->unsignedBigInteger('tipo_Credito');
            $table->foreign('tipo_Credito')->references('id')->on('creditos');*/
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
        Schema::dropIfExists('proveedores');
    }
}
