<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'pago',
        'monto_total',
        'concepto',
        'origen',
        'numero_pago',
        'recibo_id',
    ];


    public function recibo()
    {
        return $this->belongsTo(Recibo::class);
    }
}
