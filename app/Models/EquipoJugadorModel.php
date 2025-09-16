<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipoJugadorModel extends Model
{
    use HasFactory;

    protected $table = 'equipo_jugador';

    protected $fillable = [
        'equipo_id',
        'jugador_id',
        'activo',
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(EquiposModel::class, 'equipo_id');
    }

    public function jugador(): BelongsTo
    {
        return $this->belongsTo(JugadoresModel::class, 'jugador_id');
    }
}
