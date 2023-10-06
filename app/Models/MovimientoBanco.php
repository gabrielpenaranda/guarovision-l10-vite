<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoBanco extends Model
{
    use HasFactory;

    protected $table = "movimiento_bancos";

    protected $fillable = [
        'codigo',
        'fecha',
        'referencia',
        'cedula',
        'telefono',
        'monto',
        'banco_id',
    ];

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }
}