<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'type',
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'is_remote',
        'max_participants',
        'registration_end_date',
        'external_link',
        'is_paid',
        'price',
        'currency',
        'early_bird_price',
        'early_bird_end_date',
        'status',
        'illustration'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_end_date' => 'datetime',
        'early_bird_end_date' => 'datetime',
        'is_remote' => 'boolean',
        'is_paid' => 'boolean',
        'price' => 'decimal:2',
        'early_bird_price' => 'decimal:2',
        'max_participants' => 'integer'
    ];

    /**
     * Get the registrations for the event.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get the current price based on early bird settings.
     */
    public function getCurrentPrice(): float
    {
        if (!$this->is_paid) {
            return 0;
        }

        if ($this->early_bird_price && 
            $this->early_bird_end_date && 
            now()->lt($this->early_bird_end_date)) {
            return $this->early_bird_price;
        }

        return $this->price;
    }

    /**
     * Check if the event is full.
     */
    public function isFull(): bool
    {
        if (!$this->max_participants) {
            return false;
        }

        return $this->registrations()->count() >= $this->max_participants;
    }

    /**
     * Get the number of available spots.
     */
    public function getAvailableSpots(): int
    {
        if (!$this->max_participants) {
            return PHP_INT_MAX;
        }

        $taken = $this->registrations()->count();
        return max(0, $this->max_participants - $taken);
    }

    /**
     * Check if registration is still open.
     */
    public function isRegistrationOpen(): bool
    {
        if ($this->status !== 'published') {
            return false;
        }

        if ($this->isFull()) {
            return false;
        }

        if ($this->registration_end_date && now()->gt($this->registration_end_date)) {
            return false;
        }

        if (now()->gt($this->start_date)) {
            return false;
        }

        return true;
    }

    /**
     * Scope a query to only include upcoming events.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now())
                    ->where('status', 'published')
                    ->orderBy('start_date');
    }

    /**
     * Scope a query to only include past events.
     */
    public function scopePast($query)
    {
        return $query->where('start_date', '<', now())
                    ->orderByDesc('start_date');
    }
}
