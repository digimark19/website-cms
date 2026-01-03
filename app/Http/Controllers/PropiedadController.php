<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use App\Models\Localidad;
use App\Models\TipoInmueble;
use App\Models\TipoOperacion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PropiedadController extends Controller
{
    public function index(Request $request)
    {
        $query = Propiedad::with(['galerias', 'localidad', 'tipoInmueble', 'tipoOperacion'])
            ->orderBy('created_at', 'desc');

        // FILTROS
        if ($request->filled('localidad')) {
            $query->where('id_localidad', $request->localidad);
        }

        if ($request->filled('tipo')) {
            $query->where('id_tipo_inmueble', $request->tipo);
        }

        if ($request->filled('operacion')) {
            $query->where('id_tipo_operacion', $request->operacion);
        }

        // RANGO DE PRECIOS (en tu formulario solo llega un valor)
        if ($request->filled('rango_precio')) {

            switch ($request->rango_precio) {
                case '500000':
                    $query->where('precio', '>=', 500000);
                    break;

                case '1000000':
                case '1500000':
                case '2000000':
                case '2500000':
                case '3000000':
                case '3500000':
                    $query->where('precio', '<=', $request->rango_precio);
                    break;

                case '4000000_plus':
                    $query->where('precio', '>=', 4000000);
                    break;
            }
        }

        // FILTROS AVANZADOS
        if ($request->filled('banos')) {
            $query->where('banos', '>=', $request->banos);
        }

        if ($request->filled('construccion')) {
            $query->where('construccion', '>=', $request->construccion);
        }

        if ($request->filled('terreno')) {
            $query->where('terreno', '>=', $request->terreno);
        }

        if ($request->filled('estatus')) {
            $query->where('estatus', $request->estatus);
        }

        // PAGINACIÓN
        $propiedades = $query->paginate(12)->appends($request->query());

        // CATÁLOGOS
        $localidades = Localidad::orderBy('id')->get();
        $tiposInmueble = TipoInmueble::orderBy('id')->get();
        $tiposOperacion = TipoOperacion::orderBy('id')->get();

        return view('propiedades.index', compact(
            'propiedades',
            'localidades',
            'tiposInmueble',
            'tiposOperacion'
        ));
    }

    public function show($slug)
    {
        $propiedad = Propiedad::with(['galerias', 'localidad', 'tipoInmueble', 'tipoOperacion', 'amenidades', 'caracteristicas'])
            ->where('slug', $slug)
            ->firstOrFail();
        $propiedadtest = $propiedad->toArray();
        // dd($propiedadtest);

        // Propiedades relacionadas (misma categoría, excluyendo la actual)
        $relacionadas = Propiedad::with(['galerias', 'localidad', 'tipoInmueble'])
            ->where('id_tipo_inmueble', $propiedad->id_tipo_inmueble)
            ->where('id', '!=', $propiedad->id)
            ->take(3)
            ->get();

        return view('pages.propiedad-detalle', compact('propiedad', 'relacionadas'));
    }

    public function downloadPdf($slug)
    {
        $propiedad = Propiedad::with(['galerias', 'localidad', 'tipoInmueble', 'tipoOperacion', 'amenidades', 'caracteristicas'])
            ->where('slug', $slug)
            ->firstOrFail();
        $propiedadData = $propiedad->toArray();
        $pdf = Pdf::loadView('pages.propiedad-pdf', compact('propiedad'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("Ficha-Tecnica-{$slug}.pdf");
    }
}
