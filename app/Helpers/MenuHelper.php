<?php

namespace App\Helpers;

use App\Models\MenuItem;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class MenuHelper
{
    public static function getMenu($menuCode, $locale)
    {
        // Cacheamos el menú por 24 horas (o el tiempo que consideres adecuado)
        return Cache::remember("menu_{$menuCode}_{$locale}", 60 * 24, function () use ($menuCode, $locale) {
            // Obtenemos los elementos del menú activo y ordenados, con sus traducciones filtradas
            $items = MenuItem::with(['translations' => function ($query) use ($locale) {
                    $query->where('locale_code', $locale);
                }])
                ->where('menu_code', $menuCode)
                ->where('is_active', true)
                ->orderBy('position')
                ->get();

            // Armamos la jerarquía (padres e hijos)
            $menu = [];

            foreach ($items as $item) {
                // Usamos la relación eager loaded
                $translation = $item->translations->first();
                if (!$translation) continue;

                $routeName = $translation->slug . '.' . $translation->locale_code;
                
                if ($translation->slug === '#') {
                    $route = '#';
                } elseif (\Illuminate\Support\Facades\Route::has($routeName)) {
                    $route = route($routeName);
                } else {
                    // Si no es una ruta nombrada, asumimos que es una URL o path directo.
                    // Podríamos usar url($translation->slug) si queremos que sea relativo a la raíz
                    $route = url($translation->slug);
                }

                $menuData = [
                    'id' => $item->id,
                    'title' => $translation->title,
                    'route' => $route,
                    'children' => []
                ];

                if ($item->parent_id) {
                    // Si el padre ya existe (porque se procesó antes o se creó por referencia), agregamos el hijo
                    // Nota: Esto asume que los padres se procesan antes o que el array se maneja por referencia.
                    // En la implementación original, si el padre no existía, se creaba implícitamente.
                    // Si el padre llega DESPUÉS, sobrescribiría esto. Se asume orden correcto por 'position'.
                    $menu[$item->parent_id]['children'][] = $menuData;
                } else {
                    // Si ya existía (por haber recibido hijos antes), preservamos los hijos
                    if (isset($menu[$item->id]['children'])) {
                        $menuData['children'] = $menu[$item->id]['children'];
                    }
                    $menu[$item->id] = $menuData;
                }
            }

            return array_values($menu);
        });
    }
}
