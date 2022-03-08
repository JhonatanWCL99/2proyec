<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanciones extends Model
{
    use HasFactory;
    protected $table='sanciones';
    protected $fillable=['fecha','cantidad','sucursal_id'];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
}
