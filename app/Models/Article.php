<?php

namespace App\Models;

use App\Enums\ArticleCategory;
use App\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasFactory, SoftDeletes, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'illustration',
        'tags',
        'featured',
        'reading_time',
        'views',
        'status',
        'published_at',
        'author_id',
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
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            if ($article->status === ArticleStatus::PUBLISHED && empty($article->published_at)) {
                $article->published_at = now();
            }
            if (empty($article->reading_time)) {
                $article->reading_time = static::calculateReadingTime($article->content);
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title') && empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            if ($article->isDirty('status') && $article->status === ArticleStatus::PUBLISHED && empty($article->published_at)) {
                $article->published_at = now();
            }
            if ($article->isDirty('content') && empty($article->reading_time)) {
                $article->reading_time = static::calculateReadingTime($article->content);
            }
        });
    }

    /**
     * Calculate estimated reading time in minutes.
     */
    protected static function calculateReadingTime($content)
    {
        $wordsPerMinute = 200;
        $numberOfWords = str_word_count(strip_tags($content));

        return max(1, ceil($numberOfWords / $wordsPerMinute));
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
     */
    public function getRouteKeyName()
    {
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
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
