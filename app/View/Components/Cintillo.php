<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Section;

class Cintillo extends Component
{
    public $content;
    public $sectionCode;

    public function __construct($sectionCode = 'alliances')
    {
        $this->sectionCode = $sectionCode;

        $this->loadSectionContent();
    }

    private function loadSectionContent(){

        $section = Section::where('code','alliances')->first();
        
        // validar si viene vacio o null
        if (!$section || !$section->content) {
            $this->content = [];
            return;
        }

        // 2️⃣ Decodificar JSON directamente desde la columna content
        $decoded = json_decode($section->content, true);

        // 3️⃣ Seleccionar idioma actual
        $lang = app()->getLocale(); // "es", "en", etc.
        $this->content = $decoded[$lang] ?? $decoded['es'] ?? [];

    }

    public function render()
    {
        return view('components.cintillo');
    }
}
