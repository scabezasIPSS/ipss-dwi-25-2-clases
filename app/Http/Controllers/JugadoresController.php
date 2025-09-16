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
use Illuminate\Support\Facades\DB;
use App\Services\PersonaService;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class JugadoresController extends Controller
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

        // dd($listaNacionalidad);

        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => $this->urlLogo,
                'nombre' => 'Sonkei FC',
                'formulario' => [
                    'titulo' => 'Bienvenido a Sonkei FC ⚽️',
                    'instruccion' => 'Ingrese Credenciales'
                ],
            ],
            'mantenedor' => [
                'titulo' => 'Jugadores',
                'instruccion' => 'Listado de los jugadores.',
                'routes' => [
                    'new'    => 'backoffice.jugadores.new',
                    'update' => 'backoffice.jugadores.update',
                    'delete' => 'backoffice.jugadores.destroy',
                    'up'     => 'backoffice.jugadores.up',
                    'down'   => 'backoffice.jugadores.down',
                ],
                'fields' => [
                    [
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
                    ],
                    [
                        'label' => 'Nombre',
                        'name' => 'nombre',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control', 'mb-4'],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Nombre del jugador'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    // Apellido
                    [
                        'label' => 'Apellido',
                        'name' => 'apellido',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control', 'mb-4'],
                            'min' => 2,
                            'max' => 50,
                            'placeholder' => 'Apellido del jugador'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    // Fecha de Nacimiento
                    [
                        'label' => 'Fecha de Nacimiento',
                        'name' => 'fechaNacimiento',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'date',
                            'classList' => ['form-control', 'mb-4'],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese fecha de nacimiento'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    //Genero
                    [
                        'label' => 'Género',
                        'name' => 'generoId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $listaGeneros,
                            // 'disabled' => $listaGeneros->isEmpty(),
                            // 'placeholder' => $listaGeneros->isEmpty() ? 'Sin registros' : 'Seleccione género'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    //Oficios
                    [
                        'label' => 'Oficios',
                        'name' => 'oficiosId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $listaOficios,
                            'disabled' => $listaOficios->isEmpty(),
                            'placeholder' => $listaOficios->isEmpty() ? 'Sin registros' : 'Seleccione oficio'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    //Nacionalidad
                    [
                        'label' => 'Nacionalidad',
                        'name' => 'nacionalidadId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $listaNacionalidad,
                            'disabled' => $listaNacionalidad->isEmpty(),
                            'placeholder' => $listaNacionalidad->isEmpty() ? 'Sin registros' : 'Seleccione oficio'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    //Posicion
                    [
                        'label' => 'Posicion',
                        'name' => 'posicionesId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $listaPosiciones,
                            // 'disabled' => $listaPosiciones->isEmpty(),
                            // 'placeholder' => $listaPosiciones->isEmpty() ? 'Sin registros' : 'Seleccione posicion'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    //Dorsal
                    [
                        'label' => 'Dorsal',
                        'name' => 'camisetasId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $listaCamisetas,
                            // 'disabled' => $listaCamisetas->isEmpty(),
                            // 'placeholder' => $listaCamisetas->isEmpty() ? 'Sin registros' : 'Seleccione dorsal'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    //Pierna dominante
                    [
                        'label' => 'Pierna dominante',
                        'name' => 'pierna_dominante_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $listaPiernaDominante,
                            // 'disabled' => $listaPiernaDominante->isEmpty(),
                            // 'placeholder' => $listaPiernaDominante->isEmpty() ? 'Sin registros' : 'Seleccione pierna'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/jugadores/index', compact('datos', 'user', 'lista'));
    }

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


    // fin de desactivar y activar
}
