<div class="relative w-full h-[80vh] flex items-center bg-gray-900">

    {{-- Imagen de fondo --}}
    <div class="absolute inset-0">
        <img 
            src="{{ $content['image'] ?? 'https://via.placeholder.com/1600x900?text=Hero+3' }}"
            alt="Hero 3 image"
            class="w-full h-full object-cover brightness-[0.45]"
        >
    </div>

    {{-- Contenido alineado al mismo ancho que el navbar --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-2xl">

            {{-- Título Rich Text --}}
            @if (!empty($content['title']))
            <h1 class="text-5xl font-[Rubik] font-bold leading-tight mb-6 text-white">
                {!! $content['title'] !!}
            </h1>
            @endif

            {{-- Descripción Rich Text --}}
            @if (!empty($content['description']))
            <p class="text-lg text-white/90 mb-8">
                {!! $content['description'] !!}
            </p>
            @endif

            {{-- Botón --}}
            @if (!empty($content['button_text']) && !empty($content['button_link']))
            <a href="{{ $content['button_link'] }}"
                class="inline-block bg-[#0AB3B6] hover:bg-[#089fa1] text-white font-semibold px-6 py-3 rounded-lg transition">
                {{ $content['button_text'] }}
            </a>
            @endif

        </div>
    </div>

</div>
+