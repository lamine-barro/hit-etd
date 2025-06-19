<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspaceOrder extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    public const STATUSES = [
        'pending' => 'En attente',
        'processing' => 'En traitement',
        'completed' => 'Terminé',
        'cancelled' => 'Annulé',
    ];

    public const PAYMENT_METHODS = [
        'credit_card' => 'Carte de crédit',
        'paypal' => 'PayPal',
        'bank_transfer' => 'Virement bancaire',
        'mobile_money' => 'Mobile Money',
        'cash_on_delivery' => 'Cash',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(EspaceOrderItem::class);
    }
}
