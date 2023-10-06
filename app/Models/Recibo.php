<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;

    protected $table = 'recibos';

    protected $fillable = [
        'numero',
        'fecha',
        'fecha_vencimiento',
        'concepto',
        'monto_divisa',
        'saldo',
        'pagada',
        'exento',
        'cliente_id',
        'divisa_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class);
    }

    public function impuestos()
    {
        return $this->belongsToMany(Impuesto::class, 'impuesto_recibo', 'recibo_id', 'impuesto_id')->withPivot('monto_impuesto')->withTimestamps();
    }

    public function divisa()
    {
        return $this->belongsTo(Divisa::class);
    }
}