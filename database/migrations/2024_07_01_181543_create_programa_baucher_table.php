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
        Schema::create('programa_baucher', function (Blueprint $table) {
            $table->bigIncrements('pro_bau_id');
            $table->bigInteger('pro_bau_imagen');
            $table->bigInteger('pro_bau_nro_deposito')->nullable()->default(null);
            $table->integer('pro_bau_monto');
            $table->date('pro_bau_fecha');
            $table->enum('pro_bau_tipo_pago', ['Baucher', 'Descuento por Planilla'])->default('Baucher');
            $table->foreignId('pi_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('pi_id')
                ->on('programa_inscripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_baucher');
    }
};
