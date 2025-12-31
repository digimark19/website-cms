<a id="listado"></a>
<div class="container mx-auto py-4 px-4" x-data="{ loading: false }">
    <!-- 🔍 Formulario de filtros -->
    <div x-data="{ advanced: @json(request()->has('advanced') ? true : false) }" class="bg-[#052669] rounded-lg p-4 mb-5 shadow-md relative">

        <!-- FORM PRINCIPAL -->
        <form id="filtrosForm" method="GET" action="{{ $action ?? '#listado' }}" @submit="loading = true" class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">

            <!-- Localidad -->
            <div>
                <select name="localidad"
                    class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                    placeholder-gray-500 focus:outline-none focus:ring-0
                    focus:border-transparent focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="">{{ $labels["inputLabelLocalidad"] ?? 'Localidad' }}</option>
                    @foreach($localidades as $loc)  
                        @php $nombre = $loc->nombre['es'] ?? $loc->nombre['es']; @endphp
                        <option value="{{ $loc->id }}" {{ request('localidad') == $loc->id ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tipo -->
            <div>
                <select name="tipo"
                    class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                    placeholder-gray-500 focus:outline-none focus:ring-0 
                    focus:border-transparent focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="">{{ $labels['inputLabelTipoPropiedad'] ?? 'Tipo de propiedad' }}</option>
                    @foreach($tiposInmueble as $tipo)
                        @php $nombre = $tipo->nombre['es'] ?? $tipo->nombre['es']; @endphp
                        <option value="{{ $tipo->id }}" {{ request('tipo') == $tipo->id ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Operación -->
            <div>
                <select name="operacion"
                    class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                    placeholder-gray-500 focus:outline-none focus:ring-0 
                    focus:border-transparent focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="">{{ $labels['inputLabelOperacion'] ?? 'Operación' }}</option>
                    @foreach($tiposOperacion as $op)
                        @php $nombre = $op->nombre['es'] ?? $op->nombre['es']; @endphp
                        <option value="{{ $op->id }}" {{ request('operacion') == $op->id ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Rango de precios -->
            <div>
                <select name="rango_precio"
                    class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                    placeholder-gray-500 focus:outline-none focus:ring-0 
                    focus:border-transparent focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">

                    <option value="">{{ $labels['inputLabelRangoPrecio'] ?? 'Rango de precio' }}</option>

                    @php
                        $rangos = [
                            500000 => 'Hasta $500,000',
                            1000000 => 'Hasta $1,000,000',
                            1500000 => 'Hasta $1,500,000',
                            2000000 => 'Hasta $2,000,000',
                            2500000 => 'Hasta $2,500,000',
                            3000000 => 'Hasta $3,000,000',
                            3500000 => 'Hasta $3,500,000',
                            4000000 => '$4,000,000 o más',
                        ];
                    @endphp

                    @foreach ($rangos as $valor => $texto)
                        <option value="{{ $valor }}" {{ (string)request('rango_precio') === (string)$valor ? 'selected' : '' }}>
                            {{ $texto }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botón Buscar -->
            <div class="flex">
                <button type="submit"
                    class="w-full bg-[#FF8A65] hover:bg-[#ff7043] text-white 
                    p-3 rounded text-lg font-semibold shadow-md transition">
                    {{ $labels['btnLabelBuscar'] ?? 'Buscar' }}
                </button>
            </div>

            @if($showResults)
            <!-- ===== Contenedor para link filtros avanzados (izq) + orden (derecha) ===== -->
            <!-- Ocupa toda la fila en lg: lo alineamos con justify-between -->
            <div class="col-span-2 md:col-span-2 lg:col-span-5 flex justify-between items-center mt-2">

                <!-- Link filtros avanzados (no submit) -->
                <button type="button"
                    @click="advanced = !advanced; $nextTick(()=> { if(advanced) { history.replaceState(null, '', updateQueryStringParameter(window.location.href, 'advanced', '1')) } else { history.replaceState(null, '', updateQueryStringParameter(window.location.href, 'advanced', null)) } })"
                    class="text-white underline text-sm hover:text-[#FF8A65] transition">
                    {{ $labels['labelFiltrosAvanzados'] ?? 'Filtros avanzados' }}
                </button>

                <!-- Ordenamiento (envía el form automáticamente) -->
                <select name="orden"
                    onchange="document.getElementById('filtrosForm').submit()"
                    class="bg-white border border-gray-300 rounded p-2 shadow-sm text-sm
                    focus:outline-none focus:ring-0 focus:border-transparent
                    focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="">{{ $labels['labelOrdenar'] ?? 'Ordenar por' }}</option>
                    <option value="precio_asc"  {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>{{ $labels['labelPriceMenorMayor'] ?? 'Precio: menor a mayor' }}</option>
                    <option value="precio_desc" {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>{{ $labels['labelPriceMayorMenor'] ?? 'Precio: mayor a menor' }}</option>
                    <option value="recientes"   {{ request('orden') == 'recientes' ? 'selected' : '' }}>{{ $labels['labelMasReciente'] ?? 'Más recientes' }}</option>
                </select>
            </div>

            <!-- ===== Filtros avanzados (ESTÁN DENTRO DEL FORM para que se envíen) ===== -->
            <div x-show="advanced" x-transition class="col-span-2 md:col-span-2 lg:col-span-5 mt-4">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">

                    <input type="number" name="banos" placeholder="{{ $labels['labelBanos'] ?? 'Baños' }}"
                        value="{{ request('banos') }}"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">

                    <input type="number" name="construccion" placeholder="{{ $labels['labelConstruccion'] ?? 'Construcción (m²)' }}"
                        value="{{ request('construccion') }}"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">

                    <input type="number" name="terreno" placeholder="{{ $labels['labelTerreno'] ?? 'Terreno (m²)' }}"
                        value="{{ request('terreno') }}"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">

                    <select name="estatus"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                        <option value="">{{ $labels['labelEstatus'] ?? 'Estatus' }}</option>
                        <option value="nuevo" {{ request('estatus') == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                        <option value="remodelado" {{ request('estatus') == 'remodelado' ? 'selected' : '' }}>Remodelado</option>
                    </select>

                    <!-- agrega aquí más filtros avanzados si los necesitas -->
                </div>
            </div>
            @endif

        </form>

        {{-- Loader overlay para homepage (pantalla completa) --}}
        @if(!$showResults)
        <div x-show="loading" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 bg-white/95 backdrop-blur-sm flex items-center justify-center z-50"
             style="display: none;">
            <div class="text-center">
                {{-- Animated house icon --}}
                <div class="relative w-24 h-24 mx-auto mb-6">
                    <div class="absolute inset-0 animate-ping">
                        <svg class="w-full h-full text-[#0AB3B6] opacity-75" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="relative">
                        <svg class="w-24 h-24 text-[#052669]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                </div>
                
                {{-- Loading text --}}
                <p class="text-xl font-semibold text-[#052669] mb-2">
                    Buscando propiedades...
                </p>
                <div class="flex items-center justify-center space-x-1">
                    <div class="w-2 h-2 bg-[#0AB3B6] rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                    <div class="w-2 h-2 bg-[#0AB3B6] rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                    <div class="w-2 h-2 bg-[#0AB3B6] rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                </div>
            </div>
        </div>
        @endif

    </div>

    <!-- pequeño helper JS para limpiar/añadir query param 'advanced' sin recargar -->
    <script>
    function updateQueryStringParameter(uri, key, value) {
        if (value === null || value === undefined) {
            // remove param
            var re = new RegExp("([?&])" + key + "=[^&]*(&?)", "i");
            uri = uri.replace(re, function(match, p1, p2) {
                return p2 ? p1 : '';
            });
            // fix trailing question mark
            uri = uri.replace(/\?$/, '');
            return uri;
        }

        var re = new RegExp("([?&])" + key + "=[^&]*", "i");
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value);
        } else {
            var sep = uri.indexOf('?') !== -1 ? '&' : '?';
            return uri + sep + key + "=" + value;
        }
    }
    </script>













    @if($showResults)
    {{-- 🏡 Listado de propiedades estilo Blog --}}
    <div>
        {{-- Loader para página de resultados (reemplaza la zona de resultados) --}}
        <div x-show="loading" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="bg-white/95 backdrop-blur-sm flex items-center justify-center min-h-[400px] rounded-lg"
             style="display: none;">
            <div class="text-center">
                {{-- Animated house icon --}}
                <div class="relative w-24 h-24 mx-auto mb-6">
                    <div class="absolute inset-0 animate-ping">
                        <svg class="w-full h-full text-[#0AB3B6] opacity-75" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="relative">
                        <svg class="w-24 h-24 text-[#052669]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                </div>
                
                {{-- Loading text --}}
                <p class="text-xl font-semibold text-[#052669] mb-2">
                    {{ $labels['labelBuscandoPropiedad'] ?? 'Buscando propiedades...' }}
                </p>
                <div class="flex items-center justify-center space-x-1">
                    <div class="w-2 h-2 bg-[#0AB3B6] rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                    <div class="w-2 h-2 bg-[#0AB3B6] rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                    <div class="w-2 h-2 bg-[#0AB3B6] rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                </div>
            </div>
        </div>

        <div x-show="!loading" class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($propiedades as $prop)
            @php
                $currentLocale = app()->getLocale();
                
                $tipo = $prop->tipoInmueble->nombre;
                $nombreTipo = $tipo[$currentLocale] ?? $tipo['es'] ?? 'Sin tipo';

                $loc = $prop->localidad->nombre;
                $nombreLoc = $loc[$currentLocale] ?? $loc['es'] ?? 'Sin localidad';

                // Imagen temporal de relleno si no existe
                $imagen = $prop->galerias->first()->url_imagen 
                    ?? "https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800";

                // Precio con moneda según idioma
                $precioData = $prop->precio[$currentLocale] ?? $prop->precio['es'] ?? ['precio' => 0, 'moneda' => 'MXN'];
                $precio = number_format($precioData['precio'], 2);
                $moneda = $precioData['moneda'];

                // Etiquetas simuladas
                $tipoOperacion = $prop->tipoOperacion->nombre[$currentLocale] ?? $prop->tipoOperacion->nombre['es'] ?? 'Operación';
                $tags = ['Destacado', 'Oportunidad'];
            @endphp

            <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">

                {{-- Imagen --}}
                <div class="relative h-64 w-full bg-gray-200 overflow-hidden">
                   @php
                        // Tipo de inmueble correcto
                        $tipoId = $prop->id_tipo_inmueble ?? null;

                        // Imágenes por ID de tipo de inmueble (URLs revisadas)
                        $imagenesPorTipo = [
                            1 => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=1600', // Casa
                            2 => 'https://images.unsplash.com/photo-1502673530728-f79b4cab31b1?w=1600', // Departamento
                            3 => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1600', // Terreno
                            4 => 'https://images.unsplash.com/photo-1529421308260-2f9a5d7c5a52?w=1600', // Local comercial (FIX)
                            5 => 'https://images.unsplash.com/photo-1505693421354-9aa0f0d5d21b?w=1600', // Desarrollo
                            6 => 'https://images.unsplash.com/photo-1505693421354-9aa0f0d5d21b?w=1600', // Desarrollo
                            7 => 'https://images.unsplash.com/photo-1502673530728-f79b4cab31b1?w=1600', // Departamento
                            8 => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=1600', // Casa
                            9 => 'https://images.unsplash.com/photo-1527030280862-64139fba04ca?w=1600', // Condominio
                            10 => 'https://images.unsplash.com/photo-1507089947368-19c1da9775ae?w=1600', // Villa
                        ];

                        // Imagen default (fallback seguro)
                        $imagenDefault = 'https://images.unsplash.com/photo-1502673530728-f79b4cab31b1?w=1600';

                        // Seleccionar imagen por tipo (si no existe, usar default)
                        $imagenTipo = $imagenesPorTipo[$tipoId] ?? $imagenDefault;

                        // Si la propiedad tiene fotos en BD, esas tienen prioridad
                        $imagen = $prop->galerias->first()->url_imagen ?? $imagenTipo;
                    @endphp




                    <img 
                        src="{{ $imagen }}"
                        alt="{{ $nombreTipo }}"
                        class="w-full h-full object-cover transform hover:scale-105 transition duration-300"
                    >

                    {{-- PRECIO (bg 80%, texto bold italic negro) - Fallback con estilo inline --}}
                    <div class="absolute bottom-0 left-0">
                        <span style="background-color: rgba(255,255,255,0.8);"
                            class="text-black font-bold italic text-lg px-4 py-2 rounded-tr-md shadow">
                            ${{ $precio }} {{ $moneda }}
                        </span>
                    </div>


                    {{-- ETIQUETAS Y CATEGORÍAS (superior derecha) --}}
                    <div class="absolute top-2 right-2 flex flex-wrap gap-2 justify-end">
                        
                        <span class="bg-[#FF8A65] text-white px-2 py-1 text-xs rounded shadow">
                            {{ $nombreTipo }}
                        </span>
                        <span class="bg-[#0AB3B6] text-white px-2 py-1 text-xs rounded shadow">
                            {{ $tipoOperacion }}
                        </span>

                        @foreach($tags as $tag)
                            <span class="bg-gray-300 text-gray-800 px-2 py-1 text-xs rounded shadow">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">

                    {{-- Título — Nombre + Localidad --}}
                    <div class="mb-3">
                        <h2 class="text-xl font-bold text-gray-900 leading-tight flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-[#0AB3B6] text-lg"></i>
                            {{ $prop->nombre[$currentLocale] ?? $prop->nombre ?? 'Propiedad' }},
                            <span class="text-gray-600 font-normal">{{ $nombreLoc }}</span>
                        </h2>
                    </div>

                    {{-- Línea divisoria --}}
                    <div class="w-full h-px bg-gray-200 my-3"></div>

                    {{-- Características más completas --}}
                    <div class="grid grid-cols-2 gap-3 text-sm text-gray-700 mb-4">

                        <div class="flex items-center gap-2">
                            <i class="fas fa-bed text-[#FF8A65]"></i>
                            <span>{{ $prop->recamaras }} {{ $labels["labelRecamara"]}}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-bath text-[#FF8A65]"></i>
                            <span>{{ $prop->banos }} {{ $labels["labelBanos"]}}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-ruler-combined text-[#FF8A65]"></i>
                            <span>{{ $prop->metros_cuadrados ?? '—' }} m² {{ $labels["labelConstruccionlbl"] }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-vector-square text-[#FF8A65]"></i>
                            <span>{{ $prop->terreno ?? '—' }} m² {{ $labels["labelTerreno"] }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-car text-[#FF8A65]"></i>
                            <span>{{ $prop->estacionamientos ?? '—' }} {{ $labels["labelEstacionamientos"] }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-layer-group text-[#FF8A65]"></i>
                            <span>{{ $prop->niveles ?? '—' }} {{ $labels["labelNiveles"] }}</span>
                        </div>

                    </div>

                    {{-- PROCESAR DESCRIPCIÓN --}}
                    @php
                        $descripcionRaw = $prop->descripcion;

                        if (is_array($descripcionRaw)) {
                            $descripcionStr = $descripcionRaw['es'] ?? (reset($descripcionRaw) ?: '');
                        } else {
                            $descripcionStr = (string) ($descripcionRaw ?? '');
                        }

                        $descripcionClean = strip_tags($descripcionStr);
                    @endphp

                    {{-- Descripción --}}
                    <p class="text-gray-700 text-sm mb-5 line-clamp-4 leading-relaxed">
                        {{ $descripcionClean !== '' ? $descripcionClean : 'Sin descripción disponible.' }}
                    </p>

                    {{-- Separador --}}
                    <div class="w-full h-px bg-gray-200 mb-4"></div>

                    {{-- Botones más grandes y menos redondeados --}}
                    <div class="flex mt-auto space-x-3">

                        {{-- Botón Ver más --}}
                        <a href="#"
                        class="w-1/2 text-center bg-[#FF8A65] text-white px-5 py-3 rounded-md hover:bg-[#ff7043] transition font-semibold shadow">
                        {{ $labels['btnLabelMasInformacion'] ?? 'Más información' }}
                        </a>

                        {{-- Botón WhatsApp (mismo color FF8A65) --}}
                        <a href="https://wa.me/521000000000?text=Hola, me interesa esta propiedad"
                        target="_blank"
                        class="w-1/2 text-center bg-[#FF8A65] text-white px-5 py-3 rounded-md hover:bg-[#ff7043] transition font-semibold flex items-center justify-center gap-2 shadow">

                            <i class="fab fa-whatsapp text-white text-xl"></i>
                            <span>WhatsApp</span>
                        </a>

                    </div>

                </div>







            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                {{ $labels['labelNoResultadoPropiedades'] ?? 'No se encontraron propiedades.' }}
            </div>
        @endforelse
    </div>



    {{-- 📄 Paginación con más espacio (Diseño Actualizado) --}}
    <div x-show="!loading" class="flex justify-center items-center space-x-2 mt-12 mb-24">

        {{-- Botón Anterior --}}
        @if ($propiedades->onFirstPage())
            <button class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl text-gray-400 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
        @else
            <a href="{{ $propiedades->previousPageUrl() }}" class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl hover:bg-gray-100 transition font-semibold">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
        @endif

        {{-- Números de página --}}
        @foreach ($propiedades->getUrlRange(1, $propiedades->lastPage()) as $page => $url)
            @if ($page == $propiedades->currentPage())
                <span class="w-12 h-12 flex items-center justify-center border border-blue-600 bg-blue-600 text-white rounded-xl font-semibold">
                    {{ $page }}
                </span>
            @elseif($page == 1 || $page == $propiedades->lastPage() || ($page >= $propiedades->currentPage() - 1 && $page <= $propiedades->currentPage() + 1))
                <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl hover:bg-gray-100 transition font-semibold">
                    {{ $page }}
                </a>
            @elseif($page == 2 && $propiedades->currentPage() > 4)
                <span class="px-2 text-gray-500">...</span>
            @elseif($page == $propiedades->lastPage() - 1 && $propiedades->currentPage() < $propiedades->lastPage() - 3)
                <span class="px-2 text-gray-500">...</span>
            @endif
        @endforeach

        {{-- Botón Siguiente --}}
        @if ($propiedades->hasMorePages())
            <a href="{{ $propiedades->nextPageUrl() }}" class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl hover:bg-gray-100 transition font-semibold">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        @else
            <button class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl text-gray-400 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif

        </div>
    </div>
    @endif

</div>
