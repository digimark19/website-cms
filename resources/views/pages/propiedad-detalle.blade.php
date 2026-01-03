@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen pt-12 pb-12" x-data="{ 
    activeImage: 0,
    showAllPhotos: false
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 🔙 Top Navigation (Clean & Simple) --}}
        {{-- 🔙 Top Navigation REMOVED --}}


        {{-- 🖼️ Gallery Grid (Mosaic 1 Large + 4 Small) --}}
        {{-- Mobile: Horizontal Carousel | Desktop: Mosaic Grid --}}
        <div class="flex md:grid md:grid-cols-4 md:grid-rows-2 gap-4 md:gap-2 h-[45vh] md:h-[60vh] mb-8 rounded-xl overflow-x-auto md:overflow-hidden snap-x snap-mandatory no-scrollbar">
            
            {{-- Main Image (Left, 50% width) --}}
            <div class="min-w-[90%] md:min-w-0 md:col-span-2 md:row-span-2 relative group cursor-pointer overflow-hidden snap-center" @click="showAllPhotos = true; activeImage = 0">
                <img src="{{ asset('storage/' . ($propiedad->galerias[0]->imagen_url ?? '')) }}" 
                     onerror="this.src='https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=1600'"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                
                {{-- Status Tag --}}
                <div class="absolute top-4 left-4">
                     <span class="bg-[#0AB3B6] text-white px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider">
                        {{ $propiedad->tipoOperacion->nombre[app()->getLocale()] ?? 'Venta' }}
                    </span>
                </div>
            </div>

            {{-- Secondary Images (Right Grid) --}}
            @for($i = 1; $i <= 4; $i++)
                @if(isset($propiedad->galerias[$i]))
                    <div class="min-w-[90%] md:min-w-0 col-span-1 row-span-1 relative group cursor-pointer overflow-hidden snap-center" @click="showAllPhotos = true; activeImage = {{ $i }}">
                        <img src="{{ asset('storage/' . ($propiedad->galerias[$i]->imagen_url ?? '')) }}" 
                             onerror="this.src='https://images.unsplash.com/photo-1502673530728-f79b4cab31b1?w=800'"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        
                        {{-- "View All" Overlay on the last visible slot --}}
                        @if($i == 4)
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-white backdrop-blur-[2px] transition-colors hover:bg-black/60">
                                <span class="font-bold text-lg flex flex-col items-center gap-1">
                                    <i class="fa-solid fa-images"></i>
                                    +{{ $propiedad->galerias->count() - 5 > 0 ? $propiedad->galerias->count() - 5 : 'Fotos' }}
                                </span>
                            </div>
                        @endif
                    </div>
                @else
                    {{-- Placeholder if fewer than 5 images --}}
                    <div class="min-w-[90%] md:min-w-0 bg-gray-100 flex items-center justify-center text-gray-300 snap-center">
                        <i class="fa-solid fa-image text-2xl"></i>
                    </div>
                @endif
            @endfor
        </div>


        {{-- 📄 Main Content Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 relative">
            
            {{-- Left Column: Details (2/3 width) --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Title & Location Section --}}
                <div>
                     <h1 class="text-3xl md:text-4xl font-extrabold text-[#052669] mb-2 font-['Outfit']">
                        {{ $propiedad->nombre[app()->getLocale()] ?? 'Propiedad Exclusiva' }}
                    </h1>
                    <p class="text-gray-500 font-medium flex items-center gap-2 text-lg">
                        <i class="fa-solid fa-location-dot text-[#0AB3B6]"></i>
                        {{ $propiedad->localidad->nombre[app()->getLocale()] ?? 'Ubicación' }}, México
                    </p>
                </div>

                {{-- Stats Bar (Horizontal) --}}
                @php
                    // Helper para obtener valor de característica
                    $getCarac = function($key) use ($propiedad) {
                        return $propiedad->caracteristicas->first(function($c) use ($key) {
                            $nombre = strtolower($c->nombre['es'] ?? '');
                            return str_contains($nombre, $key);
                        })?->pivot->valor ?? 0;
                    };
                @endphp
                <div class="flex flex-wrap gap-4 md:gap-8 border-y border-gray-100 py-6">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-bed text-gray-400 text-xl"></i>
                        <span class="font-bold text-[#052669] text-lg">{{ $getCarac('recámara') }} <span class="text-gray-400 text-sm font-normal">Recámaras</span></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-bath text-gray-400 text-xl"></i>
                        <span class="font-bold text-[#052669] text-lg">{{ $getCarac('baño') }} <span class="text-gray-400 text-sm font-normal">Baños</span></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-ruler-combined text-gray-400 text-xl"></i>
                        <span class="font-bold text-[#052669] text-lg">{{ $getCarac('construcción') ?: $getCarac('metros cuadrados') }} <span class="text-gray-400 text-sm font-normal">m²</span></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-car text-gray-400 text-xl"></i>
                        <span class="font-bold text-[#052669] text-lg">{{ $getCarac('estacionamiento') }} <span class="text-gray-400 text-sm font-normal">Cocheras</span></span>
                    </div>
                </div>

                {{-- Amenities (Moved Up) --}}
                @if($propiedad->amenidades->count() > 0)
                <div class="mt-8 mb-8 bg-gray-50 rounded-xl p-6">
                     <h3 class="text-lg font-bold text-[#052669] mb-4">Amenidades</h3>
                     <div class="grid grid-cols-2 md:grid-cols-4 gap-y-3 gap-x-4">
                        @foreach($propiedad->amenidades as $amenidad)
                             <div class="flex items-center gap-2 text-gray-600 text-sm">
                                <i class="fa-solid fa-check text-[#0AB3B6] text-xs"></i>
                                <span>{{ $amenidad->nombre[app()->getLocale()] ?? $amenidad->nombre['es'] }}</span>
                             </div>
                        @endforeach
                     </div>
                </div>
                @endif

                {{-- Description --}}
                <div>
                    <h3 class="text-xl font-bold text-[#052669] mb-4">Descripción General</h3>
                    <div class="prose prose-blue text-gray-600 max-w-none leading-relaxed">
                        {!! $propiedad->descripcion[app()->getLocale()] ?? 'Sin descripción disponible.' !!}
                    </div>
                </div>


                
                {{-- Map Placeholder --}}
                {{-- Map Section --}}
                @if(!empty($propiedad->latitud) && !empty($propiedad->longitud))
                    <div class="rounded-xl overflow-hidden h-[400px] shadow-sm border border-gray-100 mt-6 relative z-0">
                        <iframe 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0" 
                            marginwidth="0" 
                            src="https://maps.google.com/maps?q={{ $propiedad->latitud }},{{ $propiedad->longitud }}&hl=es&z=15&amp;output=embed">
                        </iframe>
                         {{-- Overlay to prevent scroll trap if needed, but standard iframe is fine --}}
                    </div>
                @else
                    {{-- Placeholder if no coordinates --}}
                    <div class="rounded-xl overflow-hidden bg-gray-100 h-64 relative border border-gray-100 mt-6 flex items-center justify-center">
                        <div class="text-center text-gray-400">
                             <i class="fa-solid fa-map-location-dot text-4xl mb-2 text-gray-300"></i>
                             <p class="font-bold">Ubicación no disponible</p>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Right Column: Sticky Sidebar --}}
            <div class="lg:col-span-1">
                <div class="sticky top-28 space-y-6">
                    
                    {{-- 🏷️ Price Card --}}
                    <div class="bg-white rounded-xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div class="text-gray-500 text-sm font-medium">Precio de Venta</div>
                            @if($propiedad->status == 'disponible')
                                <span class="bg-green-50 text-green-700 px-2 py-0.5 rounded text-xs font-bold uppercase">Disponible</span>
                            @endif
                        </div>
                        <div class="text-3xl font-extrabold text-[#0AB3B6] mb-6 font-['Outfit']">
                            ${{ number_format($propiedad->precio[app()->getLocale()]['precio'] ?? 0, 0) }}
                            <span class="text-sm text-gray-400 font-normal">{{ $propiedad->precio[app()->getLocale()]['moneda'] ?? 'MXN' }}</span>
                        </div>

                        <div class="space-y-3">
                            <button @click="$dispatch('open-quote')" class="w-full bg-[#052669] hover:bg-[#031b4e] text-white py-3.5 rounded-lg font-bold transition shadow-lg shadow-[#052669]/20">
                                Solicitar Información
                            </button>
                            <a href="https://wa.me/{{ $siteSettings->whatsapp }}?text={{ urlencode('Hola, estoy interesado en la propiedad: ' . ($propiedad->nombre[app()->getLocale()] ?? 'Propiedad')) }}" target="_blank" class="w-full bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 py-3.5 rounded-lg font-bold flex items-center justify-center gap-2 transition">
                                <i class="fa-brands fa-whatsapp text-green-500 text-lg"></i>
                                Contactar por WhatsApp
                            </a>
                        </div>
                    </div>

                    {{-- 👤 Agent/Seller Card --}}
                    <div class="bg-white rounded-xl border border-gray-100 p-6 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden">
                             <i class="fa-solid fa-user text-gray-400"></i>
                        </div>
                        <div>
                            <div class="text-[#052669] font-bold text-sm">Asesor Inmobiliario</div>
                            <div class="text-xs text-gray-500">Agente Certificado</div>
                        </div>
                        <div class="ml-auto flex gap-2">
                             {{-- Botones con color para resaltar --}}
                             <a href="tel:{{ $siteSettings->phone }}" class="w-9 h-9 rounded-lg bg-[#0AB3B6] text-white flex items-center justify-center shadow-lg shadow-[#0AB3B6]/20 hover:scale-105 transition">
                                <i class="fa-solid fa-phone text-xs"></i>
                             </a>
                             <a href="mailto:{{ $siteSettings->email }}" class="w-9 h-9 rounded-lg bg-[#FF8A65] text-white flex items-center justify-center shadow-lg shadow-[#FF8A65]/20 hover:scale-105 transition">
                                <i class="fa-solid fa-envelope text-xs"></i>
                             </a>
                        </div>
                    </div>

                    {{-- PDF Download --}}
                    <a href="{{ route('propiedades.pdf', $propiedad->slug) }}" class="flex items-center justify-center gap-2 text-[#052669] bg-gray-50 border-2 border-gray-100 hover:border-[#FF8A65] hover:bg-white hover:text-[#FF8A65] rounded-xl px-4 py-3 text-sm font-bold transition w-full group">
                        <i class="fa-solid fa-file-pdf text-[#FF8A65] group-hover:scale-110 transition-transform"></i> 
                        Descargar Ficha Técnica
                    </a>

                    {{-- Share Dropdown --}}
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" class="flex items-center justify-center gap-2 text-gray-500 bg-white border border-gray-200 hover:border-[#0AB3B6] hover:text-[#0AB3B6] rounded-xl px-4 py-3 text-sm font-bold transition w-full shadow-sm hover:shadow-md">
                            <i class="fa-solid fa-share-nodes text-lg"></i>
                            Compartir Propiedad
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-50 p-1"
                             style="display: none;">
                            
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-lg transition text-gray-600 hover:text-[#1877F2] font-medium">
                                <i class="fa-brands fa-facebook text-xl"></i> Facebook
                            </a>
                            
                            <a href="https://api.whatsapp.com/send?text={{ urlencode('Mira esta propiedad: ' . request()->url()) }}" target="_blank" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-lg transition text-gray-600 hover:text-[#25D366] font-medium">
                                <i class="fa-brands fa-whatsapp text-xl"></i> WhatsApp
                            </a>
                            
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($propiedad->nombre[app()->getLocale()]) }}" target="_blank" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-lg transition text-gray-600 hover:text-black font-medium">
                                <i class="fa-brands fa-x-twitter text-xl"></i> X / Twitter
                            </a>
                            
                            <button @click="navigator.clipboard.writeText('{{ request()->url() }}'); open = false;" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-gray-50 rounded-lg transition text-gray-600 hover:text-[#052669] font-medium text-left">
                                <i class="fa-solid fa-link text-gray-400 text-xl"></i> Copiar Enlace
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- 🏘️ Related Properties --}}
        @if($relacionadas->count() > 0)
        <div class="mt-20 pt-12 border-t border-gray-100" 
             x-data="{ view: 'grid', mobile: window.innerWidth < 768 }" 
             @resize.window="mobile = window.innerWidth < 768">
            <h2 class="text-2xl font-bold text-[#052669] mb-8">Propiedades Similares</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relacionadas as $rel)
                    @if(!empty($rel->slug))
                        <x-propiedad-card 
                            :prop="$rel" 
                            :view="'grid'"
                            :labels="$labels ?? []" 
                        />
                    @endif
                @endforeach
            </div>
        </div>
        @endif

    </div>

    {{-- 🖼️ Fullscreen Gallery Modal --}}
    <template x-teleport="body">
        <div x-show="showAllPhotos" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[1000] flex items-center justify-center p-4"
             x-cloak>
            
            <div class="fixed inset-0 bg-black/95 backdrop-blur-sm" @click="showAllPhotos = false"></div>
            
            <div class="relative w-full max-w-7xl h-full flex flex-col pointer-events-none">
                <div class="pointer-events-auto flex justify-between items-center text-white mb-4 pt-4 px-2">
                    <span class="font-bold text-lg">{{ $propiedad->nombre[app()->getLocale()] ?? 'Galería' }}</span>
                    <button @click="showAllPhotos = false" class="text-4xl hover:text-[#FF8A65] transition-colors">&times;</button>
                </div>

                <div class="pointer-events-auto flex-grow relative flex items-center justify-center bg-black/50 rounded-lg overflow-hidden">
                    <div class="absolute inset-0 flex transition-transform duration-500 ease-out" 
                         :style="`transform: translateX(-${activeImage * 100}%)`">
                        @foreach($propiedad->galerias as $foto)
                        <div class="w-full h-full flex-shrink-0 flex items-center justify-center p-2 md:p-8">
                            <img src="{{ asset('storage/' . $foto->imagen_url) }}" 
                                 onerror="this.src='https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=1600'"
                                 class="max-w-full max-h-full object-contain">
                        </div>
                        @endforeach
                    </div>

                    @if(count($propiedad->galerias) > 1)
                        <button @click="activeImage = activeImage > 0 ? activeImage - 1 : {{ count($propiedad->galerias) - 1 }}" 
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/30 text-white flex items-center justify-center transition">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button @click="activeImage = activeImage < {{ count($propiedad->galerias) - 1 }} ? activeImage + 1 : 0" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 hover:bg-white/30 text-white flex items-center justify-center transition">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    @endif
                </div>

                <div class="pointer-events-auto mt-4 h-20 flex justify-center gap-2 overflow-x-auto pb-2">
                    @foreach($propiedad->galerias as $index => $foto)
                    <button @click="activeImage = {{ $index }}" 
                            class="w-16 h-16 flex-shrink-0 rounded-lg overflow-hidden border-2 transition-all opacity-60 hover:opacity-100"
                            :class="activeImage === {{ $index }} ? 'border-[#0AB3B6] opacity-100' : 'border-transparent'">
                        <img src="{{ asset('storage/' . $foto->imagen_url) }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </template>

    {{-- 📱 Mobile Fixed Price Bar --}}
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 flex items-center justify-between z-40 lg:hidden shadow-[0_-5px_20px_rgba(0,0,0,0.05)]">
        <div>
            <div class="text-xs text-gray-500 uppercase">Precio</div>
            <div class="text-xl font-bold text-[#052669]">
                 ${{ number_format($propiedad->precio[app()->getLocale()]['precio'] ?? 0, 0) }}
            </div>
        </div>
        <button class="bg-[#052669] text-white px-6 py-3 rounded-lg font-bold text-sm">
            Contactar
        </button>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
    .font-outfit { font-family: 'Outfit', sans-serif; }
</style>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
@endsection
