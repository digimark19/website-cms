

<div class="relative w-full bg-cover bg-center flex flex-col justify-end pb-[8vh] min-h-[65vh]"
     style="{{ $bgStyle }}">
    
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Título --}}
        @if($title)
            <div class="px-4">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#052669] mb-2 drop-shadow-lg bg-white/50 backdrop-blur-sm px-6 py-2 rounded-xl inline-block">
                    {{ $title }}
                </h1>
            </div>
        @endif

        {{-- Buscador (PropiedadesGrid en modo solo búsqueda) --}}
        <div class="w-full">
            <x-propiedades-grid :show-results="false" :action="url(app()->getLocale() === 'es' ? 'buscar' : 'search')" />
        </div>
    </div>
</div>
