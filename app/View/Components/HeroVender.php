<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroVender extends Component
{
    public $title;
    public $subtitle;
    public $buttonText;
    public $image;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $locale = app()->getLocale();
        $section = \DB::table('sections')->where('code', 'hero_vender')->first();

        // Default values
        $this->title = 'Vende tu propiedad con nosotros';
        $this->subtitle = 'Confianza y rapidez en cada paso';
        $this->buttonText = 'Quiero Vender';
        $this->image = asset('images/hero-vender.jpg');

        if ($section && $section->content) {
            $content = json_decode($section->content, true);
            
            // Global Image Override
            if (isset($content['image']) && !empty($content['image'])) {
                $this->image = $content['image'];
            }
            
            // Check if content has the locale, otherwise fallback to 'es' or 'en'
            $data = $content[$locale] ?? ($content['es'] ?? ($content['en'] ?? []));

            $this->title = $data['title'] ?? $this->title;
            $this->subtitle = $data['subtitle'] ?? $this->subtitle;
            $this->buttonText = $data['buttonText'] ?? $this->buttonText;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero-vender-content');
    }
}
