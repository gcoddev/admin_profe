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
        Schema::create('programa_inscripcion', function (Blueprint $table) {
            $table->bigIncrements('pi_id');
            $table->string('pi_doc_digital')->nullable();
            $table->enum('pi_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->enum('pi_modulo', ['modulo 1', 'modulo 2', 'modulo 3', 'modulo 4', 'modulo 5', 'modulo 6', 'modulo 7', 'inhabilitado'])->default('modulo 1');
            $table->bigInteger('per_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('per_id')
                ->on('map_persona');
            $table->foreignId('pro_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pro_id')
                ->on('programa');
            $table->foreignId('pro_tur_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pro_tur_id')
                ->on('programa_turno');
            $table->foreignId('sede_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('sede_id')
                ->on('sede');
            $table->foreignId('pie_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pie_id')
                ->on('programa_inscripcion_estado'); // PRE-INSCRITO INSCRITO BAJA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_inscripcion');
    }
};
