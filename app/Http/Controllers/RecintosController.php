<?php

namespace App\Http\Controllers;


use App\Models\RecintosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecintosController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $lista = RecintosModel::all();

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
                'titulo' => 'Recintos disponibles',
                'instruccion' => 'Explora los diferentes lugares para jugar fútbol.',
                'routes' => [
                    'new' => 'backoffice.recintos.new',
                    'update' => 'backoffice.recintos.update',
                    'up' => 'backoffice.recintos.up',
                    'down' => 'backoffice.recintos.down',
                    'destroy' => 'backoffice.recintos.destroy',
                ],
                'fields' => [ // Este es el array principal para los campos
                    [ // Definición del campo Nombre
                        'label' => 'Nombre',
                        'name' => 'recinto_nombre',
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
                            'placeholder' => 'Ingrese nombre del recinto'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'destroy' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'destroy' => true
                            ]
                        ]
                    ],
                    [ // Definición del campo Ubicación
                        'label' => 'Ubicación',
                        'name' => 'ubicacion',
                        'required' => false, // O true si la ubicación es obligatoria
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => [
                                'form-control',
                                'mb-4'
                            ],
                            'min' => 5,
                            'max' => 255,
                            'placeholder' => 'Ingrese la ubicacion del recinto'
                        ],
                        'access' => [
                            'editableIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => false,
                                'up' => false,
                                'down' => false,
                                'destroy' => false
                            ],
                            'readIn' => [
                                'new' => true,
                                'edit' => true,
                                'show' => true,
                                'up' => true,
                                'down' => true,
                                'destroy' => true
                            ]
                        ]
                    ],
                ] ,
                'has_ubicacion' => true, // <-- ¡Agrega esta línea!
            ],
            // ... otros elementos de $datos
        


            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/recintos/index', [
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
            'recinto_nombre' => ['required', 'string', 'max:50', 'min:3', 'unique:recintos,nombre'],
            'ubicacion' => ['nullable', 'string', 'max:255', 'min:5', 'unique:recintos,ubicacion'], // Añade reglas de validación para ubicacion
        ], $this->messages);

        $nuevo = RecintosModel::create([
            'nombre' => $request->recinto_nombre,
            'ubicacion' => $request->ubicacion, // ¡Añade esta línea!
        ]);

        return redirect()->back()->with('success', ':) Recinto creado exitosamente.');
    }



    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = RecintosModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Recinto apagado exitosamente.');
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

        $buscado = RecintosModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Recinto encendido exitosamente.');
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

        $buscado = RecintosModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Recinto eliminado exitosamente.');
    }
}

