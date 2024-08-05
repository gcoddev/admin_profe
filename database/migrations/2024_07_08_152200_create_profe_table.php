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
        Schema::create('profe', function (Blueprint $table) {
            $table->bigIncrements('profe_id');
            $table->string('profe_imagen');
            $table->string('profe_nombre');
            $table->text('profe_descripcion');
            $table->text('profe_sobre_nosotros');
            $table->text('profe_mision');
            $table->text('profe_vision');
            $table->text('profe_actividad');
            $table->date('profe_fecha_creacion');
            $table->string('profe_correo')->nullable()->default(null);
            $table->string('profe_celular')->nullable()->default(null);
            $table->string('profe_telefono')->nullable()->default(null);
            $table->string('profe_pagina')->nullable()->default(null);
            $table->string('profe_facebook')->nullable()->default(null);
            $table->string('profe_tiktok')->nullable()->default(null);
            $table->string('profe_youtube')->nullable()->default(null);
            $table->text('profe_ubicacion');
            $table->decimal('profe_latitud', 11, 8)->nullable()->default(null);
            $table->decimal('profe_longitud', 11, 8)->nullable()->default(null);
            $table->string('profe_banner');
            $table->string('profe_afiche');
            $table->string('profe_convocatoria');
            $table->enum('profe_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profe');
    }
};
