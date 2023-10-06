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
        Schema::create('impuesto_recibo', function (Blueprint $table) {
            $table->id();
            $table->float('monto_impuesto', 18, 2);
            $table->foreignId('impuesto_id')->references('id')->on('impuestos')->restrictOnDelete();
            $table->foreignId('recibo_id')->references('id')->on('recibos')->restrictOnDelete();
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
        Schema::dropIfExists('impuesto_recibo');
    }
};
