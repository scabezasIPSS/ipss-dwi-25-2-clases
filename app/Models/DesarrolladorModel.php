<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesarrolladorModel extends Model
{
    use HasFactory;

    protected $table = 'desarrollador';

    protected $fillable = [
        'nombre',
        'foto',
        // 'medios_contacto',
        'rol',
        'version_software',
        'descripcion_funcionalidades',
    ];

    // protected $casts = [
    //     'medios_contacto' => 'array',
    // ];
}
