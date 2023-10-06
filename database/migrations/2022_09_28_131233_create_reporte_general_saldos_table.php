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
        Schema::create('reporte_general_saldos', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('fecha');
            $table->string('numero');
            $table->string('concepto');
            $table->float('monto_divisa', 20, 2);
            $table->float('saldo', 20, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reporte_general_saldo');
    }
};
