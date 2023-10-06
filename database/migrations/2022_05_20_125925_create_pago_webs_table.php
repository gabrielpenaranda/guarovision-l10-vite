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
        Schema::create('pago_webs', function (Blueprint $table) {
            $table->id();
            $table->string('pago_web');
            $table->date('fecha');
            $table->string('realizado_por')->default('');
            $table->string('cedula')->default('');
            $table->string('telefono_celular')->default('');
            $table->string('imagen_pago')->default('');
            $table->float('monto', 22, 2)->default(0);
            $table->float('tasa', 12, 4)->default(0);
            $table->string('num_referencia')->default('');
            $table->enum('tipo_pago', ['M', 'T'])->default('T');
            $table->boolean('conciliado')->default(false);
            $table->boolean('confirmado')->default(false);
            $table->foreignId('banco_origen_id')->references('id')->on('bancos')->restrictOnDelete();
            $table->foreignId('banco_destino_id')->references('id')->on('bancos')->restrictOnDelete();
            $table->foreignId('cliente_id')->references('id')->on('clientes')->restrictOnDelete();
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
        Schema::dropIfExists('pago_webs');
    }
};