<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSancionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanciones_user', function (Blueprint $table) {
            $table->id();
            $table->string('imagen')->nullable();
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sanciones_id');               
            $table->timestamps();
        });

        Schema::table('sanciones_user', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
        });

        Schema::table('sanciones_user', function (Blueprint $table) {
            $table->foreign('sanciones_id')
            ->references('id')
            ->on('sanciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanciones_user');
    }
}
