<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    protected $fillable = ['ciudad', 'estado_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function zonas()
    {
        return $this->hasMany(Zona::class);
    }

    public function taquillas()
    {
        return $this->hasMany(Taquilla::class);
    }

}
