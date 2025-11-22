<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Mapa extends Component
{
    public $lat;
    public $lng;
    public $zoom;

    public function __construct($lat = null, $lng = null, $zoom = null)
    {
        // Obtener siteSettings que ya compartiste globalmente
        //$siteSettings = View::shared('siteSettings');

        // Si NO se enviaron props, tomar de la BD
        $this->lat  = $lat  ?? 0;
        $this->lng  = $lng  ?? 0;
        $this->zoom = $zoom ?? 0;
    }

    public function render()
    {
        return view('components.mapa');
    }
}
