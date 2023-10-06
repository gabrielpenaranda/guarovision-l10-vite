<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloEquipo extends Model
{
    use HasFactory;

    protected $table = 'modelo_equipos';

    protected $fillable = ['modelo_equipo', 'tipo_equipo_id', 'marca_equipo_id' ];

    public function equipos() {
        return $this->hasMany(Equipo::class);
    }

    public function tipo_equipo()
    {
        return $this->belongsTo(TipoEquipo::class);
    }

    public function marca_equipo()
    {
        return $this->belongsTo(MarcaEquipo::class);
    }
}
