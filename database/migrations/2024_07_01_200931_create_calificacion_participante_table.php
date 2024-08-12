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
        Schema::create('calificacion_participante', function (Blueprint $table) {
            $table->bigIncrements('cp_id');
<<<<<<< HEAD
            $table->integer('cp_puntaje');
=======
            $table->string('cp_descripcion');
            $table->json('cp_puntaje');
>>>>>>> 278a853 (first commit)
            $table->foreignId('pi_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pi_id')
                ->on('programa_inscripcion');
            $table->foreignId('pm_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pm_id')
                ->on('programa_modulo');
<<<<<<< HEAD
            $table->foreignId('pc_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pc_id')
                ->on('programa_calificacion');
            $table->enum('cp_estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
=======
            $table->enum('cp_estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
            $table->enum('cp_calificacion', ['reprobado', 'aprobado', 'sin calificar'])->default('sin calificar');
>>>>>>> 278a853 (first commit)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacion_participante');
    }
};
