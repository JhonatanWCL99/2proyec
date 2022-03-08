<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoSucursal extends Model
{
    use HasFactory;
    protected $table = 'cargos_sucursal';
    protected $fillable =['cargo_id','sucursal_id'];

    public function cargo(){
        return $this->belongsTo(Cargo::class);
    }

    
    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
}
