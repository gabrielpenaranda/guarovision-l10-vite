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
        Schema::create('pago_taquillas', function (Blueprint $table) {
            $table->id();
            $table->string('pago_taquilla');
            $table->date('fecha');
            $table->float('monto_total', 22, 2);
            $table->float('monto_efectivo_bs', 22, 2)->default(0);
            $table->float('monto_efectivo_divisa', 22, 2)->default(0);
            $table->float('monto_pos', 22, 2)->default(0);
            $table->float('tasa', 12, 2)->default(0);
            $table->foreignId('divisa_id')->nullable()->references('id')->on('divisas')->restrictOnDelete();
            $table->foreignId('banco_pos_id')->nullable()->references('id')->on('bancos')->restrictOnDelete();
            $table->foreignId('taquilla_id')->references('id')->on('recibos')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('cliente_id')->references('id')->on('clientes')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('pago_taquillas');
    }
};