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
        'kitchen' => 'Cuisine',
        'storage' => 'Stockage',
    ];

    public const FR_FLOORS = [
        0 => 'Rez-de-chaussée',
        1 => 'Premier étage',
        2 => 'Deuxième étage',
        3 => 'Troisième étage',
        4 => 'Quatrième étage',
        5 => 'Cinquième étage',
    ];

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
    ];

    protected $casts = [
        'images' => 'array',
        'illustration' => 'string',
        'price' => 'float',
        'minimum_duration' => 'integer',
        'floor' => 'integer',
    ];

    public function orders()
    {
        return $this->hasMany(EspaceOrder::class);
    }
}
