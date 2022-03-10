<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoSucursal extends Model
{
    use HasFactory;
    protected $table = 'cargos_sucursal';
    protected $fillable =['nombre_cargo','descripcion'];
    
}
