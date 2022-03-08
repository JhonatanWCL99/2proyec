<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table='productos';
    protected $fillable=['codigo','nombre','stock','precio','estado','categoria_id'];
    
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function productos_proveedores(){
        return $this->hasMany(Producto_Proveedor::class); //No me reconoce el Model producto_proveedor
    }
}
