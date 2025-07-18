<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espace extends Model
{
    public const FR_TYPES = [
        'open_space' => 'Open space',
        'private_office' => 'Bureau privé',
        'dedicated_office' => 'Bureau dédié',
        'meeting_room' => 'Salle de réunion',
        'conference_room' => 'Salle de conférence',
        'event_space' => 'Espace événementiel',
        'lounge' => 'Salle de détente',
        'fab_lab' => 'Fab-lab / Atelier',
        'other' => 'Autre',
    ];

    public const FR_FLOORS = [
        '13th_floor' => '13ème étage',
        'mezzanine' => 'Mezzanine',
        'other' => 'Autre',
    ];

    public const STATUS_AVAILABLE = 'available';

    public const STATUS_UNAVAILABLE = 'unavailable';

    public const STATUS_RESERVED = 'reserved';

    protected $fillable = [
        'name',
        'code',
        'type',
        'price_per_hour',
        'minimum_duration',
        'floor',
        'location',
        'room_count',
        'number_of_people',
        'illustration',
        'images',
        'started_at',
        'ended_at',
        'status',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'price_per_hour' => 'float',
        'minimum_duration' => 'integer',
        'room_count' => 'integer',
        'number_of_people' => 'integer',
        'floor' => 'string',
        'ended_at' => 'datetime',
        'started_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(EspaceOrder::class);
    }
}
