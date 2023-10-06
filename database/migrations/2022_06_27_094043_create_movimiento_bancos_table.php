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
        Schema::create('movimiento_bancos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->date('fecha');
            $table->string('referencia');
            $table->string('cedula');
            $table->string('telefono');
            $table->float('monto', 22, 2);
            $table->foreignId('banco_id')->references('id')->on('bancos')->cascadeOnDelete();
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
        Schema::dropIfExists('movimiento_bancos');
    }
};