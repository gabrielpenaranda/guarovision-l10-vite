<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaEquipo extends Model
{
    use HasFactory;

    protected $table = 'marca_equipos';

    protected $fillable = ['marca_equipo'];

    public function modelo_equipos()
    {
        return $this->hasMany(ModeloEquipo::class);
    }
}
