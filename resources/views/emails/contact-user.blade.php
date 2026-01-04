<x-mail::message>
# ¡Gracias por contactarnos, {{ $data['nombre'] }}!

Hemos recibido tu mensaje correctamente. Uno de nuestros asesores expertos se pondrá en contacto contigo a la brevedad para brindarte toda la información que necesitas.

**Resumen de tu mensaje:**
*   **Interés:** {{ $data['tipo'] ?? 'Contacto General' }}
*   **Tu Mensaje:** {{ $data['mensaje'] }}

Mientras tanto, te invitamos a seguir explorando nuestras propiedades disponibles.

<x-mail::button :url="config('app.url')">
Ver Propiedades
</x-mail::button>

Saludos cordiales,<br>
El equipo de {{ config('app.name') }}
</x-mail::message>
