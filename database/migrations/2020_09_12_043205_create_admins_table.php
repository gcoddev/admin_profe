<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('cargo')->nullable();
            $table->integer('celular')->nullable();
            $table->bigInteger('per_id')->unique()->nullable();
            $table->json('sede_ids')->nullable();
            $table->json('pro_ids')->nullable();
            $table->string('correo')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
