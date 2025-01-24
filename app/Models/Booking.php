<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'date',
        'time',
        'purpose',
        'spaces',
        'message',
        'status'
    ];

    protected $casts = [
        'spaces' => 'array',
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
} 