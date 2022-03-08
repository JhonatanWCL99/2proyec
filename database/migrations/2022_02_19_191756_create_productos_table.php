<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); 
            $table->integer('codigo');
            $table->string('nombre');
            $table->integer('stock');
            $table->float('precio');
            $table->boolean('estado');

            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id') -> on ('categorias')->references('id'); 
            
            $table->timestamps();
            /*$table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->on('proveedores')->references('id');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
