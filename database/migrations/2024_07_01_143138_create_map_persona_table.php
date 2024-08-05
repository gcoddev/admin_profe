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
        Schema::create('map_persona', function (Blueprint $table) {
            $table->bigIncrements('per_id');
            $table->bigInteger('per_rda')->nullable();
            $table->bigInteger('per_dgesttla')->nullable();
            $table->bigInteger('per_didep')->nullable();
            $table->bigInteger('per_ci');
            $table->string('per_complemento')->nullable();
            $table->string('per_nombre1')->nullable();
            $table->string('per_nombre2')->nullable();
            $table->string('per_apellido1')->nullable();
            $table->string('per_apellido2')->nullable();
            $table->date('per_fecha_nacimiento');
            $table->integer('per_celular')->default(0);
            $table->string('per_correo')->default('sincorreo');
            $table->boolean('per_en_funcion')->default(true);
            $table->boolean('per_libreta_militar')->default(true);
            $table->integer('uni_edu_id')->nullable()->default(0);
            $table->enum('per_estado', ['activo', 'inactivo','eliminado'])->default('activo');
            $table->foreignId('gen_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('gen_id')
                ->on('genero');
            $table->foreignId('esp_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('esp_id')
                ->on('map_especialidad');
            $table->foreignId('cat_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('cat_id')
                ->on('map_categoria');
            $table->foreignId('car_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('car_id')
                ->on('map_cargo');
            $table->foreignId('sub_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('sub_id')
                ->on('map_subsistema');
            $table->foreignId('niv_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('niv_id')
                ->on('map_nivel');
            $table->foreignId('area_id')
                ->constrained()
                ->onDelete('cascade')
                ->references('area_id')
                ->on('area_trabajo');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_persona');
    }
};
