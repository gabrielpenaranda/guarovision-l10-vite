<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteGeneralSaldo extends Model
{
    use HasFactory;

    protected $table = 'reporte_general_saldos';

    protected $fillable = ['cliente', 'fecha', 'numero', 'concepto', 'monto_divisa', 'saldo'];

    public $timestamps = false;
}
