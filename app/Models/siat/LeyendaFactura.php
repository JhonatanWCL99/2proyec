<?php

namespace App\Models\Siat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeyendaFactura extends Model
{
    use HasFactory;
    protected $table ='siat_leyendas_facturas';
    protected $fillable = ['fecha','codigo_actividad','descripcion_leyenda'];
}