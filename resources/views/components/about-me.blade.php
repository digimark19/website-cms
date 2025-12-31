<div id="sobre-mi-seccion" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Título --}}
    <h2 class="text-center text-4xl font-bold font-[Rubik] mb-12">
        {{ $title }}
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        {{-- Imagen con fallback e ícono --}}
        <div class="w-full h-full rounded-2xl overflow-hidden bg-gray-200 flex items-center justify-center">

            {{-- Si la imagen existe, se intenta cargar --}}
            @if (!empty($image))
                <img 
                    src="{{ $image }}" 
                    alt="{{ $title }}"
                    class="w-full h-full object-cover"
                    onerror="
                        this.style.display='none'; 
                        this.parentElement.classList.add('flex'); 
                        this.parentElement.innerHTML = '<i class=\'fa-solid fa-image text-gray-400 text-7xl\'></i>';
                    "
                >
            @else
                {{-- Si NO existe --}}
                <i class="fa-solid fa-image text-gray-400 text-7xl"></i>
            @endif

        </div>

        {{-- Contenido Rich Text --}}
        <div class="prose prose-lg max-w-none">
            {!! $content !!}
        </div>

    </div>
</div>
