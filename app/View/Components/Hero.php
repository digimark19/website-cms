<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Vite;

use App\Models\Page;
use App\Models\Section;

class Hero extends Component
{
    public $image;
    public $title;
    public $bgStyle;

    public function __construct($image = null, $title = null)
    {
        // 1. Valores por defecto o pasados por parámetro
        $this->image = $image;
        $this->title = $title;

        // 2. Si faltan datos, intentar buscar en BD
        if (empty($this->image) || empty($this->title)) {
            $this->loadFromDb();
        }

        // 3. Resolver estilo de fondo (Lógica movida desde la vista)
        $this->bgStyle = $this->resolveBackgroundStyle();
    }

    private function resolveBackgroundStyle()
    {
        // Default
        $style = "background-color: #101828;"; 

        if (!empty($this->image)) {
            if (str_starts_with($this->image, 'resources/')) {
                // Es un asset de Vite
                try {
                    $url = Vite::asset($this->image);
                    $style = "background-image: url('$url');";
                } catch (\Exception $e) {
                    $style = "background-color: #101828;"; 
                }
            } else {
                // Es una URL normal o path público (/storage/...)
                // Aseguramos que sea una URL absoluta si es relativa
                $url = asset($this->image);
                $style = "background-image: url('$url');";
            }
        }

        return $style;
    }

    private function loadFromDb()
    {
        $locale = app()->getLocale();
        $path = request()->path(); // 'es', 'es/propiedades', '/'

        // Determinar si estamos en la home (is_main = 1)
        // Casos: '/', 'es', 'en'
        $isHome = $path === '/' || $path === $locale;
        
        $slug = null;
        if (!$isHome) {
            // Obtener el último segmento como slug
            // Ej: 'es/propiedades' -> 'propiedades'
            $slug = basename($path);
        }

        // Buscar la página
        $page = Page::whereHas('translations', function($q) use ($isHome, $slug, $locale) {
            $q->where('lang', $locale);
            
            if ($isHome) {
                // Si es home, buscamos por is_main
                $q->where('is_main', true);
            } else {
                // Si no, buscamos por el slug
                $q->where('slug', $slug);
            }
        })->with(['sections' => function($q) {
            $q->where('code', 'hero');
        }])->first();

        if ($page && $page->sections->isNotEmpty()) {
            $section = $page->sections->first();
            $contentJson = $section->pivot->content;

            if ($contentJson) {
                $content = json_decode($contentJson, true);
                
                // Fallback a 'es' si no existe el locale actual
                $data = $content[$locale] ?? $content['es'] ?? [];

                // Asignar solo si no venían por parámetro
                if (empty($this->title)) {
                    $this->title = $data['title'] ?? null;
                }

                if (empty($this->image)) {
                    $this->image = $data['image'] ?? null;
                }
            }
        }
    }

    public function render()
    {
        return view('components.hero');
    }
}
