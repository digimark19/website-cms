<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $table = 'caracteristicas';

    protected $fillable = [
        'nombre',
        'tipo',
    ];

    protected $casts = [
        'nombre' => 'array', // Para usar {"es": "...", "en": "..."}
    ];

    /**
     * Relación con propiedades (pivot)
     */
    public function propiedades()
    {
        return $this->belongsToMany(Propiedad::class, 'propiedad_caracteristica')
                    ->withPivot('valor', 'destacada')
                    ->withTimestamps();
    }

    /**
     * Accesor para obtener nombre en español
     */
    public function getNombreEsAttribute()
    {
        return $this->nombre['es'] ?? null;
    }

    /**
     * Accesor para obtener nombre en inglés
     */
    public function getNombreEnAttribute()
    {
        return $this->nombre['en'] ?? null;
    }
}
