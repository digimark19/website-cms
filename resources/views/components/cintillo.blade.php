<!-- Sección Alianzas Comerciales --> 
<section class="py-24 bg-gray-100 relative overflow-hidden font-['Rubik']">
    {{-- Decorative background element removed for a cleaner look as requested --}}

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        
        <!-- Section Header (Same style as Services) -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <span class="inline-block px-4 py-1.5 rounded-full bg-[#FF8A65]/10 text-[#FF8A65] text-xs font-bold uppercase tracking-widest mb-4">
                {{ $content['titulo_pequeno'] ?? 'Alianzas' }}
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-[#052669] leading-tight font-['Rubik']">
                {{ $content['titulo'] ?? 'Nuestras Alianzas Comerciales' }}
            </h2>
            <div class="w-20 h-1.5 bg-[#0AB3B6] mx-auto mt-6 rounded-full"></div>
        </div>

        @php
            $logos = $content['alliances'] ?? [];
            
            // Modern, clean sample logos for real estate
            if (empty($logos)) {
                $logos = [
                    ['name' => 'Home Finder', 'img' => 'https://img.freepik.com/vector-gratis/diseno-logotipo-hogar-propiedades_23-2148962649.jpg'],
                    ['name' => 'City Real Estate', 'img' => 'https://img.freepik.com/vector-gratis/logotipo-casa-inmobiliaria-diseno-moderno_1017-31580.jpg'],
                    ['name' => 'Prime Properties', 'img' => 'https://img.freepik.com/vector-gratis/logotipo-inmobiliaria-estilo-elegante_23-2148651833.jpg'],
                    ['name' => 'Urban Living', 'img' => 'https://img.freepik.com/vector-gratis/logotipo-inmobiliaria-formas-geometricas_23-2148644557.jpg'],
                    ['name' => 'Dream House', 'img' => 'https://img.freepik.com/vector-gratis/logotipo-inmobiliaria-estilo-minimalista_23-2148659632.jpg'],
                    ['name' => 'Luxury Estates', 'img' => 'https://img.freepik.com/vector-gratis/logotipo-inmobiliaria-detalles-dorados_23-2148663458.jpg'],
                ];
            }

            // Triple the list for smooth infinite marquee
            $displayLogos = array_merge($logos, $logos, $logos);
            $defaultLogo = "https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=200&h=100&fit=crop&q=80"; // Subtle house image as default
        @endphp

        <div class="relative overflow-hidden group py-10">
            <!-- Infinite Slider -->
            <div class="flex animate-marquee items-center gap-20">
                @foreach($displayLogos as $alliance)
                <div class="flex-shrink-0 w-40 md:w-56 h-28 flex items-center justify-center grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-500 transform hover:scale-105">
                    @php
                        $imgSrc = $alliance['img'] ?? null;
                        if (isset($alliance['imgLogo'])) {
                            // Check if it's a full URL or just a filename
                            $imgSrc = (strpos($alliance['imgLogo'], 'http') === 0) 
                                ? $alliance['imgLogo'] 
                                : asset('storage/images/logos/'.$alliance['imgLogo']);
                        }
                    @endphp

                    <img src="{{ $imgSrc ?: $defaultLogo }}" 
                            alt="{{ $alliance['name'] ?? 'Alianza' }}" 
                            onerror="this.onerror=null; this.src='{{ $defaultLogo }}';"
                            class="max-w-full max-h-full object-contain drop-shadow-sm">
                </div>
                @endforeach
            </div>

            <!-- Side Gradients (Deeper for better blending) -->
            <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-gray-100 via-gray-100/80 to-transparent pointer-events-none z-10"></div>
            <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-gray-100 via-gray-100/80 to-transparent pointer-events-none z-10"></div>
        </div>
    </div>
    </div>

    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-100% / 3)); }
        }

        .animate-marquee {
            animation: marquee 40s linear infinite;
        }

        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>
</section>

@once
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@endonce
