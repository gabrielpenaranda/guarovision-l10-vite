<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    use HasFactory;

    protected $table = 'impuestos';

    protected $fillable = ['impuesto', 'tasa', 'es_activo'];

    public function recibos()
    {
        $this->belongsToMany(Recibo::class, 'impuesto_recibo', 'impuesto_id', 'recibo_id');
    }

    public function planes()
    {
        return $this->belongsToMany(Plan::class, 'impuesto_plan', 'impuesto_id', 'plan_id');
    }

    public function conceptos()
    {
        return $this->belongsToMany(Plan::class, 'concepto_impuesto', 'impuesto_id', 'concepto_id')->withPivot('monto_impuesto')->withTimestamps();
    }
}
