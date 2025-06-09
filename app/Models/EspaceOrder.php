<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspaceOrder extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'espace_id',
        'user_id',
        'reference',
        'quantity',
        'order_date',
        'status',
        'total_amount',
        'notes',
        'payment_method',
        'started_at',
        'ended_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }
}
