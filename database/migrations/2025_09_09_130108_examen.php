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
        Schema::create('desarrollador', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('foto');
            // $table->string('medios_contacto');
            $table->string('rol');
            $table->string('version_software');
            $table->text('descripcion_funcionalidades');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        //Partidos: Malcolm, Justin, Miguel
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->string('entrenadorID');
            $table->string('categoriaID');
            $table->string('recintoID');
            $table->string('diaID');
            $table->time('hora_inicioID');
            $table->time('hora_finID');
            $table->string('tipoID');
            $table->time('estadoID');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
        Schema::create('tipopartido', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desarrollador');
    }
};
