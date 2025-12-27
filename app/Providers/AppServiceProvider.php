<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\SiteSetting;
use App\View\Components\ContactForm;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        /* Le decimos a Laravel que la carpeta pública está un nivel arriba, en public_html
        
            Nota Importante: Esto asume que tu carpeta pública en el servidor se llama public_html. Si tiene otro nombre (como www o el nombre de tu dominio), cambia public_html por ese nombre.
            Sube este archivo, recarga, y ¡deberías ver tu sitio con estilos!
        */
        // PRODUCCION : En producción la linea de abajo tiene que estar descomentada, si en local no te da problemas dejala descomentada.
        $this->app->usePublicPath(realpath(base_path('../public_html')));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Blade::component('contact-form', ContactForm::class);
        // ✅ Esperar hasta que el framework haya inicializado la BD
        $this->app->booted(function () {
            // Verificar que la tabla exista antes de consultar
            if (Schema::hasTable('site_settings')) {
                $settings = SiteSetting::first();
                View::share('siteSettings', $settings);
            }
        });
    }
}
