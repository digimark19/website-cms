<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galerias extends Model
{
    use HasFactory;

    protected $table = 'galerias'; // nombre real de la tabla

    protected $fillable = [
        'id_propiedad',
        'imagen_url',
        'descripcion',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'id_propiedad');
    }
}
