<section class="relative bg-gray-100 pb-[28rem] sm:pb-[26rem] md:pb-48 lg:pb-48 lg:pt-4 pt-[4rem] sm:pt-[4rem]">
  <!-- Contenedor principal -->
  <div class="max-w-7xl mx-auto px-4 text-center relative">
    <!-- Título pequeño -->
    <p class="text-sm text-[#0AB3B6] uppercase mb-2">{{ $content['titulo'] ?? '' }}</p>
    
    <!-- Título principal -->
    <h2 class="text-2xl md:text-3xl font-medium text-gray-800 mb-8">
      {{ $content['subtitulo'] ?? '' }}
    </h2>

    <!-- Imagen central responsiva -->
    <div class="relative mb-20">
      <picture>
        <!-- Imagen para pantallas grandes -->
        <source srcset="https://img.freepik.com/foto-gratis/mujer-trabajando-remotamente-casa_23-2150192195.jpg?semt=ais_hybrid&w=740&q=80" media="(min-width: 1280px)">
        <!-- Imagen para pantallas medianas -->
        <source srcset="https://img.freepik.com/foto-gratis/mujer-trabajando-remotamente-casa_23-2150192195.jpg?semt=ais_hybrid&w=740&q=80" media="(min-width: 768px)">
        <!-- Imagen por defecto (móvil) -->
        <img 
          src="https://img.freepik.com/foto-gratis/mujer-trabajando-remotamente-casa_23-2150192195.jpg?semt=ais_hybrid&w=740&q=80" 
          alt="Trabajo en laptop"
          class="w-full max-w-7xl mx-auto 
                h-[260px] sm:h-[300px] md:h-[360px] lg:h-[420px]
                object-cover rounded-2xl shadow-lg"
        >
      </picture>
    </div>

    <!-- Tarjetas flotantes -->
    @if(!empty($content['tarjetas']))
    <div 
      class="absolute left-1/2 bottom-0 transform -translate-x-1/2 
             translate-y-[75%] sm:translate-y-[78%] md:translate-y-[80%] 
             w-full px-6 md:px-10">
      <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-10 md:gap-y-12">
        @foreach($content['tarjetas'] as $card)
        <div class="relative bg-white rounded-2xl shadow-xl p-6 pt-12 pb-8 flex flex-col items-center text-center transition transform hover:-translate-y-2 duration-300 h-auto">

          <!-- Ícono cuadrado sobresaliente -->
          <div class="absolute -top-8 flex items-center justify-center w-16 h-16 bg-[#D9A494] rounded-xl shadow-md">
            <i class="{{ $card['icono'] }} text-white text-2xl"></i>
          </div>

          <!-- Contenido -->
          <h3 class="font-semibold text-gray-800 mb-2 mt-4">{{ $card['titulo'] ?? '' }}</h3>
          
          <p class="text-gray-500 text-sm mb-3 line-clamp-4 overflow-hidden">
            {{ $card['descripcion'] }}
          </p>

          <!-- Link inferior -->
          <a href="#" class="text-[#0AB3B6] font-medium text-sm hover:underline transition mt-2">
            Ver más →
          </a>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</section>

<!-- 
| Dispositivo         | Tamaño recomendado | Relación de aspecto sugerida                         |
| ------------------- | ------------------ | ---------------------------------------------------- |
| 📱 Mobile           | **800 × 600 px**   | 4:3 (para que no se recorte el contenido importante) |
| 💻 Desktop mediano  | **1600 × 700 px**  | 16:7 (amplia, cinematográfica)                       |
| 🖥️ Pantalla grande | **1920 × 850 px**  | 21:9 (ideal para pantallas anchas y diseño heroico)  |
-->
