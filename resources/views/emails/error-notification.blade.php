<x-mail::message>
# ⚠️ Alerta de Error en Producción

Se ha detectado una excepción crítica en el sitio web que requiere atención inmediata.

**Detalles del Error:**
*   **Mensaje:** {{ $exception->getMessage() }}
*   **Archivo:** {{ $exception->getFile() }}
*   **Línea:** {{ $exception->getLine() }}
*   **URL:** {{ request()->fullUrl() }}
*   **IP:** {{ request()->ip() }}

**Traza simplificada:**
```text
{{ Str::limit($exception->getTraceAsString(), 1000) }}
```

<x-mail::button :url="config('app.url')">
Ver Sitio Web
</x-mail::button>

Gracias,<br>
Sistema de Monitoreo {{ config('app.name') }}
</x-mail::message>
