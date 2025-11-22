<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'author_id',
        'author_name',
        'status',
        'published_at',
        'social_links',
        'views',
        'is_featured',
        'featured_image'
    ];

    protected $casts = [
        'social_links' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    // RELACIONES
    public function translation()
    {
        return $this->hasMany(BlogPostTranslation::class, 'blog_post_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag', 'blog_post_id', 'blog_tag_id')->withTimestamps();
    }

    // ACCESORES para traducciones (por idioma actual)
    public function getTitleTranslatedAttribute()
    {
        $lang = app()->getLocale();
        return $this->translation->firstWhere('lang', $lang)?->title;
    }

    public function getContentTranslatedAttribute()
    {
        $lang = app()->getLocale();
        return $this->translation->firstWhere('lang', $lang)?->content;
    }

    public function getSlugTranslatedAttribute()
    {
        $lang = app()->getLocale();
        return $this->translation->firstWhere('lang', $lang)?->slug;
    }
}
