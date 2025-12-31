<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    protected $table = 'menu_item_translations'; // Keeping the table name as per migration

    protected $fillable = [
        'menu_id',
        'parent_id',
        'position',
        'locale_code',
        'title',
        'slug'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(MenuTranslation::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuTranslation::class, 'parent_id')->orderBy('position');
    }
}
