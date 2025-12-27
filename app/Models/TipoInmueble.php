<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInmueble extends Model
{
    use HasFactory;

    protected $table = 'tipos_inmueble';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nombre',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'nombre' => 'array',
    ];

    /**
     * Relación inversa: un tipo de inmueble tiene muchas propiedades
     */
    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id', 'id');
    }
}
