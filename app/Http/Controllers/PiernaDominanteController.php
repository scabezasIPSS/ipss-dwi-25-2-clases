<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PiernaDominanteModel;

class PiernaDominanteController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $lista = PiernaDominanteModel::all();

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
                'titulo' => 'Pierna Dominante',
                'instruccion' => 'Pierna del jugador.',
                'routes' => [
                    'new' => 'backoffice.piernadominante.new',
                    'update' => 'backoffice.piernadominante.update',
                    'up' => 'backoffice.piernadominante.up',
                    'down' => 'backoffice.piernadominante.down',
                    'delete' => 'backoffice.piernadominante.destroy',
                ],
                'fields' => [
                    [
                        'label' => 'Nombre',
                        'name' => 'piernadominante_nombre',
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
                ]
                ,
                [
                    'label' => 'Pierna Dominante',
                    'name' => 'pierna_dominante',
                    'required' => true,
                    'control' => [
                        'element' => 'select',
                        'classList' => [
                            'form-select',
                            'mb-4'
                        ],
                        'options' => [
                            ['value' => 'Derecha', 'text' => 'Derecha'],
                            ['value' => 'Izquierda', 'text' => 'Izquierda'],
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
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/piernaDominante/index', [
            'datos' => $datos,
            'user' => $user,
            'lista' => $lista
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
            'piernadominante_nombre' => ['required', 'string', 'max:50', 'min:3'],
        ], $this->messages);

        $nuevo = PiernaDominanteModel::create([
            'nombre' => $request->piernadominante_nombre
        ]);

        return redirect()->back()->with('success', ':) Pierna Dominante creada exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = PiernaDominanteModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Pierna Dominante apagada exitosamente.');
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

        $buscado = PiernaDominanteModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Pierna Dominante encendida exitosamente.');
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

        $buscado = PiernaDominanteModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Pierna Dominante eliminada exitosamente.');
    }
}
