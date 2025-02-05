<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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
        'slug',
        'description',
        'start_date',
        'end_date',
        'location',
        'is_remote',
        'max_participants',
        'EventRegistration_end_date',
        'external_link',
        'is_paid',
        'price',
        'currency',
        'early_bird_price',
        'early_bird_end_date',
        'status',
        'illustration',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'EventRegistration_end_date' => 'datetime',
        'early_bird_end_date' => 'datetime',
        'is_remote' => 'boolean',
        'is_paid' => 'boolean',
        'price' => 'decimal:2',
        'early_bird_price' => 'decimal:2',
        'max_participants' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->slug = $event->generateUniqueSlug($event->title);
        });

        static::updating(function ($event) {
            if ($event->isDirty('title')) {
                $event->slug = $event->generateUniqueSlug($event->title);
            }
        });
    }

    protected function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);

        $count = static::where('slug', $slug)->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * Get the registrations for the event.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    /**
     * Get the current price based on early bird settings.
     */
    public function getCurrentPrice(): float
    {
        if (! $this->is_paid) {
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
        if (! $this->max_participants) {
            return false;
        }

        return $this->registrations()->count() >= $this->max_participants;
    }

    /**
     * Get the number of available spots.
     */
    public function getAvailableSpots(): int
    {
        if (! $this->max_participants) {
            return PHP_INT_MAX;
        }

        $taken = $this->registrations()->count();

        return max(0, $this->max_participants - $taken);
    }

    /**
     * Check if the event has reached its maximum capacity
     */
    public function hasReachedCapacity(): bool
    {
        return $this->registrations()
            ->whereNotIn('status', ['cancelled'])
            ->count() >= $this->max_participants;
    }

    /**
     * Check if EventRegistration is open for the event
     */
    public function isEventRegistrationOpen(): bool
    {
        return now()->lt($this->EventRegistration_end_date) && ! $this->hasReachedCapacity();
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
