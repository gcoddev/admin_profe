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
        Schema::create('programa_modulo', function (Blueprint $table) {
            $table->bigIncrements('pm_id');
            $table->string('pm_nombre');
            $table->string('pm_descripcion');
            $table->integer('pm_nota_minima')->default(69);
            $table->date('pm_fecha_inicio');
            $table->date('pm_fecha_fin');
            $table->enum('pm_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->foreignId('pro_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pro_id')
                ->on('programa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_modulo');
    }
};
