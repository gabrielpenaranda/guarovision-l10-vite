<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisa extends Model
{
    use HasFactory;

    protected $table = 'divisas';

    protected $fillable = ['divisa', 'descripcion', 'simbolo'];

    public function planes()
    {
        return $this->hasMany(Plan::class);
    }

    public function conceptos()
    {
        return $this->hasMany(Concepto::class);
    }

    public function pago_taquillas()
    {
        return $this->hasMany(PagoTaquila::class);
    }

    public function pago_exentos()
    {
        return $this->hasMany(PagoTaquila::class);
    }

    public function recibos()
    {
        return $this->hasMany(Recibo::class);
    }
}