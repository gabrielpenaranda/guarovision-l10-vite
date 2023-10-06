<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesConsumido extends Model
{
    use HasFactory;

    protected $table = 'mes_consumidos';

    protected $fillable = ['month', 'year'];
}
