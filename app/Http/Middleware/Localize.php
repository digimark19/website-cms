<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Locale;

class Localize
{
    public function handle($request, Closure $next)
    {
        // Lista de idiomas soportados que estan activos en la DB
        $supported = Locale::where('is_active', true)->pluck('code')->toArray(); 

        // Tomar el primer segmento de la URL
        $segment = $request->segment(1);

        // Si el segmento es un idioma soportado, usarlo; si no, idioma por defecto
        if (in_array($segment, $supported)) {
            $locale = $segment;
        } else {
            $locale = 'es'; // idioma por defecto
        }

        // Asignar el idioma a la aplicación
        App::setLocale($locale);

        return $next($request);
    }
}
