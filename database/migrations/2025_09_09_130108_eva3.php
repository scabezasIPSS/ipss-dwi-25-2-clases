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
        Schema::create('persona', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->unique()->constrained('users')->onDelete('cascade');
            $table->foreignId('generoId')->nullable()->constrained('genero')->onDelete('set null');
            //$table->string('correo')->unique();
            //$table->string('telefono')->nullable();
            //$table->string('direccion')->nullable();
            //$table->foreignId('comuna_id')->nullable()->constrained('comunas')->onDelete('set null');
            $table->foreignId('oficiosId')->nullable()->constrained('oficios')->onDelete('set null');
            //$table->foreignId('medio_contacto_id')->nullable()->constrained('medio_contacto')->onDelete('set null');
            $table->foreignId('nacionalidadId')->nullable()->constrained('nacionalidad')->onDelete('set null');
            $table->integer('edad')->nullable();
            $table->timestamps();
        });

        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personaId')->unique()->constrained('persona')->onDelete('cascade');

            // Clave foránea a pierna_dominante
            $table->foreignId('pierna_dominante_id')
                ->constrained('pierna_dominante')
                ->onDelete('restrict');

            // Clave foránea a posiciones
            $table->foreignId('posicionesId')
                ->constrained('posiciones')
                ->onDelete('restrict');

            // Clave foránea a camisetas
            $table->foreignId('camisetasId')
                ->constrained('camisetas')
                ->onDelete('restrict');

            // Estado activo
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });

        Schema::create('entrenamientos', function (Blueprint $table) {
            $table->id();
            $table->string('entrenador');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('campeonato', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('ubicacion')->nullable();
            $table->foreignId('comunaId')
                ->constrained('comuna');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        Schema::create('campeonatos_equipos', function (Blueprint $table) {
            $table->id();
            $table->integer('campeonatoId');
            $table->integer('equipoId');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Equipos, equipos-jugadores: Luciano, JP, Gerald

        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('apodo')->nullable();
            $table->date('fundacion')->nullable();
            $table->integer('trofeos')->nullable();
            $table->string('presidente')->nullable();
            $table->string('colores')->nullable();
            $table->boolean('activo')->default(true);
            
            // Columna para la clave foránea
            $table->unsignedBigInteger('recintoID')->nullable();

            $table->timestamps();

            // Clave foránea que referencia a la tabla `recintos`
            $table->foreign('recintoID')->references('id')->on('recintos')->onDelete('set null');
        });

        Schema::create('equipo_jugador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
            $table->foreignId('jugador_id')->constrained('jugadores')->onDelete('cascade');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenamientos');
        Schema::dropIfExists('jugadores');
        Schema::dropIfExists('persona');
        Schema::dropIfExists('equipos');
        Schema::dropIfExists('campeonato');
        Schema::dropIfExists('campeonatos_equipos');
    }
};
