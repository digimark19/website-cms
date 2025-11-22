<?php

namespace App\View\Components;

use App\Models\Section;
use Illuminate\View\Component;

class ProcesoVenta extends Component
{
    public $content;
    public $sectionCode;

    public function __construct($sectionCode = 'proceso_venta')
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

        $decoded = json_decode($section->content, true);

        // idioma
        $lang = app()->getLocale();

        // datos del idioma actual, fallback a ES
        $this->content = $decoded[$lang] ?? $decoded['es'] ?? [];
    }

    public function render()
    {
        return view('components.procesoVenta');
    }
}
