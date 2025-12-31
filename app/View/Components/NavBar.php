<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Helpers\MenuHelper;
use App\Helpers\UrlTranslationHelper;
use App\Models\Locale;

class Navbar extends Component
{
    public $menuItems;
    public $menuItemsFooter;
    public $languages;
    public $currentLocale;
    public $translatedUrls;

    public function __construct()
    {
        // Cargar el menú dinámico del helper
        $this->menuItems = MenuHelper::getMenu('main', app()->getLocale());
        $this->menuItemsFooter = MenuHelper::getMenu('footer', app()->getLocale());
        $menu1 = $this->menuItemsFooter;
        $menu2 = $this->menuItems;

        // Idiomas disponibles (usa tu tabla locales)
        $this->languages = Locale::where('is_active', true)->get();

        // 👇 Nuevo: obtiene las URLs traducidas según la página actual
        $this->translatedUrls = UrlTranslationHelper::getTranslatedUrls();

        // Idioma actual
        $this->currentLocale = app()->getLocale();
    }
    

    public function render()
    {
        return view('components.navbar');
    }
}
