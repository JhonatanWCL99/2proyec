<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Proveedor extends Model
{
    use HasFactory;
    protected $table='producto_proveedor';
    protected $fillable=['producto_id','proveedor_id','sucursal_id','precio' ,'fecha'];

    public function producto(){
        return $this-> belongsTo(Producto::class);
    }

    public function proveedor(){
        return $this-> belongsTo(Proveedor::class);
    }

    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

}
