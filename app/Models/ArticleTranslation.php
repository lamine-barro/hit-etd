<?php

namespace App\Models;

use App\Enums\LanguageEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ArticleTranslation extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<string>
     */
    protected $fillable = [
        'article_id',
        'locale',
        'title',
        'slug',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_type',
        'reading_time',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'locale' => LanguageEnum::class,
        'reading_time' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($translation) {
            if (empty($translation->slug)) {
                $translation->slug = $translation->generateUniqueSlug($translation->title);
            }
            
            if (empty($translation->reading_time) && !empty($translation->content)) {
                $translation->reading_time = $translation->calculateReadingTime();
            }
        });

        static::updating(function ($translation) {
            if ($translation->isDirty('title') && empty($translation->slug)) {
                $translation->slug = $translation->generateUniqueSlug($translation->title);
            }
            
            if ($translation->isDirty('content')) {
                $translation->reading_time = $translation->calculateReadingTime();
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
     * Calcule le temps de lecture estimé en minutes.
     *
     * @return int
     */
    protected function calculateReadingTime()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        // Moyenne de 200 mots par minute pour la lecture
        $minutes = ceil($wordCount / 200);
        
        return max(1, $minutes);
    }

    /**
     * Obtenir l'article associé à cette traduction.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
