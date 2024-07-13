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
        Schema::create('sede', function (Blueprint $table) {
            $table->bigIncrements('sede_id');
            $table->string('sede_imagen')->nullable()->default(null);
            $table->string('sede_nombre');
            $table->text('sede_descripcion');
            $table->string('sede_imagen_responsable1')->nullable();
            $table->string('sede_nombre_responsable1')->nullable();
            $table->string('sede_cargo_responsable1')->nullable();
            $table->string('sede_imagen_responsable2')->nullable();
            $table->string('sede_nombre_responsable2')->nullable();
            $table->string('sede_cargo_responsable2')->nullable();
            $table->integer('sede_contacto_1');
            $table->integer('sede_contacto_2')->nullable();
            $table->string('sede_facebook')->nullable();
            $table->string('sede_tiktok')->nullable();
            $table->string('sede_grupo_whatsapp')->nullable();
            $table->string('sede_horario');
            $table->string('sede_turno');
            $table->text('sede_ubicacion');
            $table->decimal('sede_latitud', 11, 8)->nullable()->default(null);
            $table->decimal('sede_longitud', 11, 8)->nullable()->default(null);
            $table->enum('sede_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->foreignId('dep_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('dep_id')
                ->on('departamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sede');
    }
};
