<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Section extends Component
{
    public $content;
    public $name;

    public function __construct($name, $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function render()
    {
        return view('components.section');
    }
}
