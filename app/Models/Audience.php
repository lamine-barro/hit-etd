<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audience extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'newsletter_email',
        'newsletter_whatsapp',
        'interests',
    ];

    protected $casts = [
        'newsletter_email' => 'boolean',
        'newsletter_whatsapp' => 'boolean',
        'interests' => 'array',
    ];
}
