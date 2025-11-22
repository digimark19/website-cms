<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla
     */
    protected $table = 'locales'; // <- asegúrate de que la migración también use este nombre

    /**
     * Atributos que se pueden asignar en masa.
     */
    protected $fillable = [
        'code',          // es, en, fr
        'name',          // Español, English
        'native_name',   // Español, English
        'url_prefix',    // en, fr, o null
        'is_default',
        'is_active',
    ];

    /**
     * Devuelve el idioma por defecto.
     */
    public static function default(): ?self
    {
        return static::where('is_default', true)->first();
    }

    /**
     * Devuelve todos los idiomas activos.
     */
    public static function active()
    {
        return static::where('is_active', true)->get();
    }

    /**
     * Encuentra un idioma por su código (es, en, fr...).
     */
    public static function findByCode(string $code): ?self
    {
        return static::where('code', $code)->first();
    }

    /**
     * Verifica si el idioma está activo.
     */
    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    /**
     * Verifica si es el idioma por defecto.
     */
    public function isDefault(): bool
    {
        return (bool) $this->is_default;
    }
}
