<!-- Sección Alianzas Comerciales --> 
<section class="py-12 bg-gray-100 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Título -->
        @if(!empty($content['titulo']))
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">{{ $content['titulo'] }}</h2>
        @endif

        @if(count($content['alliances']) > 0)
        <div class="relative overflow-hidden">
            <!-- Difuminado lateral -->
            <div class="absolute top-0 left-0 w-24 h-full bg-gradient-to-r from-gray-100 to-transparent pointer-events-none z-10"></div>
            <div class="absolute top-0 right-0 w-24 h-full bg-gradient-to-l from-gray-100 to-transparent pointer-events-none z-10"></div>

            <!-- Slider infinito -->
            <div class="flex animate-marquee gap-6">
                @php
                    $logos = $content['alliances'];
                    // Si hay menos de 6 logos, duplicar para llenar
                    while(count($logos) < 6){
                        $logos = array_merge($logos, $content['alliances']);
                    }
                    // Duplicar otra vez para efecto infinito
                    $logos = array_merge($logos, $logos);
                @endphp

                @foreach($logos as $alliance)
                <a href="{{ $alliance['url'] ?? '#' }}" target="_blank" class="flex items-center justify-center flex-shrink-0 logo-wrapper">
                    @if(!empty($alliance['imgLogo']) && file_exists(public_path('storage/images/logos/'.$alliance['imgLogo'])))
                        <img src="{{ asset('storage/images/logos/'.$alliance['imgLogo']) }}" 
                             alt="{{ $alliance['name'] ?? '' }}" 
                             title="{{ $alliance['name'] ?? '' }}" 
                             class="logo-img object-contain">
                    @else
                        <i class="fa-solid fa-building text-gray-400 logo-img" title="{{ $alliance['name'] ?? '' }}"></i>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <style>
        /* Marquee infinito */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .animate-marquee {
            display: flex;
            gap: 2rem;
            animation: marquee 30s linear infinite;
        }

        .animate-marquee:hover {
            animation-play-state: paused;
        }

        /* Tamaño adaptado para 6 logos visibles */
        .logo-wrapper {
            width: calc((100% - (5 * 2rem)) / 6); /* 6 logos visibles */
            height: 100px; /* fijo, se puede ajustar */
        }

        .logo-img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</section>
