<!-- Sección Lotes -->
<section class="py-16 bg-gradient-to-br from-blue-50 to-green-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- CONTENIDO TEXTO -->
            <div class="space-y-6">

                <!-- Badge -->
                @if(!empty($content['badge']))
                    <div class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium mb-4">
                        {{ $content['badge'] }}
                    </div>
                @endif

                <!-- Título -->
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 leading-tight">
                    {{ $content['titulo'] ?? '' }}
                </h1>

                <!-- Descripción -->
                <p class="text-lg text-gray-600 leading-relaxed">
                    {{ $content['descripcion'] ?? '' }}
                </p>

                <!-- Botones -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    @if(!empty($content['boton_principal']))
                        <a href="{{ $content['boton_principal']['url'] ?? '#' }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition duration-300 transform hover:scale-105">
                            {{ $content['boton_principal'] }}
                        </a>
                    @endif

                    @if(!empty($content['boton_secundario']))
                        <a href="{{ $content['boton_secundario']['url'] ?? '#' }}"
                           class="border-2 border-gray-300 hover:border-blue-600 text-gray-700 hover:text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg transition duration-300">
                            {{ $content['boton_secundario'] }}
                        </a>
                    @endif
                </div>

                @php
                    // Gradientes elegantes para alternar si el JSON no trae color
                    $gradients = [
                        'from-blue-400 to-blue-600',
                        'from-green-400 to-green-600',
                        'from-purple-400 to-purple-600',
                        'from-pink-400 to-pink-600',
                        'from-yellow-400 to-orange-500'
                    ];
                @endphp

                <!-- CARACTERÍSTICAS SIN TARJETA -->
                @if(!empty($content['tarjetas']) && is_array($content['tarjetas']))
                    <div class="grid grid-cols-2 gap-6 pt-10">

                        @foreach($content['tarjetas'] as $index => $feature)

                            @php
                                $color = $feature['color'] ?? $gradients[$index % count($gradients)];
                            @endphp

                            <div class="flex items-center gap-4">

                                <!-- ÍCONO CON FONDO GRADIENTE -->
                                <div class="flex items-center justify-center
                                            w-12 h-12 rounded-full 
                                            bg-gradient-to-br {{ $color }}
                                            shadow-md transition-transform duration-300 hover:scale-110">

                                    <i class="{{ $feature['icono'] ?? 'fas fa-star' }}
                                            text-white text-xl leading-none"></i>
                                </div>

                                <!-- TEXTO -->
                                <div>
                                    <p class="text-base font-semibold text-gray-800">
                                        {{ $feature['titulo'] }}
                                    </p>

                                    @if(!empty($feature['descripcion']))
                                        <p class="text-sm text-gray-500 leading-snug">
                                            {{ $feature['descripcion'] }}
                                        </p>
                                    @endif
                                </div>

                            </div>

                        @endforeach

                    </div>
                @endif


            </div>


            <!-- IMAGEN / VISUAL -->
            <div class="relative">
                <div class="bg-white rounded-2xl shadow-2xl p-6 transform rotate-2 hover:rotate-0 transition duration-500">

                    <!-- IMAGEN -->
                    <div class="aspect-w-16 aspect-h-12 bg-gradient-to-br from-blue-400 to-green-400 rounded-xl overflow-hidden">
                        <div class="w-full h-80 bg-gradient-to-br from-blue-400 to-green-400 rounded-xl flex items-center justify-center">
                            <div class="text-center text-white">
                                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>

                                <p class="text-xl font-semibold">
                                    {{ $content['image_preview_title'] ?? 'Vista Previa' }}
                                </p>

                                <p class="text-sm opacity-90">
                                    {{ $content['imagen'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- STATS -->
                    @if(!empty($content['stats']) && is_array($content['stats']))
                        <div class="grid grid-cols-3 gap-4 mt-6">
                            @foreach($content['stats'] as $stat)
                                <div class="text-center">
                                    <div class="text-2xl font-bold {{ $stat['color'] ?? 'text-blue-600' }}">
                                        {{ $stat['valor'] }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        {{ $stat['texto'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>

                <!-- DECORACIÓN -->
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full opacity-20 animate-pulse"></div>
                <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-blue-400 rounded-full opacity-20 animate-pulse delay-1000"></div>
            </div>

        </div>
    </div>
</section>
