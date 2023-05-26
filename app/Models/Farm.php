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
        'image',
        'map_id',
        'user_id',
    ];
}
