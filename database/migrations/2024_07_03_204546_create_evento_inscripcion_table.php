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
        Schema::create('evento_inscripcion', function (Blueprint $table) {
            $table->bigIncrements('eve_ins_id');
            $table->bigInteger('eve_ins_carnet_identidad');
            $table->string('eve_ins_carnet_complemento');
            $table->string('eve_ins_nombre_1');
            $table->string('eve_ins_nombre_2');
            $table->string('eve_ins_apellido_1');
            $table->string('eve_ins_apellido_2');
            $table->date('eve_ins_fecha_nacimiento');
            $table->string('eve_correo');
            $table->string('eve_celular');
            $table->boolean('eve_asistencia')->default(false);
            $table->enum('eve_ins_estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
            $table->foreignId('eve_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('eve_id')
                ->on('evento');
            $table->foreignId('gen_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('gen_id')
                ->on('genero');
            $table->foreignId('dep_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('dep_id')
                ->on('departamento');
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
        Schema::dropIfExists('evento_inscripcion');
    }
};
