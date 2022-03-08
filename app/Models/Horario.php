<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table= 'horarios';

    protected $fillable =['fecha','horario_ingreso','hora_entrada','horario_salida','turno','encargado_id'];

    public function encargado(){
        return $this->belongsTo(Encargado::class);
    }

    
}
