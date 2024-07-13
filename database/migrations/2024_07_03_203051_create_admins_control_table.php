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
        Schema::create('admins_control', function (Blueprint $table) {
            $table->bigIncrements('adm_id');
            $table->string('adm_titulo');
            $table->string('adm_descripcion')->nullable();
            $table->string('adm_tabla')->nullable();
            $table->string('adm_ip')->nullable();
            $table->string('adm_nombre_maquina')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins_control');
    }
};
