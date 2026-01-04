<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    // Nombre de la tabla
    protected $table = 'site_settings';

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'site_name',
        'site_title',
        'site_description',
        'address',
        'phone',
        'email',
        'whatsapp',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'logo_path',
        'latitude',
        'longitude',
        'theme_color',
        'schedule',
        'language',
        'notification_email',
        'notification_cc',
    ];

    // Si no usas timestamps en la tabla (created_at, updated_at)
    public $timestamps = true;

    /**
     * 🔹 Si 'schedule' se guarda como JSON, podemos convertirlo automáticamente.
     */
    protected $casts = [
        'schedule' => 'array',
    ];
}
