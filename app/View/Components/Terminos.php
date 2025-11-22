<?php

namespace App\View\Components;

use App\Models\Section;
use Illuminate\View\Component;

class Terminos extends Component
{
    public $content;
    public $sectionCode;

    public function __construct($sectionCode = 'terminos')
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

        // decodificar JSON
        $decoded = json_decode($section->content, true);

        // idioma activo
        $lang = app()->getLocale();

        // seleccionar idioma o fallback ES
        $this->content = $decoded[$lang] ?? $decoded['es'] ?? [];
    }

    public function render()
    {
        return view('components.aviso-privacidad');
    }
}
