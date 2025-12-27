<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- 🔍 Formulario de filtros -->
    <div x-data="{ advanced: false, hasLocalidad: {{ $localidad ? 'true' : 'false' }}, hasTipo: {{ $tipoInmueble ? 'true' : 'false' }}, hasOperacion: {{ $tipoOperacion ? 'true' : 'false' }} }" class="bg-[#052669] rounded-lg p-6 mb-10 shadow-md">

        <!-- FORM PRINCIPAL -->
        <form wire:submit.prevent="$refresh" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">

            <!-- Localidad -->
            <div>
                <select wire:model.live="localidad" @change="if($event.target.value !== '') hasLocalidad = true"
                    class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                    placeholder-gray-500 focus:outline-none focus:ring-0
                    focus:border-transparent focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="" x-text="hasLocalidad ? 'Todas las Zonas' : 'Ciudad'">{{ $localidad ? 'Todas las Zonas' : 'Ciudad' }}</option>
                    @foreach($localidades as $loc)
                        @php $nombre = $loc->nombre[app()->getLocale()] ?? $loc->nombre['es'] ?? $loc->nombre; @endphp
                        <option value="{{ $loc->id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tipo -->
            <div>
                <select wire:model.live="tipoInmueble" @change="if($event.target.value !== '') hasTipo = true"
                    class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                    placeholder-gray-500 focus:outline-none focus:ring-0 
                    focus:border-transparent focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="" x-text="hasTipo ? 'Todas las propiedades' : 'Tipo de propiedad'">{{ $tipoInmueble ? 'Todas las propiedades' : 'Tipo de propiedad' }}</option>
                    @foreach($tiposInmueble as $tipo)
                        @php $nombre = $tipo->nombre[app()->getLocale()] ?? $tipo->nombre['es'] ?? $tipo->nombre; @endphp
                        <option value="{{ $tipo->id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Operación -->
            <div>
                <select wire:model.live="tipoOperacion" @change="if($event.target.value !== '') hasOperacion = true"
                    class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                    placeholder-gray-500 focus:outline-none focus:ring-0 
                    focus:border-transparent focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="" x-text="hasOperacion ? 'Todas las operaciones' : 'Operación'">{{ $tipoOperacion ? 'Todas las operaciones' : 'Operación' }}</option>
                    @foreach($tiposOperacion as $op)
                        @php $nombre = $op->nombre[app()->getLocale()] ?? $op->nombre['es'] ?? $op->nombre; @endphp
                        <option value="{{ $op->id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Rango de precios (Mapped to maxPrecio) -->
            <div>
                <select wire:model.live="maxPrecio"
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
                        <option value="{{ $valor }}">{{ $texto }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón Buscar -->
            <div class="flex">
                <button type="button" wire:click="$refresh"
                    class="w-full bg-[#FF8A65] hover:bg-[#ff7043] text-white 
                    p-3 rounded text-lg font-semibold shadow-md transition">
                    Buscar
                </button>
            </div>

            <!-- ===== Contenedor para link filtros avanzados (izq) + orden (derecha) ===== -->
            <div class="col-span-1 md:col-span-2 lg:col-span-5 flex justify-between items-center mt-2">

                <!-- Link filtros avanzados -->
                <button type="button"
                    @click="advanced = !advanced"
                    class="text-white underline text-sm hover:text-[#FF8A65] transition">
                    Filtros avanzados
                </button>

                <!-- Ordenamiento -->
                <select wire:model.live="orden"
                    class="bg-white border border-gray-300 rounded p-2 shadow-sm text-sm
                    focus:outline-none focus:ring-0 focus:border-transparent
                    focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    <option value="">Ordenar por</option>
                    <option value="precio_asc">Precio: menor a mayor</option>
                    <option value="precio_desc">Precio: mayor a menor</option>
                    <option value="recientes">Más recientes</option>
                </select>
            </div>

            <!-- ===== Filtros avanzados ===== -->
            <div x-show="advanced" x-transition class="col-span-1 md:col-span-2 lg:col-span-5 mt-4">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">

                    <!-- Precio Minimo (Exacto) -->
                    <input type="number" wire:model.live.debounce.500ms="minPrecio" placeholder="Precio Mínimo"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">
                    
                    <!-- Precio Maximo (Exacto - syncs with select) -->
                    <input type="number" wire:model.live.debounce.500ms="maxPrecio" placeholder="Precio Máximo"
                        class="w-full bg-white border border-gray-300 rounded p-3 shadow-sm
                        focus:outline-none focus:ring-0 focus:border-transparent
                        focus:shadow-[0_0_8px_rgba(255,138,101,0.6)]">

                    <!-- Placeholder inputs for future features (commented out or disabled) -->
                    {{-- 
                    <input type="number" placeholder="Baños" disabled title="Próximamente"
                        class="w-full bg-gray-100 border border-gray-300 rounded p-3 shadow-sm cursor-not-allowed">
                    
                    <input type="number" placeholder="Construcción (m²)" disabled title="Próximamente"
                        class="w-full bg-gray-100 border border-gray-300 rounded p-3 shadow-sm cursor-not-allowed">

                    <input type="number" placeholder="Terreno (m²)" disabled title="Próximamente"
                        class="w-full bg-gray-100 border border-gray-300 rounded p-3 shadow-sm cursor-not-allowed">
                    --}}
                    
                </div>
            </div>

        </form>

    </div>

    {{-- 🏡 Listado de propiedades estilo Blog --}}
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($propiedades as $prop)
            @php
                $tipo = $prop->tipoInmueble->nombre[app()->getLocale()] ?? $prop->tipoInmueble->nombre['es'] ?? $prop->tipoInmueble->nombre ?? 'Sin tipo';
                $loc = $prop->localidad->nombre[app()->getLocale()] ?? $prop->localidad->nombre['es'] ?? $prop->localidad->nombre ?? 'Sin localidad';
                
                $precio = number_format($prop->precio, 2);
                
                // Etiquetas simuladas
                $categories = [$tipo, $prop->tipoOperacion->nombre[app()->getLocale()] ?? $prop->tipoOperacion->nombre['es'] ?? 'Operación'];
                $tags = ['Destacado', 'Oportunidad'];
            @endphp

            <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">

                {{-- Imagen --}}
                <div class="relative h-64 w-full bg-gray-200 overflow-hidden group">
                    @if($prop->galerias->isNotEmpty() && $prop->galerias->first()->url_imagen)
                        <img 
                            src="{{ $prop->galerias->first()->url_imagen }}"
                            alt="{{ $tipo }}"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        {{-- Fallback oculto que se muestra si falla la carga --}}
                        <div class="hidden w-full h-full bg-[#101828] items-center justify-center transform group-hover:scale-105 transition duration-300 absolute top-0 left-0">
                            <i class="fas fa-home text-white text-5xl opacity-50"></i>
                        </div>
                    @else
                        {{-- Placeholder cuando no hay imagen --}}
                        <div class="w-full h-full bg-[#101828] flex items-center justify-center transform group-hover:scale-105 transition duration-300">
                            <i class="fas fa-home text-white text-5xl opacity-50"></i>
                        </div>
                    @endif

                    {{-- PRECIO --}}
                    <div class="absolute bottom-0 left-0">
                        <span style="background-color: rgba(255,255,255,0.8);"
                            class="text-black font-bold italic text-lg px-4 py-2 rounded-tr-md shadow">
                            ${{ $precio }}
                        </span>
                    </div>

                    {{-- ETIQUETAS --}}
                    <div class="absolute top-2 right-2 flex flex-wrap gap-2 justify-end">
                        @foreach($categories as $category)
                            <span class="bg-blue-600 text-white px-2 py-1 text-xs rounded shadow">
                                {{ $category }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">

                    {{-- Título --}}
                    <div class="mb-3">
                        <h2 class="text-xl font-bold text-gray-900 leading-tight flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-[#0AB3B6] text-lg"></i>
                            {{ $prop->nombre[app()->getLocale()] ?? $prop->nombre['es'] ?? $prop->nombre ?? 'Propiedad' }},
                            <span class="text-gray-600 font-normal">{{ $loc }}</span>
                        </h2>
                    </div>

                    <div class="w-full h-px bg-gray-200 my-3"></div>

                    {{-- Características --}}
                    <div class="grid grid-cols-2 gap-3 text-sm text-gray-700 mb-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-bed text-[#FF8A65]"></i>
                            <span>{{ $prop->recamaras ?? '—' }} Recámaras</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-bath text-[#FF8A65]"></i>
                            <span>{{ $prop->banos ?? '—' }} Baños</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-ruler-combined text-[#FF8A65]"></i>
                            <span>{{ $prop->metros_cuadrados ?? '—' }} m²</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-vector-square text-[#FF8A65]"></i>
                            <span>{{ $prop->terreno ?? '—' }} m² T.</span>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    @php
                        $descripcionRaw = $prop->descripcion;
                        $descripcionStr = is_array($descripcionRaw) ? ($descripcionRaw[app()->getLocale()] ?? $descripcionRaw['es'] ?? reset($descripcionRaw)) : $descripcionRaw;
                        $descripcionClean = strip_tags($descripcionStr ?? '');
                    @endphp
                    <p class="text-gray-700 text-sm mb-5 line-clamp-4 leading-relaxed">
                        {{ $descripcionClean ?: 'Sin descripción disponible.' }}
                    </p>

                    <div class="w-full h-px bg-gray-200 mb-4"></div>

                    {{-- Botones --}}
                    <div class="flex mt-auto space-x-3">
                        <a href="#" class="w-1/2 text-center bg-[#FF8A65] text-white px-5 py-3 rounded-md hover:bg-[#ff7043] transition font-semibold shadow">
                            Más información
                        </a>
                        <a href="https://wa.me/521000000000?text=Hola, me interesa esta propiedad" target="_blank" class="w-1/2 text-center bg-[#FF8A65] text-white px-5 py-3 rounded-md hover:bg-[#ff7043] transition font-semibold flex items-center justify-center gap-2 shadow">
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

    {{-- Paginación --}}
    <div class="mt-12 mb-24">
        {{ $propiedades->links() }}
    </div>
</div>
