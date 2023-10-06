<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEquipo extends Model
{
    use HasFactory;

    protected $table = 'tipo_equipos';

    protected $fillable = ['tipo_equipo'];

    public function modelo_equipos()
    {
        return $this->hasMany(Modelo::class);
    }
}
