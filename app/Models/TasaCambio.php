<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasaCambio extends Model
{
    use HasFactory;

    protected $table = 'tasa_cambios';

    protected $fillable = ['tasa', 'divisa_id'];

    public function divisa()
    {
        return $this->belongsTo(Divisa::class);
    }
}
