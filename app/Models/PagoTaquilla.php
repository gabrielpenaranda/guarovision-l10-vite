<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoTaquilla extends Model
{
    use HasFactory;

    protected $table = 'pago_taquillas';

    protected $fillable = [
        'pago_taquilla',
        'fecha',
        'monto_total',
        'monto_efectivo_bs',
        'monto_efectivo_divisa',
        'monto_pos',
        'tasa',
        'divisa_id',
        'banco_pos_id',
        'taquilla_id',
        'cliente_id'
    ];

    public function divisa()
    {
        return $this->belongsTo(Divisa::class);
    }

    public function banco_pos()
    {
        return $this->belongsTo(Banco::class);
    }

    public function banco_transferencia()
    {
        return $this->belongsTo(Banco::class);
    }

    public function banco_pago_movil()
    {
        return $this->belongsTo(Banco::class);
    }

    public function taquilla()
    {
        return $this->belongsTo(Taquilla::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}