<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $table='compras';

    protected $fillable = [
        'total',
        'fecha_compra',
        'user_id',
        'sucursal_id',
        'proveedor_id',
    ];

    public function detalleCompras(){
        return $this->hasMany(DetalleCompra::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
}
