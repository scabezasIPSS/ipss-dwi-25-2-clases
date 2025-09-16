<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoPartidoModel extends Model
{
    use HasFactory;

    protected $table = 'tipopartido';

    protected $fillable = [
        'nombre',
        'activo',
    ];
}
