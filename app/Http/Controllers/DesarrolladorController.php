<?php

namespace App\Http\Controllers;

use App\Models\DesarrolladorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesarrolladorController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $desarrollador = DesarrolladorModel::all();

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
                'titulo' => 'Desarrollador de Usuario',
                'instruccion' => 'Los desarrollador de usuario definen qué puede hacer un usuario dentro del sistema.',
                'routes' => [
                    'new' => 'backoffice.desarrollador.new',
                    'update' => 'backoffice.desarrollador.update',
                    'down' => 'backoffice.desarrollador.down',
                    'delete' => 'backoffice.desarrollador.destroy',
                ],
                'fields' => [
                    [
                        'label' => 'Nombre',
                        'name' => 'nombre',
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
                    // URL de la Foto
                    [
                        'label' => 'URL de la Foto',
                        'name' => 'foto',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 3,
                            'max' => 300,
                            'placeholder' => 'Ingrese una URL de la foto'
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
                    // Medios de Contacto
                    // [
                    //     'label' => 'Medios de Contacto',
                    //     'name' => 'medios_contacto',
                    //     'required' => true,
                    //     'control' => [
                    //         'element' => 'input',
                    //         'type' => 'text',
                    //         'classList' => [
                    //             'form-control',
                    //             'mb-4'
                    //         ],
                    //         'min' => 3,
                    //         'max' => 100,
                    //         'placeholder' => '[{"nombre":"email","url":"mailto:sebastian.cabezas@docente.ipss.cl"},{"nombre":"GitHub","url":"https://www.github.com/scabezas-ipss"}]'
                    //     ],
                    //     'access' => [
                    //         'editableIn' => [
                    //             'new' => true,
                    //             'edit' => true,
                    //             'show' => false,
                    //             'up' => false,
                    //             'down' => false,
                    //             'delete' => false
                    //         ],
                    //         'readIn' => [
                    //             'new' => true,
                    //             'edit' => true,
                    //             'show' => true,
                    //             'up' => true,
                    //             'down' => true,
                    //             'delete' => true
                    //         ]
                    //     ]
                    // ],
                    // Rol
                    [
                        'label' => 'Rol',
                        'name' => 'rol',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 3,
                            'max' => 60,
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
                    // Versión de Software
                    [
                        'label' => 'Versión de Software',
                        'name' => 'version_software',
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
                    // Descripción de Funcionalidades
                    [
                        'label' => 'Descripción de Funcionalidades',
                        'name' => 'descripcion_funcionalidades',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'rows' => 3,
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 3,
                            'max' => 500,
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
                ]
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/desarrollador/index', [
            'datos' => $datos,
            'user' => $user,
            'desarrollador' => $desarrollador
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $request->validate([
            'nombre' => ['required', 'string', 'max:50', 'min:3'],
            'foto' => ['required', 'url'],
            // 'medios_contacto' => ['required', 'string', 'min:3'],
            'rol' => ['required', 'string', 'max:100', 'min:3'],
            'version_software' => ['required', 'string', 'max:50', 'min:3'],
            'descripcion_funcionalidades' => ['required', 'string', 'min:3'],
        ], $this->messages);

        DesarrolladorModel::create($request->all());

        return redirect()->back()->with('success', ':) Desarrollador creado exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $buscado = DesarrolladorModel::find($_id);

        if ($buscado) {
            $buscado->delete();
            return redirect()->back()->with('success', ':) Desarrollador eliminado exitosamente.');
        }
        return redirect()->back()->withErrors('No se encontraron cambios.');
    }

    public function destroy(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $buscado = DesarrolladorModel::find($_id);

        if ($buscado) {
            $buscado->delete();
            return redirect()->back()->with('success', ':) Desarrollador eliminado exitosamente.');
        }

        return redirect()->back()->withErrors('No se encontraron cambios.');
    }
}