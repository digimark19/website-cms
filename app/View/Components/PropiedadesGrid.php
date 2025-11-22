<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Propiedad;
use App\Models\Localidad;
use App\Models\TipoInmueble;
use App\Models\TipoOperacion;
use App\Models\Caracteristica;

class PropiedadesGrid extends Component
{
    public $propiedades;
    public $localidades;
    public $tiposInmueble;
    public $tiposOperacion;
    public $filters = [];

    public function __construct()
    {
        // Capturar filtros
        $this->filters = [
            'localidad' => Request::get('localidad'),
            'tipo' => Request::get('tipo'),
            'operacion' => Request::get('operacion'),
            'rango_precio' => Request::get('rango_precio'),
            'orden' => Request::get('orden'),

            // Filtros avanzados
            'banos' => Request::get('banos'),
            'construccion' => Request::get('construccion'),
            'terreno' => Request::get('terreno'),
            'estatus' => Request::get('estatus'),
        ];

        $query = Propiedad::with([
            'galerias', 'localidad', 'tipoInmueble', 'tipoOperacion', 'caracteristicas'
        ]);

        // Filtro localidad
        if ($this->filters['localidad']) {
            $query->where('id_localidad', $this->filters['localidad']);
        }

        // Filtro tipo
        if ($this->filters['tipo']) {
            $query->where('id_tipo_inmueble', $this->filters['tipo']);
        }

        // Filtro operacion
        if ($this->filters['operacion']) {
            $query->where('id_tipo_operacion', $this->filters['operacion']);
        }

        // Filtro rango de precio
        if ($this->filters['rango_precio']) {
            $max = intval($this->filters['rango_precio']);
            $query->where('precio', '<=', $max);
        }

        // Filtros de características (pivot)
        $this->applyCaracteristicaFilter($query, 'Baños', 'banos');
        $this->applyCaracteristicaFilter($query, 'Metros cuadrados', 'construccion');
        $this->applyCaracteristicaFilter($query, 'Terreno', 'terreno');

        // Filtro estatus directo a la tabla propiedades
        if ($this->filters['estatus']) {
            $query->where('estatus', $this->filters['estatus']);
        }

        // Orden
        if ($this->filters['orden'] === 'precio_asc') {
            $query->orderBy('precio', 'asc');
        } elseif ($this->filters['orden'] === 'precio_desc') {
            $query->orderBy('precio', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Paginación
        $this->propiedades = $query->paginate(12)->appends(Request::query());

        // Catálogos
        $this->localidades = Localidad::all();
        $this->tiposInmueble = TipoInmueble::all();
        $this->tiposOperacion = TipoOperacion::all();
    }

    private function applyCaracteristicaFilter($query, $nombreCaracteristica, $filterKey)
    {
        if (!$this->filters[$filterKey]) return;

        $valor = $this->filters[$filterKey];

        $caracteristica = Caracteristica::where('nombre->es', $nombreCaracteristica)->first();
        if (!$caracteristica) return;

        $query->whereHas('caracteristicas', function ($q) use ($caracteristica, $valor) {
            $q->where('caracteristica_id', $caracteristica->id)
              ->where('valor', '>=', $valor);
        });
    }

    public function render()
    {
        return view('components.propiedades-grid');
    }
}
