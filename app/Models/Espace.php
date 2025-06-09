<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espace extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'capacity',
        'available_from',
        'available_to',
    ];
}
