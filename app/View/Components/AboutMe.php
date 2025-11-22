<?php

namespace App\View\Components;

use App\Models\Section;
use Illuminate\View\Component;

class AboutMe extends Component
{
    public $content;
    public $sectionCode;
    public $image;
    public $title;

    public function __construct($sectionCode = 'about-me')
    {
        $this->sectionCode = $sectionCode;
        $this->loadSectionContent();
    }

    private function loadSectionContent()
    {
        $section = Section::where('code', $this->sectionCode)->first();

        if (!$section || !$section->content) {
            $this->content = [];
            $this->title = "Acerca de mí";
            $this->image = null;
            return;
        }

        $decoded = json_decode($section->content, true);

        // idioma detectado
        $lang = app()->getLocale();

        // obtener datos del idioma actual o español como fallback
        $data = $decoded[$lang] ?? $decoded['es'] ?? [];

        // Asignar datos del JSON
        $this->title = $data['title'] ?? "Acerca de mí";
        $this->image = $data['image'] ?? null;
        $this->content = $data['content'] ?? null;
    }

    public function render()
    {
        return view('components.about-me');
    }
}
