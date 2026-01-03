<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenidad extends Model
{
    use HasFactory;

    protected $table = 'amenidades';

    protected $fillable = [
        'nombre',
        'icono',
    ];

    protected $casts = [
        'nombre' => 'array',
    ];

    public function propiedades()
    {
        return $this->belongsToMany(Propiedad::class, 'propiedad_amenidad', 'id_amenidad', 'id_propiedad');
    }
}
