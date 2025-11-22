<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string',
            'apellido' => 'required|string',
            'correo'   => 'required|email',
            'telefono' => 'required|string',
            'pais'     => 'required|string',
            'ciudad'   => 'required|string',
            'mensaje'  => 'required|string',
            'tipo'     => 'required|string',
        ]);

        ContactForm::create([
            'nombre'      => $request->nombre,
            'apellido'    => $request->apellido,
            'correo'      => $request->correo,
            'telefono'    => $request->telefono,
            'pais'        => $request->pais,
            'ciudad'      => $request->ciudad,
            'mensaje'     => $request->mensaje,
            'tipo'        => $request->tipo,
            'ip'          => $request->ip(),
            'user_agent'  => $request->userAgent(),
        ]);

        return response()->json(['success' => true]);
    }
}
