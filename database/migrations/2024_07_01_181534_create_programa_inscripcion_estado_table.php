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
        Schema::create('programa_inscripcion_estado', function (Blueprint $table) {
            $table->bigIncrements('pie_id');
            $table->string('pie_nombre'); // INSCRITO / PREINSCRITO / BAJA
            $table->enum('pie_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_inscripcion_estado');
    }
};
