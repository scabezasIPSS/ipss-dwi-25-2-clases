<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JugadorDelMesModel extends Model
{
    use HasFactory;

    
    protected $table = 'jugadorDelMes';

    protected $fillable = [
        'jugadorId',
        'mes',
        'año',        
        'anio',           
        'fechaPublicacion',
        'descripcion',       
    ];

    protected $casts = [
        'fechaPublicacion' => 'datetime', 
    ];

    public function jugador()
    {
        return $this->belongsTo(JugadoresModel::class, 'jugadorId');
    }

    /**
     * Alias útil para evitar usar "ñ" en el código:
     * $modelo->anio (lee/escribe la columna 'año')
     */
    public function setAnioAttribute($value)   { $this->attributes['año'] = $value; }
    public function getAnioAttribute()         { return $this->attributes['año'] ?? null; }

    // Nombre del mes para mostrar en vistas
    public function getMesNombreAttribute()
    {
        $meses = [1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'];
        return $meses[(int) $this->mes] ?? null;
    }
}