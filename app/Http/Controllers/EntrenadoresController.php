<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EntrenadoresModel;
use App\Models\GeneroModel;
use App\Models\ComunasModel;
//use App\Models\OficiosModel;
//use App\Models\MedioContactoModel;
use App\Models\CargosModel;
use App\Models\NacionalidadModel;
use Illuminate\Support\Facades\DB;
use App\Services\PersonaService;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class EntrenadoresController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $lista = EntrenadoresModel::with([
            'persona.user',
            'persona.genero',
            //'persona.oficio',
            'persona.nacionalidad',
        ])->get();

        $listaGeneros = GeneroModel::all()->where('activo', 1);
        //$listaOficios = OficiosModel::all()->where('activo', 1);
        $listaNacionalidad = NacionalidadModel::all()->where('activo', 1);


        $certificaciones = [
            ['id' => 1, 'nombre' => 'UEFA C'],
            ['id' => 2, 'nombre' => 'UEFA B'],
            ['id' => 3, 'nombre' => 'UEFA A'],
            ['id' => 4, 'nombre' => 'UEFA Pro'],
            ['id' => 5, 'nombre' => 'CONMEBOL C'],
            ['id' => 6, 'nombre' => 'CONMEBOL B'],
            ['id' => 7, 'nombre' => 'CONMEBOL A'],
            ['id' => 8, 'nombre' => 'CONMEBOL Pro'],
        ];
    
        $niveles = [
            ['id' => 'principiante', 'nombre' => 'Principiante'],
            ['id' => 'intermedio', 'nombre' => 'Intermedio'],
            ['id' => 'avanzado', 'nombre' => 'Avanzado'],
        ];
    




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
                'titulo' => 'Entrenadores',
                'instruccion' => 'Listado de los entrenadores.',
                'routes' => [
                    'new'    => 'backoffice.entrenadores.new',
                    'update' => 'backoffice.entrenadores.update',
                    'delete' => 'backoffice.entrenadores.destroy',
                    'up'     => 'backoffice.entrenadores.up',
                    'down'   => 'backoffice.entrenadores.down',
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
                            'placeholder' => 'Nombre del entrenador'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
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
                            'placeholder' => 'Apellido del entrenador'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
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
                    [
                        'label' => 'Género',
                        'name' => 'generoId',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $listaGeneros,
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],

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
                            'placeholder' => $listaNacionalidad->isEmpty() ? 'Sin registros' : 'Seleccione nacionalidad'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    [
                        'label' => 'Nivel Deportivo',
                        'name' => 'nivel',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $niveles,
                            'placeholder' => 'Seleccione el nivel'
                        ],
                        'access' => [
                            'editableIn' => ['new' => true, 'edit' => true, 'show' => false, 'up' => false, 'down' => false, 'delete' => false],
                            'readIn' => ['new' => true, 'edit' => true, 'show' => true, 'up' => true, 'down' => true, 'delete' => true]
                        ]
                    ],
                    [
                        'label' => 'Certificación',
                        'name' => 'certificacion[]',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'simple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $certificaciones, // Usa la variable $certificaciones que definiste antes
                            'placeholder' => 'Seleccione una certificación'
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

        return view('backoffice/entrenadores/index', compact('datos', 'user', 'lista', ));
    }

    public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('/')->withErrors('Debe iniciar sesión.');
    }

    $certificaciones = collect ([
        ['id' => 1, 'nombre' => 'UEFA C'],
        ['id' => 2, 'nombre' => 'UEFA B'],
        ['id' => 3, 'nombre' => 'UEFA A'],
        ['id' => 4, 'nombre' => 'UEFA Pro'],
        ['id' => 5, 'nombre' => 'CONMEBOL C'],
        ['id' => 6, 'nombre' => 'CONMEBOL B'],
        ['id' => 7, 'nombre' => 'CONMEBOL A'],
        ['id' => 8, 'nombre' => 'CONMEBOL Pro'],
    ]);

    $certificacionValues = $certificaciones->pluck('id')->toArray();

    $niveles = [
        ['id' => 'principiante', 'nombre' => 'Principiante'],
        ['id' => 'intermedio', 'nombre' => 'Intermedio'],
        ['id' => 'avanzado', 'nombre' => 'Avanzado'],
    ];
    
    $validated = $request->validate([
        'nombre'           => ['required', 'string', 'min:3', 'max:50'],
        'apellido'         => ['required', 'string', 'min:2', 'max:50'],
        'rut'              => ['required', 'string', 'unique:users,rut'],
        'generoId'         => ['required', Rule::exists('genero', 'id')],
        
        'nacionalidadId'   => ['required', Rule::exists('nacionalidad', 'id')],
        'fechaNacimiento'  => ['required', 'date'],
        'nivel'            => ['required', Rule::in(['principiante','intermedio','avanzado'])],
        'certificacion'    => ['required', 'array'],
        'certificacion.*'  => ['string', Rule::in($certificacionValues)],
    ], $this->messages);

    $idCargoEntrenador = 1;
    $fechaNacimiento = $validated['fechaNacimiento'];
    $edad = \Carbon\Carbon::parse($fechaNacimiento)->age;

    $personaService = app(\App\Services\PersonaService::class);
    $persona = $personaService->crearConUsuario([
        'nombre'           => $validated['nombre'],
        'apellido'         => $validated['apellido'],
        'rut'              => $validated['rut'],
        'edad'             => $edad,
        'nacionalidadId'   => $validated['nacionalidadId'],
        
        'cargoId'          => $idCargoEntrenador,
        'generoId'         => $validated['generoId'],
        'fechaNacimiento'  => $fechaNacimiento,
    ]);

    EntrenadoresModel::create([
        'personaId'        => $persona->id,
        'nivel'            => $validated['nivel'],
        'certificacion'    => json_encode($validated['certificacion']),
        'activo'           => true,
    ]);

    return redirect()->back()->with('success', 'Entrenador creado exitosamente.');
}

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        
    $certificaciones = collect([
        ['id' => 1, 'nombre' => 'UEFA C'],
        ['id' => 2, 'nombre' => 'UEFA B'],
        ['id' => 3, 'nombre' => 'UEFA A'],
        ['id' => 4, 'nombre' => 'UEFA Pro'],
        ['id' => 5, 'nombre' => 'CONMEBOL C'],
        ['id' => 6, 'nombre' => 'CONMEBOL B'],
        ['id' => 7, 'nombre' => 'CONMEBOL A'],
        ['id' => 8, 'nombre' => 'CONMEBOL Pro'],
    ]);

    $certificacionValues = $certificaciones->pluck('id')->toArray();

    $validated = $request->validate([
        'generoId'         => ['required', Rule::exists('genero', 'id')],
        'nivel'            => ['required', Rule::in(['principiante', 'intermedio', 'avanzado'])],
        'certificacion'    => ['required', 'array'],
        'certificacion.*'  => ['string', Rule::in($certificacionValues)],
    ], $this->messages);

    $entrenador = EntrenadoresModel::with('persona.user')->findOrFail($id);

    // Actualizar "persona" (género)
    $entrenador->persona->update([
        'generoId' => $validated['generoId'],
    ]);

    // Actualizar "entrenadores" (nivel y certificaciones)
    $entrenador->update([
        'nivel'         => $validated['nivel'],
        'certificacion' => json_encode($validated['certificacion']),
    ]);
        return redirect()->back()->with('success', 'Entrenador actualizado exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $entrenador = EntrenadoresModel::with('persona.user')->find($_id);

        if (!$entrenador || !$entrenador->persona || !$entrenador->persona->user) {
            return redirect()->back()->withErrors('Entrenador o usuario no encontrado.');
        }

        if ($entrenador->persona->user->activo == 1) {
            $entrenador->persona->user->activo = 0;
            $entrenador->persona->user->save();

            $entrenador->activo = 0;
            $entrenador->save();

            return redirect()->back()->with('success', 'Entrenador desactivado exitosamente.');
        }

        return redirect()->back()->withErrors('No se realizaron cambios.');
    }


    public function up(Request $request, $_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $entrenador = EntrenadoresModel::with('persona.user')->find($_id);

        if (!$entrenador || !$entrenador->persona || !$entrenador->persona->user) {
            return redirect()->back()->withErrors('Entrenador o usuario no encontrado.');
        }

        if ($entrenador->persona->user->activo == 0) {
            $entrenador->persona->user->activo = 1;
            $entrenador->persona->user->save();

            $entrenador->activo = 1;
            $entrenador->save();

            return redirect()->back()->with('success', 'Entrenador activado exitosamente.');
        }

        return redirect()->back()->withErrors('No se realizaron cambios.');
    }
}
