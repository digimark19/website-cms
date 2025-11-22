 @if(!empty($siteSettings->whatsapp) || $siteSettings->whatsapp != '')
 <style>
    /* Pequeña mejora visual para suavizar el pulso y sombra en dispositivos viejos */
    .whatsapp-pulse {
      animation: pulse 2.6s cubic-bezier(.4,0,.6,1) infinite;
    }
    @keyframes pulse {
      0% { transform: scale(1); opacity: 1; }
      70% { transform: scale(1.08); opacity: .85; }
      100% { transform: scale(1); opacity: 1; }
    }
  </style>

 
 <!-- Botón flotante de WhatsApp -->
  <a
    id="wa-button"
    href="#"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Chatear por WhatsApp"
    class="fixed right-5 bottom-5 z-50 flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full shadow-lg ring-1 ring-black/5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition-transform hover:scale-105 active:scale-95"
    title="Chatea con nosotros por WhatsApp"
  >
    <!-- Fondo verde (adaptable a modo oscuro) -->
    <span class="absolute inset-0 rounded-full bg-[#25D366] dark:bg-[#128C7E] whatsapp-pulse" aria-hidden="true"></span>

    <!-- Ícono -->
    <svg class="relative w-7 h-7 sm:w-8 sm:h-8 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path d="M20.52 3.48A11.82 11.82 0 0 0 12 0C5.373 0 .04 5.333.04 12c0 2.115.55 4.18 1.6 6.01L0 24l6.21-1.62A11.94 11.94 0 0 0 12 24c6.627 0 12-5.373 12-12 0-3.2-1.25-6.2-3.48-8.52Z" fill="white" fill-opacity="0.06"/>
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.149-.672.15-.198.297-.768.967-.942 1.165-.173.198-.347.223-.644.075-.297-.149-1.255-.462-2.39-1.476-.884-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.447-.52.149-.173.198-.298.298-.497.099-.198.0-.372-.05-.52-.05-.149-.672-1.618-.92-2.214-.242-.58-.487-.5-.672-.51l-.572-.01c-.198 0-.52.074-.793.372s-1.04 1.016-1.04 2.479 1.064 2.873 1.213 3.074c.149.198 2.095 3.2 5.077 4.487.71.306 1.262.489 1.693.626.712.226 1.36.194 1.87.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.288.173-1.413-.074-.124-.273-.198-.57-.347Z" fill="white"/>
    </svg>
  </a>

    <!-- Script para construir el enlace wa.me con número y mensaje predefinidos -->
  <script>
    (function () {
      // --- EDITA ESTO: colocar tu teléfono en formato internacional sin '+' ni espacios.
      // Ejemplo México: "5214412345678" (52 = país, 1 = celular indicativo si aplica, luego el número)
      const phone = "{{$siteSettings->whatsapp}}";

      // --- EDITA ESTO: texto por defecto (se codificará automáticamente).
      const lang = '{{ app()->getLocale() }}';
      const text = JSON.parse(`{{$siteSettings->whatsapp_message}}`.replace(/&quot;/g, '"'))[lang];

      // Construir url de wa.me con mensaje (si quieres usar la versión web.whatsapp.com, este mismo link funciona)
      const url = `https://api.whatsapp.com/send?phone=${phone}&text=${text}`;

      // Asignar al enlace
      const waBtn = document.getElementById("wa-button");
      waBtn.setAttribute("href", url);

      // Opcional: mostrar solo en dispositivos móviles (descomentar si quieres)
      // if (window.innerWidth > 1024) waBtn.style.display = 'none';

      // Mejora de accesibilidad: tecla Enter/Space funciona como click
      waBtn.addEventListener("keydown", function (e) {
        if (e.key === "Enter" || e.key === " ") {
          e.preventDefault();
          waBtn.click();
        }
      });
    })();
  </script>
  @endif