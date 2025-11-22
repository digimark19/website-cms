<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_code',
        'parent_id',
        'name_route',
        'position',
        'is_active'
    ];

    public function translations()
    {
        return $this->hasMany(MenuItemTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations()->where('locale_code', $locale)->first();
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->with(['translations', 'children']);
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }
}
