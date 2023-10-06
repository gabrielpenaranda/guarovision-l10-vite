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
        Schema::create('impuesto_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('impuesto_id')->references('id')->on('impuestos')->cascadeOnDelete();
            $table->foreignId('plan_id')->references('id')->on('planes')->cascadeOnDelete();
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
        Schema::dropIfExists('impuesto_plan');
    }
};
