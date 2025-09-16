<?php

namespace App\Http\Controllers;

use App\Models\DesarrolladorModel;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        $listaDesarrolladores = DesarrolladorModel::all()->where('activo', 1);
        return view('landing/index', [
            'desarrolladores' => $listaDesarrolladores
        ]);
    }
}
