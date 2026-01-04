<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContactForm extends Component
{
    public $content;

    public function __construct()
    {
        $locale = app()->getLocale();
        $section = \DB::table('sections')->where('code', 'contact_form')->first();

        $this->content = null;

        if ($section && $section->content) {
            $data = json_decode($section->content, true);
            $this->content = $data[$locale] ?? ($data['es'] ?? ($data['en'] ?? null));
        }
    }

    public function render()
    {
        return view('components.contact-form');
    }
}
