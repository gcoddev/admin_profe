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
        Schema::create('programa_calificacion', function (Blueprint $table) {
            $table->bigIncrements('pc_id');
<<<<<<< HEAD
=======
            $table->json('ptc_ids');
>>>>>>> 278a853 (first commit)
            $table->enum('pc_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->foreignId('pro_tip_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pro_tip_id')
                ->on('programa_tipo');
<<<<<<< HEAD
            $table->foreignId('ptc_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('ptc_id')
                ->on('programa_tipo_calificacion');
=======
>>>>>>> 278a853 (first commit)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_calificacion');
    }
};
