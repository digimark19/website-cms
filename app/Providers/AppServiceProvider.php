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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
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
