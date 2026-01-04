<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class ContactSection extends Component
{
    public $content;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $locale = app()->getLocale();
        $section = DB::table('sections')->where('code', 'form_section')->first();

        $this->content = null;

        if ($section && $section->content) {
            $data = json_decode($section->content, true);
            $this->content = $data[$locale] ?? ($data['es'] ?? ($data['en'] ?? null));
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact-section');
    }
}
