<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'lastname',
        'rut',
        'password',
        'cargoId',
        'generoId',
        'fechaNacimiento',
        'nacionalidadId',
        'piernaDominanteId',
        'oficioId',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'fechaNacimiento' => 'date',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relaciones

    public function genero()
    {
        return $this->belongsTo(GeneroModel::class, 'generoId');
    }

    public function cargo()
    {
        return $this->belongsTo(CargosModel::class, 'cargoId');
    }

    public function oficio()
    {
        return $this->belongsTo(OficiosModel::class, 'oficioId');
    }

    public function nacionalidad()
    {
        return $this->belongsTo(NacionalidadModel::class, 'nacionalidadId');
    }

    public function piernaDominante()
    {
        return $this->belongsTo(PiernaDominanteModel::class, 'piernaDominanteId');
    }

    public function comuna()
    {
        return $this->belongsTo(ComunasModel::class, 'comunaId');
    }

    // Relación muchos a muchos con medios de contacto
    public function mediosDeContacto()
    {
        return $this->belongsToMany(MedioContactoModel::class, 'usuario_contacto', 'user_id', 'medio_contacto_id')
            ->withPivot('valor', 'visible')
            ->withTimestamps();
    }

    public function mediosDeContactoVisibles()
    {
        return $this->belongsToMany(MedioContactoModel::class, 'usuario_contacto', 'user_id', 'medio_contacto_id')
            ->withPivot('valor', 'visible')
            ->wherePivot('visible', true) // 👈 Solo los visibles
            ->withTimestamps();
    }

    // Métodos JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}