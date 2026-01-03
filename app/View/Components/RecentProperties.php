<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Propiedad;

class RecentProperties extends Component
{
    public $recentProperties;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->recentProperties = Propiedad::with(['galerias', 'localidad', 'tipoInmueble', 'tipoOperacion'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.recent-properties');
    }
}
