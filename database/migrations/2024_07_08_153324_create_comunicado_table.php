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
        Schema::create('comunicado', function (Blueprint $table) {
            $table->bigIncrements('comun_id');
            $table->string('comun_imagen');
            $table->string('comun_nombre');
            $table->text('comun_descripcion');
            $table->enum('comun_importancia', ['importante', 'normal'])->default('normal');
            $table->enum('comun_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunicado');
    }
};
