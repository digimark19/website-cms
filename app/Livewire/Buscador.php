<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Propiedad;
use App\Models\Localidad;
use App\Models\TipoInmueble;
use App\Models\TipoOperacion;

class Buscador extends Component
{
    use WithPagination;

    public $localidad;
    public $tipoInmueble;
    public $tipoOperacion;
    public $orden;
    public $minPrecio;
    public $maxPrecio;
    public $status;

    public $localidades = [];
    public $tiposInmueble = [];
    public $tiposOperacion = [];

    protected $queryString = [
        'localidad' => ['except' => ''],
        'tipoInmueble' => ['except' => ''],
        'tipoOperacion' => ['except' => ''],
        'orden' => ['except' => ''],
        'minPrecio' => ['except' => ''],
        'maxPrecio' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function mount()
    {
        $this->localidades = Localidad::all();
        $this->tiposInmueble = TipoInmueble::all();
        $this->tiposOperacion = TipoOperacion::all();
    }

    public function render()
    {
        $query = Propiedad::with(['galerias', 'localidad', 'tipoInmueble', 'tipoOperacion']);

        if ($this->localidad) {
            $query->where('id_localidad', $this->localidad);
        }

        if ($this->tipoInmueble) {
            $query->where('id_tipo_inmueble', $this->tipoInmueble);
        }

        if ($this->tipoOperacion) {
            $query->where('id_tipo_operacion', $this->tipoOperacion);
        }

        if ($this->minPrecio) {
            $query->where('precio', '>=', $this->minPrecio);
        }

        if ($this->maxPrecio) {
            $query->where('precio', '<=', $this->maxPrecio);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->orden) {
            if ($this->orden === 'precio_asc') $query->orderBy('precio', 'asc');
            if ($this->orden === 'precio_desc') $query->orderBy('precio', 'desc');
            if ($this->orden === 'recientes') $query->orderBy('created_at', 'desc');
        }

        $propiedades = $query->paginate(9)->withQueryString();

        return view('components.livewire.buscador', [
            'propiedades' => $propiedades,
        ]);
    }
}
