<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
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

        // Guardar en BD
        Newsletter::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

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
