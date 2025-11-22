<?php

namespace App\View\Components;

use App\Models\Section;
use Illuminate\View\Component;

class Hero3 extends Component
{
    public $content;
    public $sectionCode;

    public function __construct($sectionCode = 'hero_3')
    {
        $this->sectionCode = $sectionCode;
        $this->loadSectionContent();
    }

    private function loadSectionContent()
    {
        $section = Section::where('code', $this->sectionCode)->first();

        if (!$section || !$section->content) {
            $this->content = [];
            return;
        }

        // decodificar JSON del campo content
        $decoded = json_decode($section->content, true);

        // idioma activo
        $lang = app()->getLocale();

        // seleccionar datos según idioma, fallback ES
        $this->content = $decoded[$lang] ?? $decoded['es'] ?? [];
    }

    public function render()
    {
        return view('components.hero3');
    }
}
