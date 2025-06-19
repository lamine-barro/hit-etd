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
