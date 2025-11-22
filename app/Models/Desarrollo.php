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
        'ubicacion',
        'imagenes',
        'latitud',
        'longitud',
        'bitactivo',
    ];

    protected $casts = [
        'nombre' => 'array',
        'descripcion' => 'array',
        'ubicacion' => 'array',
        'imagenes' => 'array',
        'bitactivo' => 'boolean',
    ];

    public function galerias()
    {
        return $this->hasMany(GaleriaImagen::class, 'id_desarrollo');
    }

}
