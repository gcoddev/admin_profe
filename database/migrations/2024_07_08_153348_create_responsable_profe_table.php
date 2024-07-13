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
        Schema::create('responsable_profe', function (Blueprint $table) {
            $table->bigIncrements('resp_profe_id');
            $table->string('resp_profe_imagen');
            $table->string('resp_profe_nombre_completo');
            $table->integer('resp_profe_celular')->nullable()->default(null);
            $table->string('resp_profe_cargo')->nullable()->default(null);
            $table->string('resp_profe_facebook')->nullable()->default(null);
            $table->string('resp_profe_tiktok')->nullable()->default(null);
            $table->string('resp_profe_correo')->nullable()->default(null);
            $table->string('resp_profe_pagina')->nullable()->default(null);
            $table->string('resp_profe_youtube')->nullable()->default(null);
            $table->enum('resp_profe_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsable_resp_profe');
    }
};
