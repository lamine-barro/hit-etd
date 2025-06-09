<?php

namespace App\Models;

use App\Enums\ArticleCategory;
use App\Enums\ArticleStatus;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = [
        'category',
        'illustration',
        'tags',
        'featured',
        'views',
        'status',
        'published_at',
        'author_id',
        'default_locale',
    ];

    protected $casts = [
        'tags' => 'array',
        'featured' => 'boolean',
        'reading_time' => 'integer',
        'views' => 'integer',
        'published_at' => 'datetime',
        'status' => ArticleStatus::class,
        'category' => ArticleCategory::class,
    ];

    /**
     * Les attributs qui doivent être accessibles pour les traductions.
     *
     * @var array<string>
     */
    protected $translatable = [
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
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if ($article->status === ArticleStatus::PUBLISHED && empty($article->published_at)) {
                $article->published_at = now();
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('status') && $article->status === ArticleStatus::PUBLISHED && empty($article->published_at)) {
                $article->published_at = now();
            }
        });
    }

    /**
     * Récupère le titre de l'article dans la langue actuelle ou par défaut
     */
    public function getTitle(): string
    {
        return $this->getTranslatedAttribute('title');
    }

    /**
     * Récupère le slug de l'article dans la langue actuelle ou par défaut
     */
    public function getSlug(): string
    {
        return $this->getTranslatedAttribute('slug');
    }

    /**
     * Récupère l'extrait de l'article dans la langue actuelle ou par défaut
     */
    public function getExcerpt(): ?string
    {
        return $this->getTranslatedAttribute('excerpt');
    }

    /**
     * Récupère le contenu de l'article dans la langue actuelle ou par défaut
     */
    public function getContent(): ?string
    {
        return $this->getTranslatedAttribute('content');
    }

    /**
     * Scope a query to only include published articles.
     */
    public function scopePublished($query)
    {
        return $query->where('status', ArticleStatus::PUBLISHED->value)
            ->where('published_at', '<=', now())
            ->latest('published_at');
    }

    /**
     * Scope a query to only include featured articles.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Get the route key for the model.
     *
     * Retourne 'id' pour l'administration Filament et 'slug' pour le frontend public
     */
    public function getRouteKeyName()
    {
        // Vérifier si la requête concerne l'administration Filament
        if (request()->is('admin/*')) {
            return 'id';
        }

        return 'slug';
    }

    public function getTagsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }

        return $value ?? [];
    }

    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = is_array($value) ? json_encode($value) : $value;
    }

    /**
     * Increment the view count for this article.
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Get the administrator that authored the article.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Administrator::class, 'author_id');
    }

    /**
     * Obtenir le nom du modèle de traduction.
     */
    protected function getTranslationModelName(): string
    {
        return ArticleTranslation::class;
    }
}
