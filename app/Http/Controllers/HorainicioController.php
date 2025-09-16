<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HorainicioModel;


class HorainicioController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $lista = HorainicioModel::all()->where('activo',1);

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
                'titulo' => 'Hora inicio de un Usuario',
                'instruccion' => 'El inicio de un usuario definen qué puede hacer un usuario dentro del sistema.',
                'routes' => [
                    'new' => 'backoffice.horainicio.new',
                    'update' => 'backoffice.horainicio.update',
                    'up' => 'backoffice.horainicio.up',
                    'down' => 'backoffice.horainicio.down',
                    'delete' => 'backoffice.horainicio.destroy',
                ],
                'fields' => [
                    [
                        'label' => 'Nombre',
                        'name' => 'horainicio_nombre',
                        'required' => true,
                        'control' => [
    'element' => 'input',
    'type' => 'time',
    'classList' => [
        'form-control',
        'mb-4'
    ],
    'min' => '07:00',   // hora mínima permitida
    'max' => '20:00',   // hora máxima permitida
    'placeholder' => 'Ingrese una hora de inicio'
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

        return view('backoffice/horainicio/index', [
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
            'horainicio_nombre' => ['required', 'date_format:H:i'],
        ], $this->messages);
        
        $nuevo = HorainicioModel::create([
            'nombre' => $request->horainicio_nombre,
        ]);
        

        return redirect()->back()->with('success', ':) hora iniciada exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = HorainicioModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) hora eliminada exitosamente.');
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

        $buscado = HorainicioModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Hora iniciada exitosamente.');
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

        $buscado = HorainicioModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Hora eliminada exitosamente.');
    }
}
