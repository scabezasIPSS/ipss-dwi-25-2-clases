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
        Schema::create('entrenamientos', function (Blueprint $table) {
            $table->id();
            // Clave foránea a la tabla entrenadores
            $table->integer('entrenador_id');
            //$table->foreignId('entrenador_id'); //de javi
                //->constrained('entrenadores') // asegúrate de que esta tabla exista
                //->onDelete('restrict');
            $table->foreignId('categoria_id')
                ->constrained('categoria') // asegúrate de que esta tabla exista
                ->onDelete('restrict');
            $table->foreignId('recinto_id')
                ->constrained('recintos') // asegúrate de que esta tabla exista
                ->onDelete('restrict');
            $table->foreignId('dia_id')
                ->constrained('dias_semana') // asegúrate de que esta tabla exista
                ->onDelete('restrict');
            // Clave foránea a la tabla horarios para hora de inicio
            $table->foreignId('hora_inicio_id')
                ->constrained('hora_inicio') // asegúrate de que esta tabla exista
                ->onDelete('restrict');
            // Clave foránea a la tabla horarios para hora de fin
            $table->foreignId('hora_fin_id')
                ->constrained('hora_fin') // puedes usar otra tabla si es necesario
                ->onDelete('restrict');
            // Clave foránea a la tabla estados (programado, en juego, finalizado, etc.)
            $table->foreignId('estado_id')
                ->constrained('estadosentrenamiento')
                ->onDelete('restrict');
            $table->timestamp('fecha');
            // Estado activo
            $table->boolean('activo')->default(true);
        
            $table->timestamps();
        });
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
        Schema::create('jugadorDelMes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jugadorId');
            $table->foreign('jugadorId')->references('id')->on('jugadores')->onDelete('cascade');
            $table->unsignedTinyInteger('mes');
            $table->unsignedSmallInteger('año');
            $table->string('descripcion', 300);
            $table->dateTime('fechaPublicacion');
            $table->unique(['año','mes']);
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
        Schema::dropIfExists('entrenamientos');
    }
};
