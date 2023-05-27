<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'codeName',
        'type',
        'mode',
        'strength',
        'battery',
        'location_id',
        'user_id',
    ];
}
