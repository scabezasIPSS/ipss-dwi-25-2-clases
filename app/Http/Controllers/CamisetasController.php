<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CamisetasModel;

class CamisetasController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $lista = CamisetasModel::all();

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
                'titulo' => 'Camisetas de Jugadores',
                'instruccion' => 'Las camisetas se registran aqui:',
                'routes' => [
                    'new' => 'backoffice.camisetas.new',
                    'update' => 'backoffice.camisetas.update',
                    'up' => 'backoffice.camisetas.up',
                    'down' => 'backoffice.camisetas.down',
                    'delete' => 'backoffice.camisetas.destroy',
                ],
                'fields' => [
                    [
                        'label' => 'Numero de Camiseta',
                        'name' => 'nombre',
                        'required' => true,
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 1,
                            'max' => 3,
                            'placeholder' => 'Ingrese el número de la camiseta'
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

        return view('backoffice/camisetas/index', [
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
    
    // Validación personalizada para asegurar que el número de camiseta no se repita
    $request->validate([
        'nombre' => [
            'required',
            'integer',
            'min:1',
            'max:99',
            function ($attribute, $value, $fail) {
                // Verificar si el número de camiseta ya existe en la base de datos
                if (CamisetasModel::where('numeroCamiseta', $value)->exists()) {
                    $fail('El número de camiseta ya está registrado.');
                }
            },
        ],
    ], $this->messages);

    // Crear el nuevo registro
    $nuevo = CamisetasModel::create([
        'nombre' => $request->nombre,  // Cambiar a 'numeroCamiseta'
    ]);

    return redirect()->back()->with('success', 'Camiseta agregada exitosamente.');
}

    

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = CamisetasModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Camiseta desactivada exitosamente.');
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

        $buscado = CamisetasModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', 'Camiseta activada exitosamente.');
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

        $buscado = CamisetasModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', 'Camiseta eliminada exitosamente.');
    }
}
