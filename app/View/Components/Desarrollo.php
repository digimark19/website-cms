<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desarrollo extends Model
{
    use HasFactory;

    protected $table = 'desarrollos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo_inmueble_id',
        'tipo_operacion_id',
        'localidad_id',
        'precio',
        'recamaras',
        'banos',
        'estacionamientos',
        'latitud',
        'longitud',
        'ubicacion',
    ];

    protected $casts = [
        'nombre' => 'array',        // formato {"es": "...", "en": "..."}
        'descripcion' => 'array',   // formato {"es": "...", "en": "..."}
        'ubicacion' => 'array',     // formato {"es": "...", "en": "..."}
    ];

    /**
     * Relaciones
     */

    // Tipo de inmueble (ej. Casa, Departamento, Terreno)
    public function tipoInmueble()
    {
        return $this->belongsTo(TipoInmueble::class, 'tipo_inmueble_id');
    }

    // Tipo de operación (ej. Venta, Renta)
    public function tipoOperacion()
    {
        return $this->belongsTo(TipoOperacion::class, 'tipo_operacion_id');
    }

    // Localidad o zona
    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'localidad_id');
    }

    // Galería de imágenes
    public function galeria()
    {
        return $this->hasMany(GaleriaImagen::class, 'desarrollo_id');
    }

    /**
     * Scopes para filtros
     */

    // Filtrar por localidad (zona)
    public function scopePorLocalidad($query, $localidadId)
    {
        if ($localidadId) {
            $query->where('localidad_id', $localidadId);
        }
        return $query;
    }

    // Filtrar por tipo de inmueble
    public function scopePorTipoInmueble($query, $tipoId)
    {
        if ($tipoId) {
            $query->where('tipo_inmueble_id', $tipoId);
        }
        return $query;
    }

    // Filtrar por rango de precios
    public function scopePorRangoPrecio($query, $min = null, $max = null)
    {
        if ($min !== null) {
            $query->where('precio', '>=', $min);
        }
        if ($max !== null) {
            $query->where('precio', '<=', $max);
        }
        return $query;
    }

    // Filtrar por número de recámaras
    public function scopePorRecamaras($query, $recamaras)
    {
        if ($recamaras) {
            $query->where('recamaras', '>=', $recamaras);
        }
        return $query;
    }
}
