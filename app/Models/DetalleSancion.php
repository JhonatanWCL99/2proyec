<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSancion extends Model
{
    use HasFactory;
    public $table = 'sanciones_user';
    public $fillable = [
        'fecha',
        'hora',
        'descripcion',
        'user_id',
        'sanciones_id',
    ];
  

}
