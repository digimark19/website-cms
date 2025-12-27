<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoOperacion extends Model
{
    use HasFactory;

    protected $table = 'tipos_operacion';
    protected $fillable = ['nombre'];

    protected $casts = [
        'nombre' => 'array',
    ];

    // Relación inversa (una operación puede estar asociada a muchas propiedades)
    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id_tipo_operacion', 'id');
    }
}
