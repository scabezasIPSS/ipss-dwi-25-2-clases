<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JugadoresModel;
use App\Models\GeneroModel;
use App\Models\ComunasModel;
use App\Models\OficiosModel;
use App\Models\MedioContactoModel;
use App\Models\PosicionModel;
use App\Models\PiernaDominanteModel;
use App\Models\CargosModel;
use App\Models\NacionalidadModel;
use App\Models\CamisetasModel;
use App\Models\JugadorDelMesModel;
use Illuminate\Support\Facades\DB;
use App\Services\PersonaService;
use Illuminate\Validation\Rule;
use Carbon\Carbon;




class JugadorDelMesController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();


        $lista = JugadoresModel::with([
            'persona.user',
            'persona.genero',
            //'persona.comuna',
            'persona.oficio',
            'persona.nacionalidad',
            //'persona.medioContacto',
            'piernaDominante',
            'posicion', // Relación principal para FK posiciones_id
        ])->get();

        $listaGeneros = GeneroModel::all()->where('activo', 1);
        $listaOficios = OficiosModel::all()->where('activo', 1);
        $listaNacionalidad = NacionalidadModel::all()->where('activo', 1);
        $listaPosiciones = PosicionModel::all()->where('activo', 1);
        $listaPiernaDominante = PiernaDominanteModel::all()->where('activo', 1);
        $listaCamisetas = CamisetasModel::all()->where('activo', 1);
        $listaJugadores = JugadoresModel::all()->where('activo', 1);

        // dd($listaNacionalidad);
        $listaMeses = collect([
            ['id' => 1,  'nombre' => 'Enero'],
            ['id' => 2,  'nombre' => 'Febrero'],
            ['id' => 3,  'nombre' => 'Marzo'],
            ['id' => 4,  'nombre' => 'Abril'],
            ['id' => 5,  'nombre' => 'Mayo'],
            ['id' => 6,  'nombre' => 'Junio'],
            ['id' => 7,  'nombre' => 'Julio'],
            ['id' => 8,  'nombre' => 'Agosto'],
            ['id' => 9,  'nombre' => 'Septiembre'],
            ['id' => 10, 'nombre' => 'Octubre'],
            ['id' => 11, 'nombre' => 'Noviembre'],
            ['id' => 12, 'nombre' => 'Diciembre'],
        ]);

        $listaJugadoresOptions = JugadoresModel::where('activo', 1)
            ->with(['persona.user', 'posicion'])
            ->get()
            ->map(function ($j) {
                $nombre = $j->persona && $j->persona->user
                    ? trim($j->persona->user->name . ' ' . $j->persona->user->lastname)
                    : "Jugador #{$j->id}";
                if (!empty($j->posicion?->nombre)) {
                    $nombre .= ' — ' . $j->posicion->nombre;
                }
                return ['id' => $j->id, 'nombre' => $nombre];
            });


        // === NUEVO: cargar Jugadores del Mes ya guardados
        $destacados = JugadorDelMesModel::with([
            'jugador.persona',
            'jugador.posicion',
            'jugador.piernaDominante',
            'jugador.persona.nacionalidad',
        ])->orderByDesc('fechaPublicacion')->get();






        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => '/assets/imgs/logo_sonkei_v2.webp',
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'mantenedor' => [
                'titulo' => 'Jugador del mes',
                'instruccion' => 'Listado de los jugadores.',
                'routes' => [
                    'new'    => 'backoffice.jugadorDelMes.new',
                    'update' => 'backoffice.jugadorDelMes.update',
                    'delete' => 'backoffice.jugadorDelMes.destroy',
                    'up'     => 'backoffice.jugadorDelMes.up',
                    'down'   => 'backoffice.jugadorDelMes.down',
                ],
                'fields' => [
                    /*[
                        'label' => 'RUT',
                        'name' => 'rut',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'min' => 3,
                            'max' => null,
                            'classList' => ['form-control', 'mb-4'],
                            'placeholder' => '12.345.678-9'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],*/
                    //Jugador
                    [
                        'label' => 'Jugador',
                        'name' => 'jugadorId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options'   => $listaJugadoresOptions,
                            'disabled'  => $listaJugadoresOptions->isEmpty(),
                            'placeholder' => $listaJugadoresOptions->isEmpty() ? 'Sin registros' : 'Seleccione jugador',

                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],


                    //Mes
                    [
                        'label' => 'Mes',
                        'name' => 'mesId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $listaMeses,          // ← aquí el cambio
                            'placeholder' => 'Seleccione un mes',
                            'default' => date('n'),
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],


                    // Año (INPUT, no select)
                    [
                        'label' => 'Año',
                        'name' => 'anio',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'number',
                            'classList' => ['form-control', 'mb-4'],
                            'placeholder' => 'Año (YYYY)',
                            'min' => 4,                               // <- el modal usa minlength
                            'max' => 4,                               // <- el modal usa maxlength
                            'value' => now()->year,
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn'     => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true],
                        ],
                    ],

                    // Publicar el (fecha/hora)
                    [
                        'label' => 'Publicar el',
                        'name' => 'publish_at',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'datetime-local',
                            'classList' => ['form-control', 'mb-4'],
                            'placeholder' => 'aaaa-mm-dd hh:mm',
                            'min' => 16,                              // longitud tipo "2025-09-12T14:30"
                            'max' => 16,
                            'value' => now()->format('Y-m-d\TH:i'),
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn'     => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true],
                        ],
                    ],
                    // Descripción del jugador del mes
                    [
                        'label' => 'Descripción',
                        'name' => 'descripcion',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control', 'mb-4'],
                            'placeholder' => 'Breve descripción del destacado',
                            'min' => 10,
                            'max' => 300,
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn'     => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true],
                        ],
                    ],
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/jugadorDelMes/index', compact('datos', 'user', 'lista', 'destacados'));
    }



    /*
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $validated = $request->validate([
            'nombre'              => ['required', 'string', 'min:3', 'max:50'],
            'apellido'            => ['required', 'string', 'min:2', 'max:50'],
            'rut'                 => ['required', 'string', 'unique:users,rut'],
            // 'edad'              => ['required', 'integer', 'min:0'], // <- comentado o eliminado
            'generoId'            => ['required', Rule::exists('genero', 'id')],
            //'telefono'            => ['required', 'string', 'min:3'],
            //'correo'              => ['required', 'email', 'unique:persona,correo'],
            //'direccion'           => ['required', 'string', 'min:3', 'max:100'],
            // cargo eliminado
            //'comuna_id'           => ['required', Rule::exists('comunas', 'id')],
            'oficiosId'          => ['required', Rule::exists('oficios', 'id')],
            //'medio_contacto_id'   => ['required', Rule::exists('medio_contacto', 'id')],
            'nacionalidadId'     => ['required', Rule::exists('nacionalidad', 'id')],
            'posicionesId'       => ['required', Rule::exists('posiciones', 'id')],
            'pierna_dominante_id' => ['required', Rule::exists('pierna_dominante', 'id')],
            'fechaNacimiento'     => ['required', 'date'],
            'camisetasId'       => ['required', Rule::exists('camisetas', 'id')],
        ], $this->messages);

        $idCargoJugador = 2;

        // Cálculo de edad
        $fechaNacimiento = $validated['fechaNacimiento'];
        $edad = Carbon::parse($fechaNacimiento)->age;

        $personaService = app(PersonaService::class);
        $persona = $personaService->crearConUsuario([
            'nombre'             => $validated['nombre'],
            'apellido'           => $validated['apellido'],
            'rut'                => $validated['rut'],
            'edad'               => $edad, // <-- edad calculada
            //'telefono'           => $validated['telefono'],
            //'correo'             => $validated['correo'],
            //'direccion'          => $validated['direccion'],
            'nacionalidadId'    => $validated['nacionalidadId'],
            //'comuna_id'          => $validated['comuna_id'],
            'oficiosId'         => $validated['oficiosId'],
            //'medio_contacto_id'  => $validated['medio_contacto_id'],
            'cargoId'            => $idCargoJugador,
            'generoId'           => $validated['generoId'],
            'fechaNacimiento'    => $fechaNacimiento,
            'camisetasId'      => $validated['camisetasId']
        ]);


        // Crear jugador vinculado a la persona
        JugadoresModel::create([
            'personaId'          => $persona->id,
            'pierna_dominante_id'  => $validated['pierna_dominante_id'],
            'posicionesId'         => $validated['posicionesId'],
            'camisetasId'       => $validated['camisetasId'],
            'activo'              => true,
        ]);

        return redirect()->back()->with('success', 'Jugador creado exitosamente.');
    }

     */


    /*

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'max:50'],
            // 'edad' => ['required', 'integer', 'min:0'],
            'generoId' => ['required'],
            //'telefono' => ['required', 'string', 'min:0'],
            //'correo' => ['required', 'email'],
        ], $this->messages);

        $jugador = JugadoresModel::findOrFail($id);
        $jugador->update([
            'nombre' => $request->nombre,
            'edad' => $request->edad,
            'generoId' => $request->genero_id,
            //'telefono' => $request->telefono,
            //'correo' => $request->correo,
            //'nivel' => $request->nivel,
        ]);

        return redirect()->back()->with('success', 'Jugador actualizado exitosamente.');
    }


    */

    /*

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $jugador = JugadoresModel::with('persona.user')->find($_id);

        if (!$jugador || !$jugador->persona || !$jugador->persona->user) {
            return redirect()->back()->withErrors('Jugador o usuario no encontrado.');
        }

        // Cambiar el estado en la tabla users
        if ($jugador->persona->user->activo == 1) {
            $jugador->persona->user->activo = 0;
            $jugador->persona->user->save();

            // También cambiar el estado del jugador
            $jugador->activo = 0;
            $jugador->save();

            return redirect()->back()->with('success', 'Jugador desactivado exitosamente.');
        }

        return redirect()->back()->withErrors('No se realizaron cambios.');
    }


    public function up(Request $request, $_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $jugador = JugadoresModel::with('persona.user')->find($_id);

        if (!$jugador || !$jugador->persona || !$jugador->persona->user) {
            return redirect()->back()->withErrors('Jugador o usuario no encontrado.');
        }

        // Cambiar el estado en la tabla users
        if ($jugador->persona->user->activo == 0) {
            $jugador->persona->user->activo = 1;
            $jugador->persona->user->save();

            // También cambiar el estado del jugador
            $jugador->activo = 1;
            $jugador->save();

            return redirect()->back()->with('success', 'Jugador activado exitosamente.');
        }

        return redirect()->back()->withErrors('No se realizaron cambios.');
    }


    */

    public function storeDestacado(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        // Validación usando los name que tienes en el form
        $validated = $request->validate([
            'jugadorId'   => ['required', Rule::exists('jugadores', 'id')],
            'mesId'       => ['required', 'integer', 'between:1,12'],   // tu select se llama mesId
            'anio'        => ['required', 'integer', 'digits:4'],       // tu input se llama anio
            'publish_at'  => ['required', 'date_format:Y-m-d\TH:i'],   // tu input se llama publish_at
            'descripcion' => ['required', 'string', 'min:10', 'max:300'],
        ], [
            'anio.digits' => 'El año debe tener 4 dígitos.',
            'publish_at.date_format' => 'Formato de fecha/hora inválido.',
        ]);


        // Evitar duplicados (mismo año+mes)
        $existe = \App\Models\JugadorDelMesModel::where('año', $validated['anio'])
            ->where('mes', $validated['mesId'])
            ->exists();
        if ($existe) {
            return back()->withErrors('Ya existe un destacado para ese mes y año.')->withInput();
        }

        // Crear registro (mapeo de nombres del form -> columnas reales)
        \App\Models\JugadorDelMesModel::create([
            'jugadorId'        => $validated['jugadorId'],
            'mes'              => $validated['mesId'],  // mesId -> mes
            'anio'             => $validated['anio'],   // gracias al alias del Model, guarda en 'año'
            'fechaPublicacion' => \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validated['publish_at']),
            'descripcion'      => $validated['descripcion'],
        ]);

        return back()->with('success', 'Jugador del Mes guardado correctamente.');
    }

}
