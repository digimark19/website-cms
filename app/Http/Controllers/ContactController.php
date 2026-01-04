<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;
use App\Services\MailService;

class ContactController extends Controller
{
    protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

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

        $contactData = [
            'nombre'      => $request->nombre,
            'apellido'    => $request->apellido,
            'correo'      => $request->correo,
            'lada'        => $request->lada,
            'telefono'    => $request->telefono,
            'pais'        => $paisDetectado,
            'ciudad'      => $request->ciudad,
            'mensaje'     => $request->mensaje,
            'tipo'        => $request->tipo,
            'url'         => $request->url,
        ];

        ContactForm::create(array_merge($contactData, [
            'ip'          => $request->ip(),
            'user_agent'  => $request->userAgent(),
        ]));

        // Enviar notificaciones
        try {
            $this->mailService->sendContactNotifications($contactData);
        } catch (\Exception $e) {
            // Log error or handle silently to not block the user experience
            \Log::error('Error sending contact emails: ' . $e->getMessage());
        }

        return response()->json(['success' => true]);
    }
}
