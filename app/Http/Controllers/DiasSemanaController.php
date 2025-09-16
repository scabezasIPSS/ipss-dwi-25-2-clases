<?php

namespace App\Http\Controllers;

use App\Models\DiasSemanaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiasSemanaController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        // Orden Lunes -> Domingo (portable)
        $lista = DiasSemanaModel::orderByRaw("
        CASE nombre
            WHEN 'Lunes' THEN 1
            WHEN 'Martes' THEN 2
            WHEN 'Miércoles' THEN 3
            WHEN 'Jueves' THEN 4
            WHEN 'Viernes' THEN 5
            WHEN 'Sábado' THEN 6
            WHEN 'Domingo' THEN 7
            ELSE 8
        END
    ")->get();

        // Base de días
        $diasDisponibles = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        // Filtrar: quitar los ya creados (activos o no)
        $yaCreados = $lista->pluck('nombre')->all();
        $opciones = array_values(array_diff($diasDisponibles, $yaCreados)); // ← SOLO lo que falta

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
                'titulo' => 'Días de la Semana',
                'instruccion' => 'Gestión de días (Lunes a Domingo).',
                'routes' => [
                    'new'    => 'backoffice.diassemana.new',
                    'update' => 'backoffice.diassemana.update',
                    'up'     => 'backoffice.diassemana.up',
                    'down'   => 'backoffice.diassemana.down',
                    'delete' => null, // no mostrar Eliminar
                ],
                // Campos que usa el modal reutilizable
                'fields' => [
                    [
                        'label' => 'Nombre',
                        'name' => 'dia_semana_nombre',
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
                            'placeholder' => 'Ingrese un Día de la Semana'
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
            ],
        ];

        return view('backoffice.diassemana.index', [
            'datos' => $datos,
            'user'  => $user,
            'lista' => $lista,
        ]);
    }



    public function store(Request $request)
    {
        $request->validate(
            [
                'dia_semana_nombre' => 'required||unique:dias_semana,nombre',
            ],
            $this->messages // <--- Aquí usamos los mensajes centralizados
        );

        DiasSemanaModel::create([
            'nombre' => $request->dia_semana_nombre,
            'activo' => true
        ]);

        return redirect()->route('backoffice.diassemana.index')
            ->with('success', 'Día de la Semana creado correctamente.');
    }

    public function down($_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $dia = DiasSemanaModel::find($_id);
        if ($dia && $dia->activo) {
            $dia->activo = false;
            $dia->save();
            return redirect()->back()->with('success', ':) Día de la Semana desactivado.');
        }

        return redirect()->back()->withErrors('No se realizaron cambios.');
    }

    public function up($_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $dia = DiasSemanaModel::find($_id);
        if ($dia && !$dia->activo) {
            $dia->activo = true;
            $dia->save();
            return redirect()->back()->with('success', ':) Día de la Semana activado.');
        }

        return redirect()->back()->withErrors('No se realizaron cambios.');
    }

    public function destroy($_id)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $dia = DiasSemanaModel::find($_id);
        if ($dia) {
            $dia->delete();
            return redirect()->back()->with('success', ':) Día de la Semana eliminado exitosamente.');
        }

        return redirect()->back()->withErrors('No se pudo eliminar el día.');
    }
}
