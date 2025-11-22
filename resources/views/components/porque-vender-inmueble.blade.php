<div class="w-full py-20" style="background-color: #F5F5F5;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ⭐ TÍTULO CENTRADO --}}
        @if(!empty($content['titulo']))
            <h2 class="text-4xl font-bold text-center mb-16" style="font-family: Rubik; color:#333;">
                {{ $content['titulo'] }}
            </h2>
        @endif

        {{-- 🔳 TRES COLUMNAS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16">

            {{-- 🔹 ITEM 1 --}}
            <div class="text-center flex flex-col items-center px-4">

                <div class="w-20 h-20 rounded-full flex items-center justify-center mb-6 shadow-sm"
                     style="background-color: #FFE1D8;">
                    <i class="fa-solid {{ $content['col1_icono'] ?? 'fa-circle-info' }} text-4xl"
                       style="color:#FF8A65;"></i>
                </div>

                <h3 class="text-xl font-semibold mb-3 text-center" 
                    style="font-family: Rubik; color:#0AB3B6;">
                    {{ $content['col1_titulo'] ?? 'Título 1' }}
                </h3>

                <p class="text-gray-700 text-base leading-relaxed text-center" style="font-family: Rubik;">
                    {{ $content['col1_texto'] ?? 'Descripción del punto número uno.' }}
                </p>
            </div>

            {{-- 🔹 ITEM 2 --}}
            <div class="text-center flex flex-col items-center px-4">

                <div class="w-20 h-20 rounded-full flex items-center justify-center mb-6 shadow-sm"
                     style="background-color: #FFE1D8;">
                    <i class="fa-solid {{ $content['col2_icono'] ?? 'fa-circle-info' }} text-4xl"
                       style="color:#FF8A65;"></i>
                </div>

                <h3 class="text-xl font-semibold mb-3 text-center"
                    style="font-family: Rubik; color:#0AB3B6;">
                    {{ $content['col2_titulo'] ?? 'Título 2' }}
                </h3>

                <p class="text-gray-700 text-base leading-relaxed text-center" style="font-family: Rubik;">
                    {{ $content['col2_texto'] ?? 'Descripción del punto número dos.' }}
                </p>
            </div>

            {{-- 🔹 ITEM 3 --}}
            <div class="text-center flex flex-col items-center px-4">

                <div class="w-20 h-20 rounded-full flex items-center justify-center mb-6 shadow-sm"
                     style="background-color: #FFE1D8;">
                    <i class="fa-solid {{ $content['col3_icono'] ?? 'fa-circle-info' }} text-4xl"
                       style="color:#FF8A65;"></i>
                </div>

                <h3 class="text-xl font-semibold mb-3 text-center"
                    style="font-family: Rubik; color:#0AB3B6;">
                    {{ $content['col3_titulo'] ?? 'Título 3' }}
                </h3>

                <p class="text-gray-700 text-base leading-relaxed text-center" style="font-family: Rubik;">
                    {{ $content['col3_texto'] ?? 'Descripción del punto número tres.' }}
                </p>
            </div>

        </div>

    </div>
</div>
