<?php

namespace App\Models;

use App\Enums\LanguageEnum;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'type',
        'start_date',
        'end_date',
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
        'illustration',
        'created_by',
        'default_locale'
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
        'max_participants' => 'integer',
        'default_locale' => LanguageEnum::class,
    ];
    
    /**
     * Les attributs qui doivent être accessibles pour les traductions.
     *
     * @var array<string>
     */
    protected $translatable = [
        'title',
        'slug',
        'description',
        'location',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_type',
    ];

    // Les méthodes boot() et generateUniqueSlug() ont été supprimées car le slug est maintenant géré par les traductions

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
            return (int) $this->early_bird_price;
        }

        return (int) $this->price;
    }

    public function getFee()
    {
        return 200;
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
    public function isRegistrationOpen(): bool
    {
        return now()->lt($this->registration_end_date) && ! $this->hasReachedCapacity();
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

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Administrator::class, 'created_by');
    }
    
    /**
     * Obtenir toutes les traductions de l'événement.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(EventTranslation::class);
    }
    
    /**
     * Obtenir le nom de la classe de traduction associée.
     */
    protected function getTranslationModelName(): string
    {
        return EventTranslation::class;
    }
}
