<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //   'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);
        /*
        DB::table('users')->insert([
            [
                'rut' => '12345678-9',
                'name' => 'Sebastián',
                'lastname' => 'Cabezas',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        DB::table('roles')->insert([
            [
                'nombre' => 'Admin',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Common',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        */
        DB::table('cargos')->insert([
            [
                'nombre' => 'Entrenador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Jugador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        DB::table('genero')->insert([
            [
                'icono' => 'ti tabler-gender-female',
                'nombre' => 'Femenino',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'icono' => 'ti tabler-gender-male',
                'nombre' => 'Masculino',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //oficios: hector
        DB::table('oficios')->insert([
            [
                'nombre' => 'Carpintero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Programador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Gasfiter',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Doctor',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Abogado',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Contador Auditor',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Enfermero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Electrico',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Soldador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Ingeniero Comercial',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Temporero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        //posiciones: ethan
        DB::table('posiciones')->insert([
            [
                'abreviatura' => 'POR',
                'nombre' => 'Portero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'LD',
                'nombre' => 'Lateral Derecho',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'LI',
                'nombre' => 'Lateral Izquierdo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'CAD',
                'nombre' => 'Carrilero Derecho',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'CAI',
                'nombre' => 'Carrilero Izquierdo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'DFC',
                'nombre' => 'Defensa Central',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MCD',
                'nombre' => 'Mediocentro Defensivo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MC',
                'nombre' => 'Mediocentro',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MCO',
                'nombre' => 'Mediocentro Ofensivo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MD',
                'nombre' => 'Medio Derecho',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'MI',
                'nombre' => 'Medio Izquierdo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'ED',
                'nombre' => 'Extremo Derecho',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'EI',
                'nombre' => 'Extremo Izquierdo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'DC',
                'nombre' => 'Delantero Centro',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'abreviatura' => 'SD',
                'nombre' => 'Segundo Delantero',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
        //premios: Luciano
        DB::table('premios')->insert([
            [
                'nombre' => 'Set Parrillero Artesanal',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Parrilla a Carbón',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Botella 750ml Jack Daniels',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Copa de Plata',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Medallas doradas',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Premio Mvp de la Final',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Zapatillas Nike Mercurial',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //categorias: robert
        DB::table('categoria')->insert([
            [
                'nombre' => 'Senior (Professional)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Senior (Amateur)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sub-20',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sub-23',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (5-7 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (8-9 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (10-11 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (12-13 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (14-15 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Junior (16-18 años)',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Medios de pago: Miguel
        DB::table('medios_pagos')->insert([
            [
                'nombre' => 'Efectivo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Transferencia',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Paypal',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'WebPayDebito',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'WebPayCredito',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'MercadoPago',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Cheque',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Comunas: Santos
        DB::table('comunas')->insert([
            [
                'nombre' => 'Arica',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Camarones',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Putre',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'San Bernardo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Pierna Buena: Vicente
        DB::table('pierna_dominante')->insert([
            [
                'nombre' => 'Derecha',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Izquierda',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Hora Inicio: Jean Piere
        DB::table('hora_inicio')->insert([
            [
                'nombre' => '18:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '18:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '19:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '19:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '20:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '20:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Hora Término: Gerard
        DB::table('hora_fin')->insert([
            [
                'nombre' => '19:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '19:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '20:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '20:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '21:00',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '21:30',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Medios de Contacto: Justin
        DB::table('medio_contacto')->insert([
            [
                'nombre' => 'Email',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Telefono',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'WhatsApp',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Instagram',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Facebook',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Twitter',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Aside: Justin
        DB::table('aside')->insert([
            [
                'nombre' => 'Roles',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.roles.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'cargos',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.cargos.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'recintos',
                'icono' => 'ti-icon-map-pin',
                'ruta' => 'backoffice.recintos.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'camisetas',
                'icono' => 'ti-icon-shirt',
                'ruta' => 'backoffice.camisetas.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'comunas',
                'icono' => 'ti-icon-building',
                'ruta' => 'backoffice.comunas.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'horainicio',
                'icono' => 'ti-icon-clock-hour-3',
                'ruta' => 'backoffice.horainicio.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'horafin',
                'icono' => 'ti-icon-clock-hour-3',
                'ruta' => 'backoffice.horafin.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'mediospagoa',
                'icono' => 'ti-icon-credit-card-pay',
                'ruta' => 'backoffice.mediospagos.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'premios',
                'icono' => 'ti-icon-trophy',
                'ruta' => 'backoffice.premios.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'posicion',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.posicion.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'diassemana',
                'icono' => '$ti-icon-calendar;',
                'ruta' => 'backoffice.diassemana.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'campeonato',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.campeonato.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'nacionalidad',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.nacionalidad.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'oficios',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.oficios.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'categoria',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.categoria.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'genero',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.genero.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'piernadominante',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.piernadominante.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'mediocontacto',
                'icono' => 'ti tabler-settings',
                'ruta' => 'backoffice.mediocontacto.index',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Recintos: Javiera
        DB::table('recintos')->insert([
            [
                'nombre' => 'Bongo Club',
                'activo' => true,
                'ubicacion' => 'América #670',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Cancha 13',
                'activo' => true,
                'ubicacion' => 'La Florida, cerca de Av. La Florida',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'F5 Santiago',
                'activo' => true,
                'ubicacion' => 'Huechuraba, Ciudad Empresarial',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Dorsales: Camisetas: Paula
        DB::table('camisetas')->insert([
            [
                'nombre' => '1',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '2',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '3',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '4',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '5',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '6',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '7',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '8',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '9',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '10',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '11',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '12',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '13',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '14',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '15',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '16',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '17',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '18',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '19',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => '20',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        //Dias de la semana: Indira
        DB::table('dias_semana')->insert([
            [
                'nombre' => 'Lunes',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Martes',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Miercoles',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Jueves',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Viernes',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //Nacionalidades: Manuel
        DB::table('nacionalidad')->insert([
            [
                'nombre' => 'Chilena',
                'pais_origen' => 'Chile',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Venezolana',
                'pais_origen' => 'Venezuela',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Colombiana',
                'pais_origen' => 'Colombia',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Peruana',
                'pais_origen' => 'Perú',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Haitiano',
                'pais_origen' => 'Haití',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);

        //Estados pagos: Malcolm
        DB::table('estadospago')->insert([
            [
                'nombre' => 'Pagado',
                'color' => 'success',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Pendiente',
                'color' => 'warning',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Moroso',
                'color' => 'danger',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        DB::table('estadosentrenamiento')->insert([
            [
                'nombre' => 'Programado',
                'color' => 'warning',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'En Progreso',
                'color' => 'success',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Cancelado',
                'color' => 'danger',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Finalizado',
                'color' => 'danger',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Partidos y Tipo: Malcolm, Miguel y Justin
        DB::table('tipopartido')->insert([
            [
                'nombre' => 'Amistoso',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Campeonato',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Entrenamiento',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        $rolAdmin = Role::firstOrCreate(['name' => 'admin']);
        $rolJugador = Role::firstOrCreate(['name' => 'jugador']);
        $rolEntrenador = Role::firstOrCreate(['name' => 'entrenador']);

        $adminPermissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-activate',
            'user-view',

            'rol-list',
            'rol-create',
            'rol-edit',
            'rol-delete',
            'rol-activate',
            'rol-view',

            'cargos-list',
            'cargos-create',
            'cargos-edit',
            'cargos-delete',
            'cargos-activate',
            'cargos-view',

            'comunas-list',
            'comunas-create',
            'comunas-edit',
            'comunas-delete',
            'comunas-activate',
            'comunas-view',

            'generos-list',
            'generos-create',
            'generos-edit',
            'generos-delete',
            'generos-activate',
            'generos-view',

            'oficios-list',
            'oficios-create',
            'oficios-edit',
            'oficios-delete',
            'oficios-activate',
            'oficios-view',

            'posiciones-list',
            'posiciones-create',
            'posiciones-edit',
            'posiciones-delete',
            'posiciones-activate',
            'posiciones-view',

            'premios-list',
            'premios-create',
            'premios-edit',
            'premios-delete',
            'premios-activate',
            'premios-view',

            'categorias-list',
            'categorias-create',
            'categorias-edit',
            'categorias-delete',
            'categorias-activate',
            'categorias-view',

            'mediospagos-list',
            'mediospagos-create',
            'mediospagos-edit',
            'mediospagos-delete',
            'mediospagos-activate',
            'mediospagos-view',

            'recintos-list',
            'recintos-create',
            'recintos-edit',
            'recintos-delete',
            'recintos-activate',
            'recintos-view',

            'camisetas-list',
            'camisetas-create',
            'camisetas-edit',
            'camisetas-delete',
            'camisetas-activate',
            'camisetas-view',

            'campeonato-list',
            'campeonato-create',
            'campeonato-edit',
            'campeonato-delete',
            'campeonato-activate',
            'campeonato-view',

            'diassemana-list',
            'diassemana-create',
            'diassemana-edit',
            'diassemana-delete',
            'diassemana-activate',
            'diassemana-view',

            'piernadominante-list',
            'piernadominante-create',
            'piernadominante-edit',
            'piernadominante-delete',
            'piernadominante-activate',
            'piernadominante-view',

            'horaInicio-list',
            'horaInicio-create',
            'horaInicio-edit',
            'horaInicio-delete',
            'horaInicio-activate',
            'horaInicio-view',

            'horaFin-list',
            'horaFin-create',
            'horaFin-edit',
            'horaFin-delete',
            'horaFin-activate',
            'horaFin-view',

            'mediocontacto-list',
            'mediocontacto-create',
            'mediocontacto-edit',
            'mediocontacto-delete',
            'mediocontacto-activate',
            'mediocontacto-view',

            'nacionalidad-list',
            'nacionalidad-create',
            'nacionalidad-edit',
            'nacionalidad-delete',
            'nacionalidad-activate',
            'nacionalidad-view',

            'perfil-list',
            'perfil-create',
            'perfil-edit',
            'perfil-delete',
            'perfil-activate',
            'perfil-view',

            'categoria-list',
            'categoria-create',
            'categoria-edit',
            'categoria-delete',
            'categoria-activate',
            'categoria-view',

            'jugadores-list',
            'jugadores-create',
            'jugadores-edit',
            'jugadores-delete',
            'jugadores-activate',
            'jugadores-view',

            'entrenamiento-list',
            'entrenamiento-create',
            'entrenamiento-edit',
            'entrenamiento-delete',
            'entrenamiento-activate',
            'entrenamiento-view',
        ];


        $jugadorPermissions = [
            'perfil-view',
            'campeonato-list',
            'premios-list',
            'posiciones-list',
            'categoria-list',
            'recintos-list',
            'diassemana-list',
            'mediocontacto-list',
            'piernadominante-list',
            'camisetas-list',
        ];


        $entrenadorPermissions = [
            'perfil-view',
            'jugadores-list',
            'jugadores-edit',
            'categoria-list',
            'campeonato-list',
            'premios-list',
            'posiciones-list',
            'recintos-list',
            'diassemana-list',
            'mediocontacto-list',
            'piernadominante-list',
            'entrenamiento-create',
            'entrenamiento-edit',
            'entrenamiento-list'
        ];

        // Asignar esos permisos a los roles especificos
        foreach ($adminPermissions as $permiso) {
            $permission = Permission::firstOrCreate(['name' => $permiso]); // se crean los permisos
            $rolAdmin->givePermissionTo($permission); // se asignan los permisos al rol admin
        }

        foreach ($jugadorPermissions as $permiso) {
            $permission = Permission::firstOrCreate(['name' => $permiso]); // se crean los permisos
            $rolJugador->givePermissionTo($permission); // se asignan los permisos al rol jugador
        }

        foreach ($entrenadorPermissions as $permiso) {
            $permission = Permission::firstOrCreate(['name' => $permiso]); // se crean los permisos
            $rolEntrenador->givePermissionTo($permission); // se asignan los permisos al rol entrenador
        }

        // Obtener los cargos creados
        $cargoEntrenador = DB::table('cargos')->where('nombre', 'Entrenador')->first();
        $cargoJugador = DB::table('cargos')->where('nombre', 'Jugador')->first();

        // Crear usuarios de prueba
        $adminUser = User::firstOrCreate(
            ['rut' => '12345678-9'],
            [
                'name' => 'Sebastián',
                'lastname' => 'Cabezas',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => $cargoEntrenador->id, // Admin será entrenador
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $jugadorUser = User::firstOrCreate(
            ['rut' => '21176572-0'],
            [
                'name' => 'Ethan',
                'lastname' => 'Mayorines',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => $cargoJugador->id, // Jugador
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $entrenadorUser = User::firstOrCreate(
            ['rut' => '20954121-1'],
            [
                'name' => 'Martina',
                'lastname' => 'Antilef',
                'password' => Hash::make('holaMundo'),
                'fechaNacimiento' => '1987-06-08',
                'generoId' => 2,
                'cargoId' => $cargoEntrenador->id, // Entrenador
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        DB::table('desarrollador')->insert([
            [
                'nombre' => 'Sebastián Cabezas',
                'foto' => 'https://www.sonkei.cl/imgs/team/ipss-v1/hectorGonzalez.webp',
                // 'medios_contacto' => '[{"nombre":"email","url":"mailto:sebastian.cabezas@docente.ipss.cl"},{"nombre":"GitHub","url":"https://www.github.com/scabezas-ipss"}]',
                'rol' => 'Docente a cargo del Desarrollo',
                'version_software' => '1.0',
                'descripcion_funcionalidades' => 'Docente especialista en desarrollo de software, especializado en Laravel y resolución de errores de los estudiantes.',
            ],
        ]);

        $adminUser->assignRole($rolAdmin); // Asignar el rol admin al usuario admin
        $jugadorUser->assignRole($rolJugador); // Asignar el rol cliente al usuario cliente
        $entrenadorUser->assignRole($rolEntrenador); // Asignar el rol entrenador al usuario entrenador
    }
}
