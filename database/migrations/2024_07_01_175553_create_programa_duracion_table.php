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
        //////////////////////////////////////////////   REVISAR
        Schema::create('programa_duracion', function (Blueprint $table) {
            $table->bigIncrements('pd_id');
            $table->string('pd_nombre');   // 1 mes
            $table->integer('pd_semana');
            $table->enum('pd_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_duracion');
    }
};
