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
        Schema::create('programa_sede_turno', function (Blueprint $table) {
            $table->bigIncrements('psp_id');
            $table->json('pro_tur_ids');
            //$table->integer('psp_cupo');
            $table->integer('pro_cupo');
            $table->integer('pro_cupo_preinscrito');
            $table->enum('pst_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->foreignId('sede_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('sede_id')
                ->on('sede');
            $table->foreignId('pro_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pro_id')
                ->on('programa');
            // Índice único compuesto para sede_id y pro_id
            $table->unique(['sede_id', 'pro_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_sede_turno');
    }
};
