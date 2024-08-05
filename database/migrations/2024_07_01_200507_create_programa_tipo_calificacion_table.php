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
        Schema::create('programa_tipo_calificacion', function (Blueprint $table) {
            $table->bigIncrements('ptc_id');
            $table->string('ptc_nombre');
            $table->integer('ptc_nota');
            $table->enum('ptc_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_tipo_calificacion');
    }
};
