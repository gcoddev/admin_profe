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
        Schema::create('programa', function (Blueprint $table) {
            $table->bigIncrements('pro_id');
            $table->string('pro_nombre');
            $table->text('pro_contenido');
            $table->string('pro_horario')->nullable();
            $table->integer('pro_carga_horaria');
            $table->integer('pro_costo');
            $table->string('pro_banner');
            $table->string('pro_afiche');
            $table->string('pro_convocatoria')->nullable();
            $table->date('pro_fecha_inicio_inscripcion');
            $table->date('pro_fecha_fin_inscripcion');
            $table->date('pro_fecha_inicio_clase');
            $table->boolean('pro_estado_inscripcion')->default(true);
            $table->enum('pro_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->foreignId('pd_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pd_id')
                ->on('programa_duracion');
            $table->foreignId('pv_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pv_id')
                ->on('programa_version');
            $table->foreignId('pro_tip_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pro_tip_id')
                ->on('programa_tipo');
            $table->foreignId('pm_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pm_id')
                ->on('programa_modalidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa');
    }
};
