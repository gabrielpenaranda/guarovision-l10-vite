<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $table = 'bancos';

    protected $fillable = [
        'codigo',
        'banco',
        'pago_movil',
        'transferencia',
        'pago_movil_nombre',
        'pago_movil_telefono',
        'pago_movil_rif',
        'transferencia_cuenta',
        'transferencia_nombre',
        'transferencia_rif',
    ];

    public function pago_taquilla_pos()
    {
        return $this->hasMany(PagoTaquilla::class);
    }

    public function pago_taquilla_trasferencia()
    {
        return $this->hasMany(PagoTaquilla::class);
    }

    public function pago_taquilla_pago_movil()
    {
        return $this->hasMany(PagoTaquilla::class);
    }


    public function pago_web_origenes()
    {
        return $this->hasMany(PagoWeb::class);
    }

    public function pago_web_destinos()
    {
        return $this->hasMany(PagoWeb::class);
    }

    public function movimientobancos()
    {
        return $this->hasMany(MovimientoBanco::class);
    }
}