<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;
use App\Models\PageTranslation;
use App\Models\BlogPostTranslation;
use App\Models\BlogCategoryTranslation;
use App\Models\BlogTagTranslation;
use App\Models\Locale;

class UrlTranslationHelper
{
    /**
     * Retorna un arreglo con las URLs traducidas y los datos de idioma.
     */
    public static function getTranslatedUrls()
    {
        $currentLocale = app()->getLocale();
        $currentPath = trim(Request::path(), '/'); // ej. "en/blog/how-to-choose"
        $segments = explode('/', $currentPath);

        // Obtener los idiomas activos
        $locales = Locale::where('is_active', true)->get();
        $localeCodes = $locales->pluck('code')->toArray();

        // Si el primer segmento es un idioma, lo eliminamos
        if (!empty($segments) && in_array($segments[0], $localeCodes)) {
            array_shift($segments); // elimina el primer segmento (ej. "en")
        }

        $urls = [];

        // --- 1️⃣ BLOG POST (/blog/slug)
        if (count($segments) >= 2 && $segments[0] === 'blog') {
            $slug = $segments[1];
            $translation = BlogPostTranslation::where('slug', $slug)->first();

            if ($translation) {
                $translations = BlogPostTranslation::where('blog_post_id', $translation->blog_post_id)->get();

                foreach ($locales as $locale) {
                    $translated = $translations->firstWhere('lang', $locale->code);
                    $urls[] = [
                        'code' => $locale->code,
                        'name' => $locale->name,
                        'native_name' => $locale->native_name,
                        'is_default' => (bool) $locale->is_default,
                        'url' => $translated
                            ? url(($locale->is_default)?'/blog/' . $translated->slug:$locale->code . '/blog/' . $translated->slug)
                            : url($locale->code),
                    ];
                }

                return $urls;
            }
        }

        // --- 2️⃣ BLOG CATEGORÍA (/blog/categoria/slug)
        if (count($segments) >= 3 && $segments[0] === 'blog' && $segments[1] === 'categoria') {
            $slug = $segments[2];
            $translation = BlogCategoryTranslation::where('slug', $slug)->first();

            if ($translation) {
                $translations = BlogCategoryTranslation::where('blog_category_id', $translation->blog_category_id)->get();

                foreach ($locales as $locale) {
                    $translated = $translations->firstWhere('lang', $locale->code);
                    $urls[] = [
                        'code' => $locale->code,
                        'name' => $locale->name,
                        'native_name' => $locale->native_name,
                        'is_default' => (bool) $locale->is_default,
                        'url' => $translated
                            ? url(($locale->is_default)?'/blog/categoria/' . $translated->slug:$locale->code . '/blog/categoria/' . $translated->slug)
                            : url($locale->code),
                    ];
                }

                return $urls;
            }
        }

        // --- 3️⃣ BLOG TAG (/blog/etiqueta/slug)
        if (count($segments) >= 3 && $segments[0] === 'blog' && $segments[1] === 'etiqueta') {
            $slug = $segments[2];
            $translation = BlogTagTranslation::where('slug', $slug)->first();

            if ($translation) {
                $translations = BlogTagTranslation::where('blog_tag_id', $translation->blog_tag_id)->get();

                foreach ($locales as $locale) {
                    $translated = $translations->firstWhere('lang', $locale->code);
                    $urls[] = [
                        'code' => $locale->code,
                        'name' => $locale->name,
                        'native_name' => $locale->native_name,
                        'is_default' => (bool) $locale->is_default,
                        'url' => $translated
                            ? url(($locale->is_default)?'/blog/etiqueta/' . $translated->slug : $locale->code . '/blog/etiqueta/' . $translated->slug)
                            : url($locale->code),
                    ];
                }

                return $urls;
            }
        }

        // --- 4️⃣ PÁGINAS ESTÁTICAS (/quiero-vender, /nosotros, etc.)
        if (!empty($segments)) {
            $slug = $segments[0];
            $translation = PageTranslation::where('slug', $slug)->first();

            if ($translation) {
                $translations = PageTranslation::where('page_id', $translation->page_id)->get();

                foreach ($locales as $locale) {
                    $translated = $translations->firstWhere('lang', $locale->code);
                    $urls[] = [
                        'code' => $locale->code,
                        'name' => $locale->name,
                        'native_name' => $locale->native_name,
                        'is_default' => (bool) $locale->is_default,
                        'url' => $translated
                            ? url($locale->code . '/' . $translated->slug)
                            : url($locale->code),
                    ];
                }

                return $urls;
            }
        }

        // --- 5️⃣ Si no hay coincidencia, usar el home de cada idioma
        foreach ($locales as $locale) {
            $urls[] = [
                'code' => $locale->code,
                'name' => $locale->name,
                'native_name' => $locale->native_name,
                'is_default' => (bool) $locale->is_default,
                'url' => url($locale->code),
            ];
        }

        return $urls;
    }
}
