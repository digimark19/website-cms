<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

class Section extends Model
{
    protected $fillable = ['name', 'default_content','content'];

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_section')
                    ->withPivot('position', 'content')
                    ->orderBy('pivot_position');
    }
}
