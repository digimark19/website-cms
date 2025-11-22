<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPropiedad extends Model
{
    use HasFactory;

    protected $table = 'tipo_propiedades'; // 👈 nombre de la tabla (ajusta si usas otro)
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'slug',
        'activo',
    ];

    /**
     * Relación: un tipo de propiedad tiene muchas propiedades.
     */
    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'tipo_propiedad_id');
    }
}
