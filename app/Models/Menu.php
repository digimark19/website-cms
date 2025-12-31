<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // Table is 'menus' by default convention (plural of model name), so no need to specify if standard.
    // If migration used 'menus', we are good.

    protected $fillable = [
        'menu_code',
        'is_active'
    ];

    public function items()
    {
        return $this->hasMany(MenuTranslation::class, 'menu_id');
    }
}
