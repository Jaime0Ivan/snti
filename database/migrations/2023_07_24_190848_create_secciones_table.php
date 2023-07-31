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
        Schema::create('secciones', function (Blueprint $table) {
            $table->id();
            $table->string('Archivo');/**/ 
            $table->string('Titulo');
            $table->string('Descripcion');/**/ 
            $table->string('Nombre');/**/ 
            $table->string('Subtitulo');
            $table->text('Texto');
            $table->string('password')->nullable();/**/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones');
    }
};
