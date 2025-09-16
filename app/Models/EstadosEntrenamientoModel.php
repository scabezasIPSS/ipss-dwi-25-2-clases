<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosEntrenamientoModel extends Model
{
    use HasFactory;

    protected $table = 'estadosEntrenamiento';

    // Los campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'color',
        'activo',
    ];
}
