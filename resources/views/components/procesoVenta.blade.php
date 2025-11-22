<div class="w-full py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- TÍTULO --}}
        @if(!empty($content['titulo']))
            <h2 class="text-3xl text-center mb-4"
                style="font-family: Rubik; color:#333; font-weight:400;">
                {{ $content['titulo'] }}
            </h2>
        @endif

        {{-- SUBTÍTULO --}}
        @if(!empty($content['subtitulo']))
            <p class="text-lg text-center mb-14"
               style="font-family: Rubik; color:#666;">
                {{ $content['subtitulo'] }}
            </p>
        @endif

        {{-- TARJETAS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            {{-- TARJETA 1 --}}
            <div class="bg-white rounded-xl p-6 relative pt-14 text-center shadow-lg hover:shadow-xl transition">

                {{-- Círculo --}}
                <div class="absolute -top-5 left-1/2 -translate-x-1/2
                            w-10 h-10 rounded-full flex items-center justify-center
                            text-white font-bold text-sm overflow-hidden
                            bg-gradient-to-br from-[#FF8A65] to-[#FF5A5F]">

                    {{-- Marca de agua --}}
                    <span class="absolute text-[28px] opacity-20 font-bold select-none leading-none"
                          style="color:#111;">
                        “
                    </span>

                    {{-- Número --}}
                    <span class="relative z-10 text-lg" style="font-size:1.25rem;">
                        {{ $content['col1_numero'] }}
                    </span>
                </div>

                {{-- Título --}}
                <h3 class="text-xl mb-4 mt-2"
                    style="font-family: Rubik; color:#333; font-weight:400;">
                    {{ $content['col1_titulo'] }}
                </h3>

                {{-- Icono placeholder --}}
                <div class="flex justify-center mb-4 opacity-70">
                    <i class="fa-solid fa-image-slash text-4xl text-gray-400"></i>
                </div>

            </div>

            {{-- TARJETA 2 --}}
            <div class="bg-white rounded-xl p-6 relative pt-14 text-center shadow-lg hover:shadow-xl transition">

                <div class="absolute -top-5 left-1/2 -translate-x-1/2
                            w-10 h-10 rounded-full flex items-center justify-center
                            text-white font-bold text-sm overflow-hidden
                            bg-gradient-to-br from-[#FF8A65] to-[#FF5A5F]">

                    <span class="absolute text-[28px] opacity-20 font-bold select-none leading-none"
                          style="color:#111;">
                        “
                    </span>

                    <span class="relative z-10 text-lg" style="font-size:1.25rem;">
                        {{ $content['col2_numero'] }}
                    </span>
                </div>

                <h3 class="text-xl mb-4 mt-2"
                    style="font-family: Rubik; color:#333; font-weight:400;">
                    {{ $content['col2_titulo'] }}
                </h3>

                <div class="flex justify-center mb-4 opacity-70">
                    <i class="fa-solid fa-image-slash text-4xl text-gray-400"></i>
                </div>

            </div>

            {{-- TARJETA 3 --}}
            <div class="bg-white rounded-xl p-6 relative pt-14 text-center shadow-lg hover:shadow-xl transition">

                <div class="absolute -top-5 left-1/2 -translate-x-1/2
                            w-10 h-10 rounded-full flex items-center justify-center
                            text-white font-bold text-sm overflow-hidden
                            bg-gradient-to-br from-[#FF8A65] to-[#FF5A5F]">

                    <span class="absolute text-[28px] opacity-20 font-bold select-none leading-none"
                          style="color:#111;">
                        “
                    </span>

                    <span class="relative z-10 text-lg" style="font-size:1.25rem;">
                        {{ $content['col3_numero'] }}
                    </span>
                </div>

                <h3 class="text-xl mb-4 mt-2"
                    style="font-family: Rubik; color:#333; font-weight:400;">
                    {{ $content['col3_titulo'] }}
                </h3>

                <div class="flex justify-center mb-4 opacity-70">
                    <i class="fa-solid fa-image-slash text-4xl text-gray-400"></i>
                </div>

            </div>

        </div>

    </div>
</div>
