<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sort_order'
    ];

    public function translations()
    {
        return $this->hasMany(BlogTagTranslation::class, 'blog_tag_id');
    }

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_tag', 'blog_tag_id', 'blog_post_id')->withTimestamps();
    }

    public function getNameTranslatedAttribute()
    {
        $lang = app()->getLocale();
        return $this->translations->firstWhere('lang', $lang)?->name;
    }

    public function getSlugTranslatedAttribute()
    {
        $lang = app()->getLocale();
        return $this->translations->firstWhere('lang', $lang)?->slug;
    }
}
