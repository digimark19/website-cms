<a id="listado"></a>
<div class="container mx-auto py-10 px-4">
    <!-- 🔍 Formulario de filtros -->
    <div x-data="{ advanced: @json(request()->has('advanced') ? true : false) }" class="bg-[#052669] rounded-lg p-6 mb-10 shadow-md">

        <!-- FORM PRINCIPAL -->
        <form id="filtrosForm" method="GET" action="#listado" class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">

            <!-- Localidad -->
            <div>
                <select name="localidad"
                    class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                    placeholder-gray-500 focus:outline-none focus:ring-0
                    focus:border-transparent focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="">Localidad</option>
                    @foreach($localidades as $loc)
                        @php $nombre = json_decode($loc->nombre, true)['es'] ?? $loc->nombre; @endphp
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
                    <option value="">Tipo de propiedad</option>
                    @foreach($tiposInmueble as $tipo)
                        @php $nombre = json_decode($tipo->nombre, true)['es'] ?? $tipo->nombre; @endphp
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
                    <option value="">Operación</option>
                    @foreach($tiposOperacion as $op)
                        @php $nombre = json_decode($op->nombre, true)['es'] ?? $op->nombre; @endphp
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

                    <option value="">Rango de precio</option>

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
                    Buscar
                </button>
            </div>

            <!-- ===== Contenedor para link filtros avanzados (izq) + orden (derecha) ===== -->
            <!-- Ocupa toda la fila en lg: lo alineamos con justify-between -->
            <div class="col-span-2 md:col-span-2 lg:col-span-5 flex justify-between items-center mt-2">

                <!-- Link filtros avanzados (no submit) -->
                <button type="button"
                    @click="advanced = !advanced; $nextTick(()=> { if(advanced) { history.replaceState(null, '', updateQueryStringParameter(window.location.href, 'advanced', '1')) } else { history.replaceState(null, '', updateQueryStringParameter(window.location.href, 'advanced', null)) } })"
                    class="text-white underline text-sm hover:text-[#FF8A65] transition">
                    Filtros avanzados
                </button>

                <!-- Ordenamiento (envía el form automáticamente) -->
                <select name="orden"
                    onchange="document.getElementById('filtrosForm').submit()"
                    class="bg-white border border-gray-300 rounded p-2 shadow-sm text-sm
                    focus:outline-none focus:ring-0 focus:border-transparent
                    focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="">Ordenar por</option>
                    <option value="precio_asc"  {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>Precio: menor a mayor</option>
                    <option value="precio_desc" {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                    <option value="recientes"   {{ request('orden') == 'recientes' ? 'selected' : '' }}>Más recientes</option>
                </select>
            </div>

            <!-- ===== Filtros avanzados (ESTÁN DENTRO DEL FORM para que se envíen) ===== -->
            <div x-show="advanced" x-transition class="col-span-2 md:col-span-2 lg:col-span-5 mt-4">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">

                    <input type="number" name="banos" placeholder="Baños"
                        value="{{ request('banos') }}"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">

                    <input type="number" name="construccion" placeholder="Construcción (m²)"
                        value="{{ request('construccion') }}"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">

                    <input type="number" name="terreno" placeholder="Terreno (m²)"
                        value="{{ request('terreno') }}"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">

                    <select name="estatus"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                        <option value="">Estatus</option>
                        <option value="nuevo" {{ request('estatus') == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                        <option value="remodelado" {{ request('estatus') == 'remodelado' ? 'selected' : '' }}>Remodelado</option>
                    </select>

                    <!-- agrega aquí más filtros avanzados si los necesitas -->
                </div>
            </div>

        </form>

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













    {{-- 🏡 Listado de propiedades estilo Blog --}}
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($propiedades as $prop)
            @php
                $tipo = json_decode($prop->tipoInmueble->nombre ?? '{}', true);
                $nombreTipo = $tipo['es'] ?? 'Sin tipo';

                $loc = json_decode($prop->localidad->nombre ?? '{}', true);
                $nombreLoc = $loc['es'] ?? 'Sin localidad';

                // Imagen temporal de relleno si no existe
                $imagen = $prop->galerias->first()->url_imagen 
                    ?? "https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800";

                $precio = number_format($prop->precio, 2);

                // Etiquetas simuladas
                $categories = [$nombreTipo, $prop->tipoOperacion->nombre['es'] ?? 'Operación'];
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
                            ${{ $precio }}
                        </span>
                    </div>


                    {{-- ETIQUETAS Y CATEGORÍAS (superior derecha) --}}
                    <div class="absolute top-2 right-2 flex flex-wrap gap-2 justify-end">
                        @foreach($categories as $category)
                            <span class="bg-blue-600 text-white px-2 py-1 text-xs rounded shadow">
                                {{ $category }}
                            </span>
                        @endforeach

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
                            {{ $prop->nombre['es'] ?? $prop->nombre ?? 'Propiedad' }},
                            <span class="text-gray-600 font-normal">{{ $nombreLoc }}</span>
                        </h2>
                    </div>

                    {{-- Línea divisoria --}}
                    <div class="w-full h-px bg-gray-200 my-3"></div>

                    {{-- Características más completas --}}
                    <div class="grid grid-cols-2 gap-3 text-sm text-gray-700 mb-4">

                        <div class="flex items-center gap-2">
                            <i class="fas fa-bed text-[#FF8A65]"></i>
                            <span>{{ $prop->recamaras }} Recámaras</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-bath text-[#FF8A65]"></i>
                            <span>{{ $prop->banos }} Baños</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-ruler-combined text-[#FF8A65]"></i>
                            <span>{{ $prop->metros_cuadrados ?? '—' }} m² construcción</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-vector-square text-[#FF8A65]"></i>
                            <span>{{ $prop->terreno ?? '—' }} m² terreno</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-car text-[#FF8A65]"></i>
                            <span>{{ $prop->estacionamientos ?? '—' }} Estacionamientos</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-layer-group text-[#FF8A65]"></i>
                            <span>{{ $prop->niveles ?? '—' }} Niveles</span>
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
                        Mas información
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
                No se encontraron propiedades.
            </div>
        @endforelse
    </div>



    {{-- 📄 Paginación con más espacio (Diseño Actualizado) --}}
    <div class="flex justify-center items-center space-x-2 mt-12 mb-24">

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
