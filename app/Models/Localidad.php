<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = ['id', 'nombre', 'activo'];

    protected $casts = [
        'nombre' => 'array',
    ];

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id', 'nombre');
    }
}
