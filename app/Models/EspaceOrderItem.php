<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspaceOrderItem extends Model
{
    protected $fillable = [
        'espace_order_id',
        'espace_id',
        'quantity',
        'price',
        'total_amount',
        'started_at',
        'ended_at',
        'status',
        'notes',
        'number_of_people',
    ];

    public const STATUS_PENDING = 'pending';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_REJECTED = 'rejected';

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function espaceOrder()
    {
        return $this->belongsTo(EspaceOrder::class);
    }

    public function espace()
    {
        return $this->belongsTo(Espace::class);
    }
}
