<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;

    protected $table = 'conceptos';

    protected $fillable = ['concepto', 'descripcion', 'tarifa', 'divisa_id', 'cantidad'];

    public function divisa()
    {
        return $this->belongsTo(Divisa::class);
    }

    public function impuestos()
    {
        return $this->belongsToMany(Impuesto::class, 'concepto_impuesto', 'concepto_id', 'impuesto_id');
    }
}
