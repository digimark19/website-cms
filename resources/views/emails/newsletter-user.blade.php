<x-mail::message>
# ¡Gracias por suscribirte, {{ $data['name'] ?? 'amigo(a)' }}!

Estamos muy felices de decirte que ahora formas parte de nuestra comunidad. Recibirás las mejores actualizaciones, noticias y ofertas exclusivas directamente en tu bandeja de entrada.

**Detalles de tu suscripción:**
*   **Correo registrado:** {{ $data['email'] }}

Si en algún momento deseas dejar de recibir estos correos, puedes hacerlo haciendo clic en el siguiente enlace:

<x-mail::button :url="route('newsletter.unsubscribe', ['email' => $data['email']])" color="error">
Cancelar Suscripción
</x-mail::button>

¡Bienvenido(a) a bordo!<br>
El equipo de {{ config('app.name') }}
</x-mail::message>
