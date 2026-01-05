<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\MailService;

class NewsletterController extends Controller
{
    protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    // Guardar suscripción
    public function store(Request $request)
    {
       // Validación
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email',
            'name' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first('email'),
            ], 422);
        }

        $subscriberData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Guardar en BD
        Newsletter::create($subscriberData);

        // Enviar notificaciones
        try {
            $this->mailService->sendNewsletterNotifications($subscriberData);
        } catch (\Exception $e) {
            \Log::error('Error sending newsletter emails: ' . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => '¡Gracias por suscribirte a nuestro boletín!',
        ]);
    }

    // Desuscribirse
    public function unsubscribe($email)
    {
        $subscriber = Newsletter::where('email', $email)->first();

        if (!$subscriber) {
            return redirect('/')->with('error', 'Correo no encontrado.');
        }

        $subscriber->update([
            'subscribed' => false,
            'unsubscribed_at' => now(),
        ]);

        return redirect('/')->with('success', 'Has sido dado de baja del boletín.');
    }
}
