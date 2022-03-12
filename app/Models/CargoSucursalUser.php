<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoSucursalUser extends Model
{
    use HasFactory;
    protected $table='';
    protected $fillable=['user_id','cargo_sucursal_id'];

    
}
