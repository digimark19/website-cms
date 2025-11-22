<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;

class Lomaspopular extends Component
{
    public $data;

    public function __construct()
    {
        /*$section = Section::where('page', 'home')
                          ->where('name', 'servicios')
                          ->first();

        $this->data = $section ? $section->content : null;*/
    }

    public function render()
    {
        return view('components.lomaspopular');
    }
}
