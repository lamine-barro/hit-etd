<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espace extends Model
{
    public const FR_TYPES = [
        'office' => 'Bureau',
        'meeting_room' => 'Salle de réunion',
        'conference_room' => 'Salle de conférence',
        'lounge' => 'Salon',
        'reste_room' => 'Salle de détente',
        'kitchen' => 'Cuisine',
        'storage' => 'Stockage',
        'fab_lab' => 'Fab-lab',
        'workshop' => 'Atelier',
        'event_space' => 'Espace événementiel',
        'open_space' => 'Open space',
        'private_office' => 'Bureau privé',
        'coworking_space' => 'Espace de coworking',
        'technical_room' => 'Locaux technique',
        'other' => 'Autre',
    ];

    public const FR_FLOORS = [
        // 0 => 'Rez-de-chaussée',
        // 1 => 'Premier étage',
        // 2 => 'Deuxième étage',
        3 => 'Troisième étage',
        // 4 => 'Quatrième étage',
        // 5 => 'Cinquième étage',
        6 => 'Mezzanine',
        7 => 'Autre',
    ];

    public const STATUS_AVAILABLE = 'available';

    public const STATUS_UNAVAILABLE = 'unavailable';

    public const STATUS_RESERVED = 'reserved';

    protected $fillable = [
        'name',
        'code',
        'type',
        'price',
        'floor',
        'location',
        'number_of_rooms',
        'minimum_duration',
        'illustration',
        'images',
        'started_at',
        'ended_at',
        'status',
        'is_active',
        'number_of_people',
    ];

    protected $casts = [
        'images' => 'array',
        'illustration' => 'string',
        'price' => 'float',
        'minimum_duration' => 'integer',
        'floor' => 'integer',
        'ended_at' => 'datetime',
        'started_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(EspaceOrder::class);
    }
}
