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
        Schema::create('evento', function (Blueprint $table) {
            $table->bigIncrements('eve_id');
            $table->string('eve_nombre');
            $table->text('eve_descripcion');
            $table->string('eve_banner');
            $table->string('eve_afiche');
            $table->json('pm_ids'); // MODALIDAD PRESENCIAL VIRTUAL
            $table->date('eve_fecha');
            $table->boolean('eve_inscripcion')->default(true);
            $table->time('eve_ins_hora_asis_habilitado');
            $table->time('eve_ins_hora_asis_deshabilitado');
            $table->string('eve_convocatoria');
            $table->bigInteger('eve_total_inscrito');
            $table->enum('eve_estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
            $table->foreignId('et_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('et_id')
                ->on('tipo_evento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento');
    }
};
