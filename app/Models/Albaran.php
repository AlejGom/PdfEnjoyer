<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Albaran extends Model
{
    protected $table = "albaranes";

    protected $fillable = [
        "nombre",
        "subnombre",
        "archivo",
        "fecha"
    ];

    public $timestamps = false;
}
