<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Models\PageTranslation;
use App\Models\BlogPostTranslation;
use App\Models\BlogCategoryTranslation;

if (!function_exists('getLocalizedUrl')) {
    /**
     * Devuelve la URL equivalente en otro idioma, según la página actual.
     */
    function getLocalizedUrl(string $targetLocale): string
    {
        $currentRoute = Route::current();
        $currentLocale = App::getLocale();

        // Evitar si es el mismo idioma
        if ($currentLocale === $targetLocale) {
            return url()->current();
        }

        $params = $currentRoute->parameters();

        // 🔹 Detectar si estamos en una página normal
        if (isset($params['slug'])) {
            $slug = $params['slug'];

            // Intentamos encontrar en pages
            $page = PageTranslation::where('slug', $slug)
                ->where('lang', $currentLocale)
                ->first();

            if ($page) {
                $translated = PageTranslation::where('page_id', $page->page_id)
                    ->where('lang', $targetLocale)
                    ->first();

                if ($translated) {
                    $prefix = $targetLocale === config('app.fallback_locale') ? '' : '/' . $targetLocale;
                    return url($prefix . '/' . $translated->slug);
                }
            }

            // Intentamos encontrar en posts
            $post = BlogPostTranslation::where('slug', $slug)
                ->where('lang', $currentLocale)
                ->first();

            if ($post) {
                $translated = BlogPostTranslation::where('blog_post_id', $post->blog_post_id)
                    ->where('lang', $targetLocale)
                    ->first();

                if ($translated) {
                    $prefix = $targetLocale === config('app.fallback_locale') ? '' : '/' . $targetLocale;
                    return url($prefix . '/blog/' . $translated->slug);
                }
            }
        }

        // Si no encontramos coincidencia, regresamos al home en el idioma destino
        $prefix = $targetLocale === config('app.fallback_locale') ? '' : '/' . $targetLocale;
        return url($prefix);
    }
}
