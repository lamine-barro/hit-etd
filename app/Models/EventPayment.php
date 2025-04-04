<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventPayment extends Model
{
    protected $fillable = [
        'event_id',
        'event_registration_id',
        'reference',
        'amount',
        'currency',
        'status',
        'paid_at',
        'paystack_reference',
        'paystack_transaction_id',
        'paystack_response',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paystack_response' => 'array',
        'paid_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(EventRegistration::class, 'event_registration_id');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isSuccessful(): bool
    {
        return $this->status === 'success';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function markAsSuccessful(string $paystackTransactionId, array $paystackResponse): void
    {
        $this->update([
            'status' => 'success',
            'paystack_transaction_id' => $paystackTransactionId,
            'paystack_response' => $paystackResponse,
            'paid_at' => now(),
        ]);
    }

    public function markAsFailed(array $paystackResponse): void
    {
        $this->update([
            'status' => 'failed',
            'paystack_response' => $paystackResponse,
        ]);
    }
}
