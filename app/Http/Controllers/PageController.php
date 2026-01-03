<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageTranslation;
use App\Models\Propiedad;
use App\Models\Localidad;
use App\Models\TipoInmueble;
use App\Models\TipoOperacion;

class PageController extends Controller
{
    public function show($slug = null)
    {
        $locale = app()->getLocale(); // idioma actual

        // Si no hay slug, asumimos la página principal
        // $slug = $slug == 'home' ?'':$slug; 

        // Buscar la traducción según slug e idioma
        $pageTranslation = PageTranslation::where('slug', $slug)
                            ->where('lang', $locale)
                            ->firstOrFail();

        // Determinar vista: custom o genérica
        $view = $pageTranslation->page->custom_view ?? 'showPage';
        $view = 'pages.'.$view;

        $data = [
            'page' => $pageTranslation,
        ];


        return view($view, $data);
    }
}
