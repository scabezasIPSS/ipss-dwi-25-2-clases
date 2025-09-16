<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PremiosModel;
use Illuminate\Support\Facades\Auth;

class PremiosController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $lista = PremiosModel::all();

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
                'titulo' => 'Premios de Torneo',
                'instruccion' => 'Premios entregados al final de cada campeonato.',
                'routes' => [
                    'new' => 'backoffice.premios.new',
                    'update' => 'backoffice.premios.update',
                    'up' => 'backoffice.premios.up',
                    'down' => 'backoffice.premios.down',
                    'delete' => 'backoffice.premios.destroy',
                ],
                'fields' => [
                    [
                        'label' => 'Nombre',
                        'name' => 'premios_nombre',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 3,
                            'max' => 100,
                            'placeholder' => 'Ingrese un premio'
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

        return view('backoffice/premios/index', [
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
            'premios_nombre' => ['required', 'string', 'max:100', 'min:3'],
        ], $this->messages);

        $nuevo = PremiosModel::create([
            'nombre' => $request->premios_nombre,
        ]);

        return redirect()->back()->with('success', ':) Premio creado exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = PremiosModel::find($_id);

        $buscado->activo = 0;

        $buscado->save();

        return redirect()->back()->with('success', ':) Premio apagado exitosamente.');
    }
    public function up(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = PremiosModel::find($_id);

        $buscado->activo = 1;

        $buscado->save();

        return redirect()->back()->with('success', ':) Premio encendido exitosamente.');
    }
    public function destroy(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = PremiosModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Premio eliminado exitosamente.');
    }
}
