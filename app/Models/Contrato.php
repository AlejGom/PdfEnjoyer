<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $fillable = ['nombre', 'subnombre', 'archivo', 'fecha'];
}
