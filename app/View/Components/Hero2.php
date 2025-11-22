<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Section;

class Hero2 extends Component
{
    public $content;
    public $sectionCode;

    public function __construct($sectionCode = 'hero_lotes')
    {
        $this->sectionCode = $sectionCode;
        $this->loadSectionContent();
    }

    private function loadSectionContent()
    {
        // Buscar la sección según el código recibido
        $section = Section::where('code', $this->sectionCode)->first();

        if (!$section || !$section->content) {
            $this->content = [];
            return;
        }

        // Decodificar JSON
        $decoded = json_decode($section->content, true);

        // Seleccionar idioma actual o fallback a "es"
        $lang = app()->getLocale();
        $this->content = $decoded[$lang] ?? $decoded['es'] ?? [];
    }

    public function render()
    {
        return view('components.hero2');
    }
}
