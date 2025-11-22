<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoryTranslation extends Model
{
    protected $fillable = [
        'blog_category_id',
        'lang',
        'name',
        'slug',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
