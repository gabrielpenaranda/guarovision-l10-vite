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
        Schema::create('bancos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique()->default('');
            $table->string('banco')->unique();
            $table->boolean('pago_movil')->default(false);
            $table->string('pago_movil_nombre')->nullable();
            $table->string('pago_movil_telefono')->nullable();
            $table->string('pago_movil_rif')->nullable();
            $table->boolean('transferencia')->default(false);
            $table->string('transferencia_cuenta')->nullable();
            $table->string('transferencia_nombre')->nullable();
            $table->string('transferencia_rif')->nullable();
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
        Schema::dropIfExists('bancos');
    }
};