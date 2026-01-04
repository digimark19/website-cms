<x-mail::message>
# Nuevo Prospecto de Cliente

Has recibido un nuevo mensaje a través del formulario de contacto.

**Detalles del Cliente:**
*   **Nombre:** {{ $data['nombre'] }} {{ $data['apellido'] }}
*   **Correo:** {{ $data['correo'] }}
*   **Teléfono:** {{ $data['lada'] }} {{ $data['telefono'] }}
*   **Ciudad/País:** {{ $data['ciudad'] ?? 'N/A' }}, {{ $data['pais'] ?? 'N/A' }}
*   **Origen (Página):** {{ $data['url'] ?? 'N/A' }}

**Mensaje:**
{{ $data['mensaje'] }}

<x-mail::button :url="config('app.url')">
Ir al Sitio Web
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
