<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'codename',
        'latitude',
        'longitude',
        'plant',
        'map_id',
        'farmer_id',
    ];
}
