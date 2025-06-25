<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'organization',
        'specialties',
        'specialty_other',
        'training_types',
        'training_details',
        'target_audience',
        'intervention_frequency',
        'intervention_other',
        'preferred_days',
        'preferred_times',
        'remarks',
        'cv_path',
    ];

    protected $casts = [
        'specialties' => 'array',
        'training_types' => 'array',
        'target_audience' => 'array',
        'intervention_frequency' => 'array',
        'preferred_days' => 'array',
        'preferred_times' => 'array',
    ];
}
