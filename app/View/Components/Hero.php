<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;

class Hero extends Component
{
    public $data;

    public function __construct()
    {

        $this->data = "yeah";
    }

    public function render()
    {
        return view('components.hero');
    }
}
