<?php

namespace App\Models\Siat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoSignificativo extends Model
{
    use HasFactory;
    protected $table = 'siat_eventos_significativos';

    protected $fillable = ['codigo_clasificador','descripcion'];
}
