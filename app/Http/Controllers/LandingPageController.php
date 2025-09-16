<?php

namespace App\Http\Controllers;

use App\Models\DesarrolladorModel;
use App\Models\EntrenamientosModel;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        $datos = [
            'textos' => [
                'titulo' => 'Iniciar Sesión | Sonkei FC',
                'logo' => $this->urlLogo,
                'nombre' => 'Sonkei FC'
            ],
            'dev' => [
                'nombre' => 'Instituto Profesional San Sebastián',
                'url' => 'https://www.ipss.cl',
                'logo' => 'https://ipss.cl/wp-content/uploads/2025/04/cropped-LogoIPSS_sello50anos_webipss.png'
            ]
        ];

        $listaEntrenamientos = EntrenamientosModel::all()->where('activo',1);
;
        $listaDesarrolladores = DesarrolladorModel::all()->where('activo', 1);
        return view('landing/index', [
            'datos' => $datos,
            'entrenamientos' => $listaEntrenamientos,
            'desarrolladores' => $listaDesarrolladores
        ]);
    }
}
