<div class="w-full py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ⭐ TÍTULO CENTRADO --}}
        @if(!empty($content['titulo']))
            <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center" style="font-family: Rubik;">
                {{ $content['titulo'] }}
            </h2>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            {{-- 📷 IMAGEN + FALLBACK --}}
            <div class="relative w-full">

                {{-- Imagen principal con aspect-video (16:9) --}}
                <img 
                    src="{{ $content['imagen'] ?? '' }}"
                    class="w-full aspect-video object-cover rounded-xl shadow-md transition"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    alt="Imagen de inmueble"
                >

                {{-- Fallback si la imagen no carga --}}
                <div class="hidden absolute inset-0 rounded-xl bg-gray-200 items-center justify-center">
                    <i class="fa-solid fa-image text-gray-500 text-5xl"></i>
                </div>
            </div>

            {{-- 📝 TEXTO + BOTÓN --}}
            <div>

                {{-- Subtítulo --}}
                @if(!empty($content['subtitulo']))
                    <h3 class="text-xl text-gray-700 mb-3 font-semibold" style="font-family: Rubik;">
                        {{ $content['subtitulo'] }}
                    </h3>
                @endif

                {{-- Texto principal --}}
                @if(!empty($content['texto']))
                    <p class="text-gray-600 leading-relaxed mb-6 whitespace-pre-line" style="font-family: Inter;">
                        {{ $content['texto'] }}
                    </p>
                @endif

                {{-- 🔘 BOTÓN DEBAJO DEL TEXTO --}}
                @if(!empty($content['boton_url']))
                    <a href="#formulario"
                        class="inline-block px-8 py-3 rounded-md text-white font-bold uppercase shadow-md hover:opacity-90 transition"
                        style="background-color: #FF8A65; font-family: Rubik;">
                        {{ $content['boton_texto'] }}
                    </a>
                @endif

            </div>

        </div>
    </div>
</div>
