<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['is_active', 'is_home'];

    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations()->where('lang', $locale)->first();
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'page_section')
                    ->withPivot('position', 'content')
                    ->orderBy('pivot_position');
    }
}

