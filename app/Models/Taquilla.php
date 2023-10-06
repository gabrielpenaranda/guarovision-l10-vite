<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taquilla extends Model
{
    use HasFactory;

    protected $table = 'taquillas';

    protected $fillable = [
        'taquilla',
        'tipo_taquilla',
        'direccion',
        'ciudad_id'
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function pago_taquillas()
    {
        return $this->hasMany(PagoTaquilla::class);
    }
}
