<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aprendiz extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'grupo_id'
    ];
}
