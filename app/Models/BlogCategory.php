<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'meta',
        'sort_order'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function translations()
    {
        return $this->hasMany(BlogCategoryTranslation::class, 'blog_category_id');
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id');
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
