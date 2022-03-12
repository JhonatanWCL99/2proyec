<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
         
            'email',
            'foto',
            'name',
            'apellido',
            'fecha_nacimiento',
            'ci'=>'11387268',
            'celular_personal',
            'celular_referencia',
            'domicilio',
            'zona',
            'codigo',
            'password',
            'estado',
            'sucursal_id',
            'tipo_usuario_id', 
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
      
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function username()
    {
        return 'email';
    }

    public function tipo_usuarios(){
        return $this->belongsTo(TipoUsuario::class);
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    /*public function horarios(){
        return $this->hasMany(Horario::class);
    }*/

    public function sanciones(){
        return $this->hasMany(Sanciones::class);
    }

    public function turnos(){
        return $this->hasMany(Turno::class);
    }

    public function detalleContratos(){
        return $this->hasMany(DetalleContrato::class);
    }
    public function bonos(){
        return $this->hasMany(Bono::class);
    }

    public function descuentos(){
        return $this->hasMany(Descuento::class);
    }

    public function cargosucursals(){
        return $this->belongsToMany(CargoSucursal::class);
    }
}
