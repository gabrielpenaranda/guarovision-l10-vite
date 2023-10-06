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
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->date('fecha');
            $table->date('fecha_vencimiento');
            $table->string('concepto');
            $table->float('monto_divisa', 20, 2);
            $table->float('saldo', 20, 2);
            $table->boolean('pagada')->default(false);
            $table->boolean('exento')->default(false);
            $table->foreignId('cliente_id')->references('id')->on('clientes')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('divisa_id')->references('id')->on('divisas')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('recibos');
    }
};