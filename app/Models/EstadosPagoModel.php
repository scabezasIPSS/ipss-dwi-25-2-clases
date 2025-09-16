<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosPagoModel extends Model
{
    use HasFactory;

    protected $table = 'estadospago';

    // Los campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'color',
        'activo',
    ];
}
