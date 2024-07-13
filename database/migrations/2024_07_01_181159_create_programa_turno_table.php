<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programa_turno', function (Blueprint $table) {
            $table->bigIncrements('pro_tur_id');
            $table->string('pro_tur_nombre'); // sabado mañana - sabado tarde - Domingo mañana etc
            $table->enum('pro_tur_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_turno');
    }
};
