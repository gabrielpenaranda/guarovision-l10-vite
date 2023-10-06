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
        Schema::create('pago_exentos', function (Blueprint $table) {
            $table->id();
            $table->string('pago_exento');
            $table->float('monto', 22, 2);
            $table->float('monto_divisa', 8, 2)->default(0);
            $table->boolean('reversado')->default(false);
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
        Schema::dropIfExists('pago_exentos');
    }
};