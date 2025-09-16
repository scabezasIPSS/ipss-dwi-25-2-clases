<?php

namespace App\Http\Controllers;

use App\Models\EquipoJugadorModel;
use App\Models\EquiposModel;
use App\Models\JugadoresModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoJugadorController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $lista = EquipoJugadorModel::with(['equipo', 'jugador'])->get();
        $listaEquipos = EquiposModel::all()->where('activo', 1);
        $listaJugadores = JugadoresModel::all()->where('activo', 1);

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
                'titulo' => 'Jugadores del BalonPie',
                'instruccion' => 'Diversos jugadores de nuestra Liga',
                'routes' => [
                    'new' => 'backoffice.equipo-jugador.new',
                    'update' => 'backoffice.equipo-jugador.update',
                    'up' => 'backoffice.equipo-jugador.up',
                    'down' => 'backoffice.equipo-jugador.down',
                    'delete' => 'backoffice.equipo-jugador.destroy',
                ],
                'fields' => [
                    [
                        'label' => 'Equipo',
                        'name' => 'equipo_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaEquipos,
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

                    //Nombre del Jugador
                    [
                        'label' => 'Jugador(es)',
                        'name' => 'jugador_id',
                        'required' => true,
                        'control' => [
                            'element' => 'select',
                            'options' => $listaJugadores,
                            'type' => 'multiple', // **MODIFICACIÓN**
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
                ]
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        return view('backoffice/equipo-jugador/index', [
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
            'equipo_id' => ['required', 'integer'],
            'jugador_id' => ['required', 'array', 'min:1'],
            'jugador_id.*' => ['integer', 'exists:jugadores,id'],
        ], $this->messages);


        $equipoId = $request->equipo_id;

        $jugadoresIds = $request->jugador_id;

        foreach ($jugadoresIds as $jugadorId) {
            // Validación para asegurar que el jugador no esté ya en el equipo
            $existeRegistro = EquipoJugadorModel::where('equipo_id', $equipoId)
                                                ->where('jugador_id', $jugadorId)
                                                ->first();
            
            if ($existeRegistro) {
                return redirect()->back()->withErrors('El jugador ya está asignado a este equipo.');
            }

            EquipoJugadorModel::create([
                'equipo_id' => $equipoId,
                'jugador_id' => $jugadorId,
            ]);
        }
        
        /*
        $nuevo = EquipoJugadorModel::create([
            'equipo_id' => $request->equipo_id,
            'jugador_id' => $request->jugador_id,
        ]);
        */

        return redirect()->back()->with('success', ':) Jugador y Equipo ingresados exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = EquipoJugadorModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Registro apagado exitosamente.');
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

        $buscado = EquipoJugadorModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Registro reactivado exitosamente.');
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

        $buscado = EquipoJugadorModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Registro eliminado exitosamente.');
    }
}
