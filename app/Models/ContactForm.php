<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $table = 'contact_requests';

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'pais',
        'ciudad',
        'mensaje',
        'tipo',
        'ip',
        'user_agent'
    ];
}
