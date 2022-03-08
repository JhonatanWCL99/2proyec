<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('foto')->nullable();
            $table->string('name');
            $table->string('apellido');
            $table->date('fecha_nacimiento');
            $table->string('ci');
            $table->integer('celular_personal');
            $table->integer('celular_referencia');
            $table->string('domicilio');
            $table->string('zona');
            $table->integer('codigo')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('estado');
            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('tipo_usuario_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('tipo_usuario_id')->references('id')->on('tipo_usuarios');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
