<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoWeb extends Model
{
    use HasFactory;

    protected $table = 'pago_webs';

    protected $fillable = [
        'pago_web',
        'fecha',
        'realizado_por',
        'cedula',
        'telefono_celular',
        'imagen_pago',
        'monto',
        'tasa',
        'num_referencia',
        'tipo_pago',
        'banco_origen_id',
        'banco_destino_id',
        'cliente_id',
        'conciliado',
        'confirmado',
    ];

    public function banco_origen()
    {
        return $this->belongsTo(Banco::class);
    }

    public function banco_destino()
    {
        return $this->belongsTo(Banco::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}