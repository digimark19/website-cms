<!-- Sección Testimonios -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Encabezado -->
        <div class="text-center mb-12">
            @if(!empty($content['titulo']))
                <h2 class="text-3xl font-bold text-gray-800 mb-4">{{$content['titulo']}}</h2>
            @endif
            @if(!empty($content['subtitulo']))
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">{{$content['subtitulo']}}</p>
            @endif
        </div>

        @if(!empty($content['testimonials']))
        <!-- Grid de Testimonios -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 md:gap-12 mb-32 relative sm:gap-y-40">
            @foreach($content['testimonials'] as $card)
            <div class="relative bg-white p-6 sm:p-8 md:pt-12 pt-8 flex flex-col justify-between mb-20 sm:mb-0"
                 style="border-radius: 64px 64px 0 64px; box-shadow: 0 8px 30px #F3F3F3;">

                <!-- Marca de agua de comillas (FontAwesome) grande, rotada y transparente -->
                <i class="fas fa-quote-left absolute right-0 top-1/2 transform -translate-y-1/2 rotate-180 text-black text-[14rem]" style="z-index:0; opacity:0.03;"></i>

                <!-- Número en círculo -->
                <div class="absolute -top-6 sm:-top-8 left-1/2 transform -translate-x-1/2 w-9 sm:w-10 h-9 sm:h-10 flex items-center justify-center rounded-full z-10"
                    style="background: linear-gradient(135deg, #FF8A65, #FF5A5F);">
                    <i class="fas fa-quote-left absolute text-black opacity-20 text-2xl sm:text-3xl transform rotate-180"></i>
                    <span class="text-white font-bold text-2xl sm:text-3xl relative z-10">{{ $loop->iteration }}</span>
                </div>

                <!-- Descripción -->
                <p class="text-gray-700 mb-16 line-clamp-4">
                    {{ $card['descripcion'] }}
                </p>

                <!-- Avatar con fondo blanco reducido, línea punteada y avatar encima -->
                <div class="absolute -bottom-14 sm:-bottom-16 left-1/2 transform -translate-x-1/2">
                    <div class="relative flex items-center justify-center w-36 h-36">
                        <div class="absolute w-32 h-32 bg-white rounded-full z-10"
                             style="box-shadow: 0 4px 16px 4px rgba(193,193,193,0.25);"></div>
                        <div class="absolute w-28 h-28 rounded-full border-2 border-dashed flex items-center justify-center"
                             style="border-color: #FF8A65; z-index:20;"></div>
                        <div class="relative w-20 h-20 rounded-full overflow-hidden z-30">
                            @if(!empty($card['avatar']))
                                <img src="{{ $card['avatar'] }}" alt="{{ $card['name'] }}" class="w-full h-full rounded-full object-cover shadow-md">
                            @else
                                <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-3xl sm:text-4xl shadow-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Nombre del autor -->
                <h4 class="absolute -bottom-6 sm:-bottom-8 left-1/2 transform -translate-x-1/2 text-center font-semibold text-gray-800 text-base sm:text-lg">
                    {{ $card['name'] }}
                </h4>

            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
