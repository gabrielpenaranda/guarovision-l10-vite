<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'planes';

    protected $fillable = ['plan', 'descripcion', 'tarifa', 'divisa_id'];

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function divisa()
    {
        return $this->belongsTo(Divisa::class);
    }

    public function impuestos()
    {
        return $this->belongsToMany(Impuesto::class, 'impuesto_plan',  'plan_id', 'impuesto_id');
    }
}
