<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageTranslation;

class PageController extends Controller
{
    public function show($slug = null)
    {
        $locale = app()->getLocale(); // idioma actual

        // Si no hay slug, asumimos la página principal
        $slug = $slug ?: 'home'; 

        // Buscar la traducción según slug e idioma
        $pageTranslation = PageTranslation::where('slug', $slug)
                            ->where('lang', $locale)
                            ->firstOrFail();

        // Determinar vista: custom o genérica
        $view = $pageTranslation->page->custom_view ?? 'showPage';
        $view = 'pages.'.$view;

        return view($view, [
            'page' => $pageTranslation,
        ]);
    }
}
