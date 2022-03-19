<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    use HasFactory;
    protected $table='vacacion';
    protected $fillable=['fecha_inicio','fecha_fin','user_id1'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
