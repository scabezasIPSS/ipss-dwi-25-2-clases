<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EquiposModel extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'nombre',
        'apodo',
        'fundacion',
        'trofeos',
        'presidente',
        'colores',
        'activo',
        'recintoID'
    ];

    public function jugadores(): BelongsToMany
    {
        return $this->belongsToMany(JugadoresModel::class, 'equipo_jugador');
    }

    public function recinto()
    {
        return $this->belongsTo(RecintosModel::class, 'recintoID');
    }
}
