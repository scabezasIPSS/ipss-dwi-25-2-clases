<?php

namespace App\Http\Controllers;

use App\Models\CampeonatoModel;
use App\Models\CampeonatosEquiposModel;
use App\Models\ComunasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampeonatoController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $lista = CampeonatoModel::all();

        // $comunas = ComunasModel::all()->pluck('nombre')->toArray();
        $listaComunas = ComunasModel::all()->where('activo', 1);

        $listaEquipos = [
            [
                "id" => 1,
                "nombre" => "Atlético del Sur"
            ],
            [
                "id" => 2,
                "nombre" => "Real Metropolitano"
            ],
            // 'Atlético del Sur',
            // 'Real Metropolitano',
            // 'Unión Capitalina',
            // 'Sporting Cóndores',
            // 'Deportivo Los Andes',
            // 'Independiente del Valle',
            // 'Cumbres FC',
            // 'Rivera United',
            // 'Costanera City',
            // 'Montaña FC',
            // 'Valle Hermoso',
            // 'Estrella del Pacífico',
            // 'Sol Naciente',
            // 'Furia Roja',
            // 'Leones Urbanos',
            // 'Tigres de Acero',
            // 'Halcones del Maipo',
            // 'Gladiadores de Santiago',
            // 'Pumas de la Reina',
            // 'Dragones de Hierro',
            // 'Lobos del Bosque',
            // 'Águilas de Metal',
            // 'Cazadores del Parque',
            // 'Gigantes del Poniente',
            // 'Centauros del Norte',
            // 'Fénix de Plata',
            // 'Titanes del Mapocho',
            // 'Guerreros del Cerro',
            // 'Jaguares de Fuego',
            // 'Cobras de Acero'
        ];

        $datos = [
            'textos' => [
                'titulo' => 'Campeonatos | Sonkei FC',
                'logo' => $this->urlLogo,
                'nombre' => 'Sonkei FC',

            ],
            'mantenedor' => [
                'titulo' => 'Campeonatos',
                'instruccion' => 'Gestiona todos los futuros campeonatos aqui.',
                'routes' => [
                    'new' => 'backoffice.campeonato.create',
                    'up' => 'backoffice.campeonato.up',
                    'down' => 'backoffice.campeonato.down',
                    'delete' => 'backoffice.campeonato.destroy',
                    'index' => 'backoffice.campeonato.index',
                ],
                'fields' => [
                    [
                        'label' => 'Nombre del Campeonato',
                        'name' => 'nombre',
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control'],
                            'min' => 3,
                            'max' => 50,
                            'placeholder' => 'Introduce el nombre',
                        ],
                        'required' => true,
                    ],
                    [
                        'label' => 'Descripción del campeonato',
                        'name' => 'descripcion',
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control'],
                            'min' => 10,
                            'max' => 250,
                            'placeholder' => 'Introduce la descripcion del campeonato',
                        ],
                        'required' => true,
                    ],
                    [
                        'label' => 'Fecha de Inicio',
                        'name' => 'fecha_inicio',
                        'control' => [
                            'element' => 'input',
                            'type' => 'date',
                            'classList' => ['form-control'],
                            'min' => null,
                            'max' => null,
                            'placeholder' => 'Selecciona la fecha de inicio',
                        ],
                        'required' => true,
                    ],
                    [
                        'label' => 'Fecha de Fin',
                        'name' => 'fecha_fin',
                        'control' => [
                            'element' => 'input',
                            'type' => 'date',
                            'classList' => ['form-control'],
                            'min' => null,
                            'max' => null,
                            'placeholder' => 'Selecciona la fecha de fin',
                        ],
                        'required' => true,
                    ],
                    [
                        'label' => 'Ubicación',
                        'name' => 'ubicacion',
                        'control' => [
                            'element' => 'input',
                            'type' => 'text',
                            'classList' => ['form-control'],
                            'min' => 3,
                            'max' => 20,
                            'placeholder' => 'Introduce la ubicación',
                        ],
                        'required' => true,
                    ],
                    [
                        'label' => 'Comuna',
                        'name' => 'comuna',
                        'control' => [
                            'element' => 'select',
                            'options' => $listaComunas,
                            'type' => 'simple',
                            'classList' => [
                                'form-select',
                                'mb-4',
                            ],
                        ],
                        'required' => true,
                    ],
                    [
                        'label' => 'Equipos',
                        'name' => 'equipos',
                        'control' => [
                            'element' => 'select',
                            'type' => 'multiple',
                            'classList' => ['form-select', 'mb-4'],
                            'options' => $listaEquipos,
                        ],
                        'required' => true,
                    ]
                ],
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://wwwipsss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],
        ];

        

        return view('backoffice/campeonato/index', [
            'datos' => $datos,
            'user' => $user,
            'campeonatos' => $lista,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        $request->validate([
            'nombre' => ['required', 'string', 'max:50', 'min:3'],
            'descripcion' => ['required', 'string', 'max:250', 'min:10'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
            'ubicacion' => ['required', 'string', 'max:50', 'min:3'],
            'comuna' => ['required'],
            // 'equipos' => ['required', 'array'],
        ]);

        $campeonato = CampeonatoModel::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ubicacion' => $request->ubicacion,
            'comunaId' => $request->comuna,
            'activo' => true,
        ]);

        foreach ($request->equipos as $equipoId) {
            $camponatoEquipos = CampeonatosEquiposModel::create([
                'campeonatoId' => $campeonato['id'],
                'equipoId' => $equipoId,
                'activo' => true
            ]);
        }

        return redirect()->back()->with('success', ':) Campeonato creado exitosamente.');
    }

    public function show(CampeonatoModel $campeonatoModel)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        return view('backoffice.campeonato.show', compact('campeonatoModel'));
    }

    public function destroy(Request $request, $_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = CampeonatoModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Campeonato eliminado exitosamente.');
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = CampeonatoModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Campeonato apagado exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }

    public function up(Request $request, $_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = CampeonatoModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Campeonato encendido exitosamente.');
        }
        return redirect()->back()->withErrors('No se realizaron Cambios.');
    }
}
