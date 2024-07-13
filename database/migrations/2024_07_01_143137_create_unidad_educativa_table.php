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
        Schema::create('unidad_educativa', function (Blueprint $table) {
            $table->bigIncrements('uni_edu_id');
            $table->string('uni_edu_codigo');
            $table->string('uni_edu_nombre');
            $table->enum('uni_edu_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidad_educativa');
    }
};
