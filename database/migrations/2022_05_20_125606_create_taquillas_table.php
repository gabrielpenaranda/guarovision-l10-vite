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
        Schema::create('taquillas', function (Blueprint $table) {
            $table->id();
            $table->string('taquilla');
            $table->enum('tipo_taquilla', ['Web', 'Física'])->default('Física');
            $table->string('direccion');
            $table->foreignId('ciudad_id')->references('id')->on('ciudades')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('taquillas');
    }
};
