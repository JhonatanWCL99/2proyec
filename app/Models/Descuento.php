<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;
    protected $table= 'descuentos';
    protected $fillable =['monto','motivo','fecha','usuario_id'];

    public function usuario(){
        return $this->belongsTo(User::class);
    }
}
