<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';

    protected $fillable = [
        'id_desarrollo',
        'id_localidad',
        'id_tipo_inmueble',
        'id_tipo_operacion',
        'nombre',
        'descripcion',
        'ubicacion',
        'latitud',
        'longitud',
        'precio',
        'status',
    ];

    protected $casts = [
        'nombre' => 'array',
        'descripcion' => 'array',
        'ubicacion' => 'array',
    ];

    // 🔗 Relaciones
    public function desarrollo()
    {
        return $this->belongsTo(Desarrollo::class, 'id_desarrollo');
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'id_localidad');
    }

    public function tipoInmueble()
    {
        return $this->belongsTo(TipoInmueble::class, 'id_tipo_inmueble');
    }

    public function tipoOperacion()
    {
        return $this->belongsTo(TipoOperacion::class, 'id_tipo_operacion');
    }

    public function galerias()
    {
        return $this->hasMany(Galerias::class, 'id_propiedad');
    }

    public function amenidades()
    {
        return $this->belongsToMany(Amenidad::class, 'propiedad_amenidad', 'id_propiedad', 'id_amenidad');
    }
    public function caracteristicas()
    {
        return $this->belongsToMany(Caracteristica::class, 'propiedad_caracteristica')
            ->withPivot('valor', 'destacada')
            ->withTimestamps();
    }
}
