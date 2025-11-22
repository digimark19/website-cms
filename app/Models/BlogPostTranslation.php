<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostTranslation extends Model
{
    protected $fillable = [
        'blog_post_id',
        'lang',
        'title',
        'slug',
        'content',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id');
    }
}
