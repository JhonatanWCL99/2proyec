<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bono extends Model
{
    use HasFactory;
    protected $table = 'bonos';
    protected $fillable =['monto','motivo','fecha','usuario_id'];

    public function usuarios (){
        return $this->belongsTo(User::class);
    }
}
