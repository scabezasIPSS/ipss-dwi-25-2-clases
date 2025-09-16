<?php

namespace App\Http\Controllers;

use App\Models\MediosPagosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa Auth si necesitas verificar usuarios autenticados
use Illuminate\Support\Facades\Validator; // Importa Validator si necesitas validación manual


class MediosPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        // Muestra una lista de pagos
        $lista = MediosPagosModel::all();

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
                'titulo' => 'Pagos del Usuario',
                'instruccion' => 'Los pagos de un usuario definen si puede estar o no un usuario dentro del sistema.',
                'routes' => [
                    'new' => 'backoffice.mediospagos.new',
                    'update' => 'backoffice.mediospagos.update',
                    'up' => 'backoffice.mediospagos.up',
                    'down' => 'backoffice.mediospagos.down',
                    'delete' => 'backoffice.mediospagos.destroy',
                ],
                'fields' => [
                    [
                        'label' => 'Nombre',
                        'name' => 'medio_pago_nombre',
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
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ],

        ];

        return view('backoffice.mediosPagos.index', [
            'datos' => $datos,
            'user' => $user,
            'lista' => $lista,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        // Valida los datos del formulario
        $validator = Validator::make($request->all(), [
            'medio_pago_nombre' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crea un nuevo pago
        $nuevo = MediosPagosModel::create([
            'nombre' => $request->medio_pago_nombre,
        ]);

        return redirect()->route('backoffice.mediospagos.index')->with('success', 'Medio de Pago creado exitosamente.'); // Ajusta la redirección
    }

    public function down(Request $request, $_id)
    {
        if (!Auth::check()) {
            // Verifica si el usuario NO está autenticado
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }
        $user = Auth::user();

        $buscado = MediosPagosModel::find($_id);

        if ($buscado->activo == 1) {
            $buscado->activo = 0;
            $buscado->save();
            return redirect()->back()->with('success', ':) Medio de Pago apagado exitosamente.');
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

        $buscado = MediosPagosModel::find($_id);

        if ($buscado->activo == 0) {
            $buscado->activo = 1;
            $buscado->save();
            return redirect()->back()->with('success', ':) Medio de Pago encendido exitosamente.');
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

        $buscado = MediosPagosModel::find($_id);

        $buscado->delete();

        return redirect()->back()->with('success', ':) Medios de Pago eliminado exitosamente.');
    }
}
