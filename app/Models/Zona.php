<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    protected $table = 'zonas';

    protected $fillable = [
        'nombre',
        'bitactivo',
    ];

    protected $casts = [
        'nombre' => 'array', // para manejar JSON {es, en}
        'bitactivo' => 'boolean',
    ];

    // Relación con propiedades
    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'zona_id');
    }
}
