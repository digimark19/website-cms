<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Menu;
use App\Models\MenuTranslation;
use App\Models\Locale;

class Footer extends Component
{
    public function render()
    {
        $currentLocale = app()->getLocale();
        $locales = Locale::where('is_active', true)->get();
        $defaultLocale = $locales->firstWhere('is_default', true);
        $defaultCode = $defaultLocale ? $defaultLocale->code : 'es';

        // Prefijo para la URL: vacío si es el idioma por defecto
        $urlPrefix = ($currentLocale === $defaultCode) ? '' : $currentLocale . '/';
        
        // Buscar el menú con código 'footer'
        $menu = Menu::where('menu_code', 'footer')
                    ->where('is_active', true)
                    ->first();
        $menuItems = collect();
        

        if ($menu) {
            // Traer los items para el idioma actual
            $menuItems = MenuTranslation::where('menu_id', $menu->id)
                ->where('locale_code', $currentLocale)
                ->whereNull('parent_id') // Solo items de primer nivel para el footer simple
                ->orderBy('position')
                ->get();
        }

        return view('components.footer', [
            'menuItems' => $menuItems,
            'urlPrefix' => $urlPrefix
        ]);
    }
}
