<x-mail::message>
# 📰 Nueva Suscripción al Newsletter

Un nuevo usuario se ha suscrito al boletín informativo del sitio web.

**Detalles del Suscriptor:**
*   **Nombre:** {{ $data['name'] ?? 'N/A' }}
*   **Correo Electrónico:** {{ $data['email'] }}
*   **Fecha:** {{ now()->format('d/m/Y H:i') }}

<x-mail::button :url="config('app.url')">
Ir al Sitio Web
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
