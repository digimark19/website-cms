<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('locale_route')) {
    /**
     * Obtiene la URL de la ruta equivalente en otro idioma
     */
    function locale_route($lang)
    {
        $routes = include base_path('app/Helpers/routes.php');

        $currentPath = '/' . Request::path(); // Ej: '/contacto' o '/contact'

        foreach ($routes as $key => $langs) {
            if (in_array($currentPath, $langs)) {
                return $langs[$lang];
            }
        }

        // Si no encuentra, retorna home por defecto
        return $lang === 'es' ? '/' : '/en';
    }
}
