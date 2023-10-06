<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoExento extends Model
{
    use HasFactory;

    protected $table = 'pago_exentos';

    protected $fillable = [
        'pago_exento',
        'monto',
        'monto_divisa',
        'divisa_id',
        'reversado',
    ];


    public function divisa()
    {
        return $this->belongsTo(Divisa::class);
    }
}