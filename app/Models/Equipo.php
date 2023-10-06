<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = ['codigo', 'serial', 'pon', 'usuario', 'password', 'modelo_equipo_id', 'asignado'];

    public function modelo_equipo()
    {
        return $this->belongsTo(ModeloEquipo::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }
}
