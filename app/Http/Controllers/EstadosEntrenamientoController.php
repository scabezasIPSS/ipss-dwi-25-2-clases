<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EstadosEntrenamientoModel; 


class EstadosEntrenamientoController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('/')->withErrors('Debe iniciar sesión.');
        }

        $user = Auth::user();

        // Datos para la vista
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
                'titulo' => 'Estado de entrenamiento',
                'instruccion' => 'Gestiona los estados de entrenamiento',
            ]
        ];

        // Traer todos los estados desde la base de datos
        $estadosExtras = EstadosEntrenamientoModel::orderBy('id')->get()->toArray();

        return view('backoffice.estadosentrenamiento.index', [
            'datos' => $datos,
            'user' => $user,
            'estadosExtras' => $estadosExtras
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required','string','min:3','max:50'],
            'color' => ['required','string'],
        ]);

        EstadosEntrenamientoModel::create([
            'nombre' => $request->nombre,
            'color'  => $request->color,
            'activo' => true
        ]);

        return redirect()->back()->with('success', 'Estado creado correctamente.');
    }

    public function up($id)
    {
        $estado = EstadosEntrenamientoModel::findOrFail($id);
        $estado->activo = true;
        $estado->save();

        return redirect()->back()->with('success', 'Estado activado.');
    }

    public function down($id)
    {
        $estado = EstadosEntrenamientoModel::findOrFail($id);
        $estado->activo = false;
        $estado->save();

        return redirect()->back()->with('success', 'Estado desactivado.');
    }
}
