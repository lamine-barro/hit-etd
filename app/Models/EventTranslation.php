<?php

namespace App\Models;

use App\Enums\LanguageEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventTranslation extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<string>
     */
    protected $fillable = [
        'event_id',
        'locale',
        'title',
        'slug',
        'description',
        'location',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_type',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'locale' => LanguageEnum::class,
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($translation) {
            if (empty($translation->slug) && !empty($translation->title)) {
                $translation->slug = $translation->generateUniqueSlug($translation->title);
            }
        });

        static::updating(function ($translation) {
            if ($translation->isDirty('title') && empty($translation->slug)) {
                $translation->slug = $translation->generateUniqueSlug($translation->title);
            }
        });
    }

    /**
     * Génère un slug unique basé sur le titre.
     *
     * @param string $title
     * @return string
     */
    protected function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', $slug)->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * Obtenir l'événement associé à cette traduction.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
