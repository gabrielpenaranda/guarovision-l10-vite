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
        Schema::create('concepto_impuesto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('impuesto_id')->references('id')->on('impuestos')->cascadeOnDelete();
            $table->foreignId('concepto_id')->references('id')->on('conceptos')->cascadeOnDelete();
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
        Schema::dropIfExists('concepto_impuesto');
    }
};
