<?php

namespace App\Http\Controllers;

use App\Models\RecintosModel;
use App\Models\EquiposModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquiposController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        //$lista = EquiposModel::with(['recinto', 'recinto.comuna'])->get();

        $lista = EquiposModel::with('recinto')->get();
        //dd($lista);
        $listaRecintos = RecintosModel::all()->where('activo', 1);;

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
                'titulo' => 'Equipos de Fútbol',
                'instruccion' => 'Clubes pertenecientes a nuestra Liga',
                'routes' => [
                    'new' => 'backoffice.equipos.new',
                    'update' => 'backoffice.equipos.update',
                    'up' => 'backoffice.equipos.up',
                    'down' => 'backoffice.equipos.down',
                    'delete' => 'backoffice.equipos.destroy',
                ],
                'fields' => [

                    //Nombre del Equipo
                    [
                        'label' => 'Nombre del Equipo',
                        'name' => 'equipos_nombre',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese un nombre'
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

                    //Apodo del Equipo
                    [
                        'label' => 'Apodo del Equipo',
                        'name' => 'equipos_apodo',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese Apodo'
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

                     // Recinto (Estadio) - Ahora un campo de selección
                     [
                        'label' => 'Recinto (Estadio)',
                        'name' => 'recinto_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'type' => 'select',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'options' => $listaRecintos, // Se pasan los datos de los recintos aquí
                            'placeholder' => 'Seleccione un Recinto'
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

                    //Año de Fundación del Equipo
                    [
                        'label' => 'Fecha de Fundación del Equipo',
                        'name' => 'equipos_fundacion',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'date',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => null,
                            'max' => null,
                            'placeholder' => 'Ingrese Fecha de Fundación'
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

                    //Cantidad de Trofeos ganados
                    [
                        'label' => 'Cantidad de Trofeos Ganados',
                        'name' => 'equipos_trofeos',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'number',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 0,
                            'max' => 100,
                            'placeholder' => 'Ingrese Cantidad de Trofeos'
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

                    //Presidente
                    [
                        'label' => 'Nombre del Presidente del Equipo',
                        'name' => 'equipos_presidente',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese Nombre del Presidente'
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

                    //Colores
                    [
                        'label' => 'Colores del Equipo',
                        'name' => 'equipos_colores',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4',
                            ],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Ingrese Colores del Equipo'
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
                'has_recinto' => true,
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/equipos/index', [
            'datos' => $datos,
            'user' => $user,
            'lista' => $lista,
            'listaRecintos' => $listaRecintos,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $request->validate([
            'equipos_nombre' => ['required', 'string', 'max:50', 'min:3'],
            'equipos_apodo' => ['required', 'string', 'max:50', 'min:3'],
            'recinto_id' => ['required', 'integer'],
            'equipos_fundacion' => ['required', 'date'],
            'equipos_trofeos' => ['required', 'integer', 'max:1000', 'min:0'],
            'equipos_presidente' => ['required', 'string', 'max:50', 'min:3'],
            'equipos_colores' => ['required', 'string', 'max:50', 'min:3'],

            
        ], $this->messages);

        $nuevo = EquiposModel::create([
            'nombre' => $request->equipos_nombre,
            'apodo' => $request->equipos_apodo,
            'recintoID' => $request->recinto_id,
            'fundacion' => $request->equipos_fundacion,
            'trofeos' => $request->equipos_trofeos,
            'presidente' => $request->equipos_presidente,
            'colores' => $request->equipos_colores,



        ]);

        return redirect()->back()->with('success', ':) Equipo creado exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = EquiposModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Equipo apagado exitosamente.');
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

        $buscado = EquiposModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Equipo encendido exitosamente.');
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

        $buscado = EquiposModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Equipo eliminado exitosamente.');
    }
}
