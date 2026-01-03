
@props(['prop', 'view' => 'grid'])

@php
    $currentLocale = app()->getLocale();
    // $siteSettings is available globally via View::share or similar mechanism in this project.
    
    // Fallback $labels if not passed (though ideally passed)
    // We can rely on $labels variable if passed to component, or hardcode defaults/trans
    // For now, let's assume labels might be passed via attributes or available in view view.
    // If not, we use defaults.
    $labels = $attributes->get('labels', [
        'labelRecamara' => 'rec',
        'labelBanos' => 'baños',
        'labelConstruccionlbl' => 'm²',
        'labelTerreno' => 'm²',
        'labelEstacionamientos' => 'est',
        'labelNiveles' => 'niv',
        'btnLabelMasInformacion' => 'Más información',
    ]);

    $loc = $prop->localidad->nombre;
    $nombreLoc = $loc[$currentLocale] ?? $loc['es'] ?? 'Sin localidad';

    // Imagen temporal de relleno si no existe
    $imagen = $prop->galerias->first()->url_imagen 
        ?? "https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800";

    // Precio con moneda según idioma
    $precioData = $prop->precio[$currentLocale] ?? $prop->precio['es'] ?? ['precio' => 0, 'moneda' => 'MXN'];
    $precio = number_format($precioData['precio'], 2);
    $moneda = $precioData['moneda'];

    // Etiquetas simuladas (si aplica)
    $tipoOperacion = $prop->tipoOperacion->nombre[$currentLocale] ?? $prop->tipoOperacion->nombre['es'] ?? 'Operación';
    // $tags = ['Destacado', 'Oportunidad']; // Optional: pass tags as prop if needed
    $tags = []; // Default empty for now unless passed

    $nombreTipo = $prop->tipoInmueble->nombre[$currentLocale] ?? $prop->tipoInmueble->nombre['es'] ?? 'Tipo';
@endphp

