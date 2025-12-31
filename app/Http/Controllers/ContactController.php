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
            'lada'     => 'required|string',
            'telefono' => 'required|string',
            'pais'     => 'nullable|string',
            'ciudad'   => 'required|string',
            'mensaje'  => 'required|string',
            'tipo'     => 'required|string',
        ]);

        // Mapeo de Lada a País
        $paises = [
            '+52' => 'México',
            '+1'  => 'USA',
            '+57' => 'Colombia',
            '+54' => 'Argentina',
            '+34' => 'España',
            '+56' => 'Chile',
            '+51' => 'Perú',
        ];

        $paisDetectado = $paises[$request->lada] ?? $request->pais ?? 'Otro';

        ContactForm::create([
            'nombre'      => $request->nombre,
            'apellido'    => $request->apellido,
            'correo'      => $request->correo,
            'lada'        => $request->lada,
            'telefono'    => $request->telefono,
            'pais'        => $paisDetectado,
            'ciudad'      => $request->ciudad,
            'mensaje'     => $request->mensaje,
            'tipo'        => $request->tipo,
            'ip'          => $request->ip(),
            'user_agent'  => $request->userAgent(),
        ]);

        return response()->json(['success' => true]);
    }
}
