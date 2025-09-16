<?php

namespace App\Http\Controllers;

use App\Models\EntrenamientosModel;
use App\Models\CategoriaModel;
use App\Models\RecintosModel;
use App\Models\DiasSemanaModel;
use App\Models\HorainicioModel;
use App\Models\HoraFinModel;
use App\Models\EstadosEntrenamientoModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrenamientosController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $lista = EntrenamientosModel::all();
        $listaEntrenadores = [
            [
                "id" => 1,
                "nombre" => "entrenador 1"
            ],
            [
                "id" => 2,
                "nombre" => "entrenador 2"
            ],
        ];
        // $listaJugadores = JugadoresModel::all()->where('activo', 1);
        $listaCategorias = CategoriaModel::all()->where('activo', 1);
        $listaRecintos = RecintosModel::all()->where('activo', 1);
        $listaDias = DiasSemanaModel::all()->where('activo', 1);
        $listaHorasInicio = HorainicioModel::all()->where('activo', 1);
        $listaHorasFin = HoraFinModel::all()->where('activo', 1);
        $listaEstados = EstadosEntrenamientoModel::all()->where('activo', 1);

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
                'titulo' => 'Entrenamientos de un Usuario',
                'instruccion' => 'Los Entrenamiento de un usuario definen a un profesional.',
                'routes' => [
                    'new' => 'backoffice.entrenamiento.new',
                    'update' => 'backoffice.entrenamiento.update',
                    'up' => 'backoffice.entrenamiento.up',
                    'down' => 'backoffice.entrenamiento.down',
                    'delete' => 'backoffice.entrenamiento.destroy',
                ],
                'fields' => [
                    //Entrenador
                    [
                        'label' => 'Entrenadores (Pueden ser 1 o más)',
                        'name' => 'entrenador_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaEntrenadores,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ],
                    ],
                    //Categoria
                    [
                        'label' => 'Categoría',
                        'name' => 'categoria_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaCategorias,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //Recinto
                    [
                        'label' => 'Recinto Entrenamiento',
                        'name' => 'recinto_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaRecintos,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //Dia Entrenamiento
                    [
                        'label' => 'Día de la Semana',
                        'name' => 'dia_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaDias,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //Hora Inicio
                    [
                        'label' => 'Hora de Inicio',
                        'name' => 'hora_inicio_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaHorasInicio,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese una Hora de Inicio de Entrenamiento'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //Hora Fin
                    [
                        'label' => 'Hora de Fin',
                        'name' => 'hora_fin_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaHorasFin,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese una Hora de Fin de Entrenamiento'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //Estado Entrenamiento
                    [
                        'label' => 'Estado del Entrenamiento',
                        'name' => 'estado_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaEstados,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese una Estado de Entrenamiento'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                    //Semanas Consecutivas
                    [
                        'label' => 'Cantidad de Semanas Consecutivas',
                        'name' => 'semanas',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'number',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 1,
                            'max' => 50,
                            'placeholder' => 'Ingrese la cantidad de semanas consecutivas que se realizará el entrenamiento.'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'delete' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'delete' => true
                            ]
                        ]
                    ],
                ],
                'has_jugador' => false,
                'has_entrenador' => true,
                'has_hora_inicio' => true,
                'has_hora_fin' => true,
                'has_ubicacion' => false,
                'has_categoria' => true,
                'has_recinto' => true,
                'has_dia' => true,
                'has_semanas' => false,
                'has_estado' => true,
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/entrenamientos/index', [
            'datos' => $datos,
            'user' => $user,
            'lista' => $lista
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $request->validate([
            'entrenador_id',
            'categoria_id',
            'recinto_id',
            'dia_id',
            'hora_inicio_id',
            'hora_fin_id',
            'estado_id',
            'semanas',
        ], $this->messages);

        $cantidadSemanas = (int) $request->semanas;

        for ($i = 1; $i <= $cantidadSemanas; $i++) {

            $fecha = Carbon::parse($request->fecha_inicio);
            $fecha->addDays(7 * $i);

            $nuevo = EntrenamientosModel::create([
                'entrenador_id' => $request->entrenador_id,
                'categoria_id' => $request->categoria_id,
                'recinto_id' => $request->recinto_id,
                'dia_id' => $request->dia_id,
                'hora_inicio_id' => $request->hora_inicio_id,
                'hora_fin_id' => $request->hora_fin_id,
                'fecha' => $fecha,
                'estado_id' => $request->estado_id,
                'activo' => 1,
            ]);
        }

        return redirect()->back()->with('success', ':) Entrenamiento creado exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = EntrenamientosModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Entrenamiento apagado exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }
    public function up(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = EntrenamientosModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Entrenamiento encendido exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }
    public function destroy(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = EntrenamientosModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Entrenamiento eliminado exitosamente.');
    }
}
