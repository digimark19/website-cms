<?php

namespace App\Helpers;

use App\Models\Menu;
use App\Models\MenuTranslation; // Renamed model
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class MenuHelper
{
    public static function getMenu($menuCode, $locale)
    {
        return Cache::remember("menu_{$menuCode}_{$locale}", 60 * 24, function () use ($menuCode, $locale) {
            // Find the menu by code
            $menu = Menu::where('menu_code', $menuCode)->where('is_active', true)->first();

            if (!$menu) {
                return [];
            }

            // Fetch items (translations) for this menu and locale, starting with root items (parent_id null)
            // We eager load children recursively using a custom query to filter by locale too? 
            // Since structure is in the same table, we can just fetch ALL items for this menu & locale and build tree in PHP 
            // OR use recursive relationship. 
            // Building tree in PHP is often efficient enough for menus.

            $allItems = MenuTranslation::where('menu_id', $menu->id)
                ->where('locale_code', $locale)
                ->orderBy('position')
                ->get();

            return self::buildTree($allItems);
        });
    }

    private static function buildTree($items, $parentId = null)
    {
        $branch = [];

        foreach ($items as $item) {
            if ($item->parent_id == $parentId) {
                
                $routeName = $item->slug . '.' . $item->locale_code;
                
                if ($item->slug === '#') {
                    $route = '#';
                } elseif (Route::has($routeName)) {
                    $route = route($routeName);
                } else {
                    $route = url($item->slug);
                }

                $node = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'route' => $route,
                    'children' => self::buildTree($items, $item->id)
                ];

                $branch[] = $node;
            }
        }

        return $branch;
    }
}
