<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTagTranslation extends Model
{
    protected $fillable = [
        'blog_tag_id',
        'lang',
        'name',
        'slug',
    ];

    public function tag()
    {
        return $this->belongsTo(BlogTag::class, 'blog_tag_id');
    }
}
