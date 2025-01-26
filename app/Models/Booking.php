<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

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
        'date' => 'date',
        'spaces' => 'array',
        'status' => 'string'
    ];
}