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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('direccion')->nullable();
            $table->string('cedula')->nullable();
            $table->string('email')->nullable(true);
            $table->string('telefono_fijo')->nullable(true);
            $table->string('telefono_celular')->nullable(true);
            $table->string('foto')->nullable();
            $table->string('imagen_cedula');
            $table->boolean('otro')->default(false);
            $table->date('fecha_instalacion')->nullable();
            $table->boolean('cortado')->default(false);
            $table->boolean('activo')->default(false);
            $table->string('olt')->nullable(true);
            $table->string('tarjeta')->nullable(true);
            $table->string('puerto')->nullable(true);
            $table->foreignId('zona_id')->references('id')->on('zonas')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('plan_id')->references('id')->on('planes')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('equipo_id')->nullable()->references('id')->on('equipos')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('clientes');
    }
};