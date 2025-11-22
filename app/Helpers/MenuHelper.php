<?php

namespace App\Helpers;

use App\Models\MenuItem;
use App\Models\MenuItemTranslation;


class MenuHelper
{
    public static function getMenu($menuCode, $locale)
    {
        // Obtenemos los elementos del menú activo y ordenados
        $items = MenuItem::where('menu_code', $menuCode)
            ->where('is_active', true)
            ->orderBy('position')
            ->get();

        // Obtenemos las traducciones para el idioma actual
        $translations = MenuItemTranslation::where('locale_code', $locale)->get()->keyBy('menu_item_id');

        // Armamos la jerarquía (padres e hijos)
        $menu = [];

        foreach ($items as $item) {
            $translation = $translations->get($item->id);
            if (!$translation) continue;

            $menuData = [
                'id' => $item->id,
                'title' => $translation->title,
                'route' => route($translation?->slug.'.'.$translation?->locale_code),
                'children' => []
            ];

            if ($item->parent_id) {
                $menu[$item->parent_id]['children'][] = $menuData;
            } else {
                $menu[$item->id] = $menuData;
            }
        }

        return array_values($menu);
    }
}