<div class="bg-white rounded-lg shadow hover:shadow-lg transition-all duration-300 overflow-hidden flex"
     :class="(view === 'grid' || mobile) ? 'flex-col' : 'flex-col md:flex-row h-auto md:min-h-[320px] w-full'">

    {{-- Imagen --}}
    <div class="relative bg-gray-200 overflow-hidden transition-all duration-300 flex-shrink-0"
         :class="(view === 'grid' || mobile) ? 'h-64 w-full' : 'md:w-96 relative'">
       @php
            $tipoId = $prop->id_tipo_inmueble ?? null;
            // Imágenes por ID de tipo (fallback logic can be simplified if centralized, but keeping inline for robustness)
            // ... (Omitting full array for brevity, relying on $imagen already set above or simple fallback)
       @endphp

        <img 
            src="{{ $imagen }}"
            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800';"
            alt="{{ $nombreTipo }}"
            class="absolute inset-0 w-full h-full object-cover transform hover:scale-105 transition duration-300"
        >

        {{-- ETIQUETAS Y CATEGORÍAS (superior derecha) --}}
        <div class="absolute top-2 right-2 flex flex-wrap gap-2 justify-end">
            <span class="bg-[#FF8A65] text-white px-2 py-1 text-xs rounded shadow">
                {{ $nombreTipo }}
            </span>
            <span class="bg-[#0AB3B6] text-white px-2 py-1 text-xs rounded shadow">
                {{ $tipoOperacion }}
            </span>
        </div>
    </div>

    <div class="p-5 flex flex-col flex-grow">

        {{-- Título — Nombre + Localidad --}}
        <div class="mb-1">
            <h2 class="text-xl font-bold text-gray-900 leading-tight mb-1 truncate" title="{{ $prop->nombre[$currentLocale] ?? $prop->nombre }}">
                {{ $prop->nombre[$currentLocale] ?? $prop->nombre ?? 'Propiedad' }}
            </h2>
            <div class="flex items-center gap-1 text-sm text-gray-500">
                 <i class="fas fa-map-marker-alt text-[#0AB3B6]"></i>
                 <span>{{ $nombreLoc }}</span>
            </div>
        </div>

        {{-- Línea divisoria --}}
        <div class="w-full h-px bg-gray-200 my-3"></div>

        {{-- Helper para características --}}
        @php
            $getCarac = function($key) use ($prop) {
                // Determine locale properly
                $myLocale = app()->getLocale();
                $caracteristica = $prop->caracteristicas->first(function($c) use ($key, $myLocale) {
                    $nombre = strtolower($c->nombre[$myLocale] ?? $c->nombre['es'] ?? '');
                    return str_contains($nombre, $key);
                });
                return $caracteristica ? $caracteristica->pivot->valor : null;
            };
        @endphp

        {{-- Características más completas --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-y-3 gap-x-2 text-xs text-gray-700 mb-4">

            @if($prop->id_tipo_inmueble != 3) {{-- Ocultar si es Terreno --}}
                <div class="flex items-center gap-2">
                    <i class="fas fa-bed text-[#FF8A65] w-4 text-center"></i>
                    <span class="truncate">{{ $getCarac('recámara') ?? $prop->recamaras ?? '0' }} {{ $labels["labelRecamara"] ?? 'Recámaras' }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <i class="fas fa-bath text-[#FF8A65] w-4 text-center"></i>
                    <span class="truncate">{{ $getCarac('baño') ?? $prop->banos ?? '0' }} {{ $labels["labelBanos"] ?? 'Baños' }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <i class="fas fa-ruler-combined text-[#FF8A65] w-4 text-center"></i>
                    <span class="truncate">{{ $getCarac('construcción') ?: $getCarac('metros cuadrados') ?: ($prop->metros_cuadrados ?? '—') }} m² <span class="text-[10px] text-gray-400">Const.</span></span>
                </div>
            @endif

            <div class="flex items-center gap-2">
                <i class="fas fa-ruler-combined text-[#FF8A65] w-4 text-center"></i>
                <span class="truncate">{{ $getCarac('terreno') ?? $prop->terreno ?? '—' }} m² <span class="text-[10px] text-gray-400">Terreno</span></span>
            </div>

            <div class="flex items-center gap-2">
                <i class="fas fa-car text-[#FF8A65] w-4 text-center"></i>
                <span class="truncate">{{ $getCarac('estacionamiento') ?? $prop->estacionamientos ?? '—' }} Cocheras</span>
            </div>

            @if($prop->id_tipo_inmueble != 3) {{-- Ocultar si es Terreno --}}
                <div class="flex items-center gap-2">
                    <i class="fas fa-layer-group text-[#FF8A65] w-4 text-center"></i>
                    <span class="truncate">{{ $getCarac('niveles') ?? $prop->niveles ?? '—' }} Niveles</span>
                </div>
            @endif

        </div>

        {{-- PROCESAR DESCRIPCIÓN --}}
        @php
            $descripcionRaw = $prop->descripcion;
            if (is_array($descripcionRaw)) {
                $descripcionStr = $descripcionRaw[$currentLocale] ?? $descripcionRaw['es'] ?? (reset($descripcionRaw) ?: '');
            } else {
                $descripcionStr = (string) ($descripcionRaw ?? '');
            }
            $descripcionClean = strip_tags($descripcionStr);
        @endphp

        {{-- Descripción --}}
        <p class="text-gray-700 text-sm mb-4 line-clamp-3 leading-relaxed">
            {{ $descripcionClean !== '' ? $descripcionClean : 'Sin descripción disponible.' }}
        </p>

        {{-- Precio (Visible siempre abajo en grid/mobile) --}}
        <div class="text-2xl font-extrabold text-[#052669] mb-4 text-center" x-show="view === 'grid' || mobile">
            ${{ $precio }} <span class="text-sm font-semibold">{{ $moneda }}</span>
        </div>

        {{-- Separador --}}
        <div class="w-full h-px bg-gray-200 mb-4"></div>

        {{-- Footer de la tarjeta: Precio (vista lista desktop) + Botones --}}
        <div class="flex mt-auto items-center justify-between gap-4">
            
            {{-- Precio (Solo visible en List Desktop) --}}
            <div x-show="view === 'list' && !mobile" class="text-2xl font-extrabold text-[#052669] whitespace-nowrap">
                 ${{ $precio }} <span class="text-sm font-semibold">{{ $moneda }}</span>
            </div>

            {{-- Contenedor de botones --}}
            <div class="flex space-x-3 w-full" :class="(view === 'list' && !mobile) ? 'md:w-auto' : ''">

            {{-- Botón Ver más --}}
            @if(!empty($prop->slug))
            <a href="{{ route('propiedades.show', $prop->slug) }}"
            class="w-1/2 text-center bg-[#FF8A65] text-white px-5 py-3 rounded-md hover:bg-[#ff7043] transition font-semibold shadow flex items-center justify-center gap-2">
            <i class="fas fa-eye text-white"></i>
            <span>{{ $labels['btnLabelMasInformacion'] ?? 'Ver más' }}</span>
            </a>
            @endif

            {{-- Botón WhatsApp --}}
            <a href="https://wa.me/{{ $siteSettings->whatsapp }}?text={{ urlencode('Hola, me interesa la propiedad: ' . ($prop->nombre[$currentLocale] ?? 'Propiedad') . ' en ' . $nombreLoc) }}"
               target="_blank"
               class="w-1/2 text-center bg-[#25D366] text-white px-5 py-3 rounded-md hover:bg-[#128c7e] transition font-semibold flex items-center justify-center gap-2 shadow">
                <i class="fab fa-whatsapp text-white text-xl"></i>
                <span>WhatsApp</span>
            </a>

            </div>
        </div>
    </div>
</div>
