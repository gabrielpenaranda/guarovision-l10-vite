<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'codigo',
        'nombres',
        'apellidos',
        'direccion',
        'cedula',
        'email',
        'telefono_fijo',
        'telefono_celular',
        'foto',
        'imagen_cedula',
        'otro',
        'fecha_instalacion',
        'cortado',
        'activo',
        'olt',
        'tarjeta',
        'puerto',
        'zona_id',
        'plan_id',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }


    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function recibos()
    {
        return $this->hasMany(Recibo::class);
    }

    public function pago_webs()
    {
        return $this->hasMany(PagoWeb::class);
    }

    public function pago_taquillas()
    {
        return $this->hasMany(PagoTaquilla::class);
    }
}