<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\NewsletterController;
use App\Models\Locale;
use App\Models\Page;
use App\Models\BlogCategoryTranslation;
use App\Models\BlogTagTranslation;
use App\Models\BlogPostTranslation;
use App\Http\Controllers\BlogController;

// Cargar idiomas activos
$languages = cache()->rememberForever('locale', fn() => Locale::where('is_active', true)->get());
$default = $languages->firstWhere('is_default', true);

// Traer todas las páginas
$pages = Page::with('translations')->get();

// Traer todas las traducciones de blog
$categories = BlogCategoryTranslation::all();
$tags = BlogTagTranslation::all();
$posts = BlogPostTranslation::all();

// 🌐 Rutas dinámicas por idioma
foreach ($languages as $lang) {
    $prefix = $lang->is_default ? '' : $lang->url_prefix;

    Route::prefix($prefix)
        ->middleware('localize')
        ->group(function () use ($pages, $categories, $tags, $posts, $lang) {

            // --- Páginas ---
            foreach ($pages as $page) {
                $translation = $page->translations->firstWhere('lang', $lang->code);
                if (!$translation) continue;

                $uri = ($page->is_main) ? "/" : $translation->slug;

                Route::get($uri, function () use ($translation) {
                    return app(PageController::class)->show($translation->slug);
                })->name($translation->slug . '.' . $lang->code);
            }

            // --- Categorías del blog ---
            Route::get('blog/categoria/{slug}', function ($slug) {
                return app(\App\Http\Controllers\BlogController::class)->category($slug);
            })->name('blog.category');

            // --- Ruta genérica para todos los tags del blog ---
            Route::get('blog/etiqueta/{slug}', function ($slug) {
                return app(\App\Http\Controllers\BlogController::class)->tag($slug);
            })->name('blog.tag');

            // Ruta genérica para todos los posts del blog
            Route::get('blog/{slug}', function ($slug) {
                return app(\App\Http\Controllers\BlogController::class)->show($slug);
            })->name('blog.post'); // nombre genérico

        });
}



// Rutas de administrador
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});



Route::post('/form-contact/store', [\App\Http\Controllers\ContactController::class, 'store'])->name('form-contact.store');


Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::get('/newsletter/unsubscribe/{email}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

