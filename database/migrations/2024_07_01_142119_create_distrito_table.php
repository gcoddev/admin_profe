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
        Schema::create('distrito', function (Blueprint $table) {
            $table->bigIncrements('dis_id');
            $table->integer('dis_codigo');
            $table->string('dis_nombre');
            $table->enum('dis_estado', ['activo', 'inactivo','eliminado'])->default('activo');
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
        Schema::dropIfExists('distrito');
    }
};
