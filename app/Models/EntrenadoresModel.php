<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntrenadoresModel extends Model
{
    
    protected $table = 'entrenadores';

        /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */

     protected $fillable = [
        'personaId',
        'nivel',         
        'certificacion',  
        'activo',
    ];

        /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'certificacion' => 'array',
    ];

    public function persona()
    {
        return $this->belongsTo(PersonaModel::class, 'personaId');
    }

    
    public function getDisplayNameAttribute()
    {
        $nombre   = $this->persona?->user?->name ?? '';
        $apellido = $this->persona?->user?->lastname ?? '';
        $full     = trim("$nombre $apellido");
        return $full !== '' ? $full : "Entrenador #{$this->id}";
    }

    
}