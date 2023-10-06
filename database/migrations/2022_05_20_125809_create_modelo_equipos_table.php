<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelo_equipos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo_equipo')->unique();
            $table->foreignId('tipo_equipo_id')->references('id')->on('tipo_equipos')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('marca_equipo_id')->references('id')->on('marca_equipos')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('modelo_equipos');
    }
};
