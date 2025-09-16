<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntrenamientosModel extends Model
{
    use HasFactory;

    protected $table = 'entrenamientos';

    protected $fillable = [
        'entrenador_id',
        'categoria_id',
        'recinto_id',
        'dia_id',
        'hora_inicio_id',
        'hora_fin_id',
        'estado_id',
        'activo',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaModel::class, 'categoria_id');
    }
    public function recinto()
    {
        return $this->belongsTo(RecintosModel::class, 'recinto_id');
    }
    public function diaSemana()
    {
        return $this->belongsTo(DiasSemanaModel::class, 'dia_id');
    }
    public function hora_inicio()
    {
        return $this->belongsTo(HorainicioModel::class, 'hora_inicio_id');
    }
    public function hora_fin()
    {
        return $this->belongsTo(HoraFinModel::class, 'hora_fin_id');
    }
    public function estado()
    {
        return $this->belongsTo(EstadosEntrenamientoModel::class, 'estado_id');
    }


}
