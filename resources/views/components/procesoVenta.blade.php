<div class="w-full py-16 bg-white font-rubik overflow-hidden relative">
    
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 left-0 w-full h-1/2 bg-gray-50 -skew-y-3 origin-top-left -z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- HEADLINE --}}
        <div class="text-center mb-16 max-w-3xl mx-auto">
            @if(!empty($content['titulo']))
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">
                    {{ $content['titulo'] }}
                </h2>
            @endif
            
            @if(!empty($content['subtitulo']))
                <p class="text-xl text-gray-500 leading-relaxed font-light">
                    {{ $content['subtitulo'] }}
                </p>
            @endif
            
            <div class="w-24 h-1.5 bg-[#FF8A65] mx-auto mt-6 rounded-full"></div>
        </div>

        {{-- GRID CONTAINER (1 Col Mobile, 3 Cols Desktop) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-8 items-end">

            {{-- STEP 1: VALUATION --}}
            <div class="flex flex-col items-center relative group">
                 {{-- Number Background --}}
                <span class="text-[10rem] font-black text-[#FF8A65]/5 leading-none absolute -top-20 z-0 select-none">
                    {{ $content['col1_numero'] ?? '01' }}
                </span>
                
                <div class="relative z-10 w-full flex flex-col items-center">
                    {{-- Icon --}}
                    <div class="w-16 h-16 rounded-2xl bg-[#0AB3B6]/10 flex items-center justify-center text-[#0AB3B6] text-3xl mb-6 transform group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fas fa-search-location"></i>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-2xl font-bold text-gray-900 text-center leading-tight min-h-[3rem] px-4">
                        {{ $content['col1_titulo'] ?? '1. Valoración de Mercado Precisa' }}
                    </h3>

                    {{-- Illustration --}}
                    <div class="w-full h-56 flex items-center justify-center bg-transparent mt-2">
                        <svg class="w-full h-full drop-shadow-xl" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- House -->
                            <path d="M40 100 L90 50 L140 100 V180 H40 V100 Z" fill="#FFFFFF" stroke="#D1D5DB" stroke-width="2"/>
                            <rect x="70" y="120" width="40" height="60" fill="#F3F4F6" stroke="#D1D5DB" stroke-width="2"/>
                            <rect x="55" y="105" width="20" height="20" fill="#E0F2F1" stroke="#D1D5DB"/>
                            <rect x="105" y="105" width="20" height="20" fill="#E0F2F1" stroke="#D1D5DB"/>
                            <path d="M35 100 L90 45 L145 100" stroke="#FF8A65" stroke-width="4" stroke-linecap="round"/>

                            <!-- Agent Character -->
                            <g transform="translate(160, 60)">
                                <circle cx="20" cy="20" r="14" fill="#FFCCBC"/> 
                                <path d="M6 18 C6 10 12 5 20 5 C28 5 34 10 34 18 V22 H6 V18 Z" fill="#4B5563"/>
                                <path d="M5 45 Q5 35 20 35 Q35 35 35 45 V100 H5 V45 Z" fill="#0AB3B6"/>
                                <path d="M20 35 V100" stroke="#06989B" stroke-width="1"/>
                                <path d="M35 50 L55 65" stroke="#0AB3B6" stroke-width="6" stroke-linecap="round"/>
                                <circle cx="55" cy="65" r="4" fill="#FFCCBC"/>
                            </g>

                            <!-- Tablet -->
                            <g transform="translate(200, 110) rotate(-10)">
                                <rect x="0" y="0" width="40" height="50" rx="4" fill="#374151"/>
                                <rect x="3" y="3" width="34" height="44" rx="2" fill="white"/>
                                <path d="M8 35 L15 25 L22 30 L32 15" stroke="#FF8A65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="8" y="10" width="10" height="2" fill="#D1D5DB"/>
                                <rect x="8" y="15" width="15" height="2" fill="#D1D5DB"/>
                            </g>
                            
                            <!-- Checkmarks -->
                            <circle cx="150" cy="50" r="10" fill="white" stroke="#0AB3B6" stroke-width="2"/>
                            <path d="M146 50 L149 53 L154 47" stroke="#0AB3B6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="260" cy="80" r="10" fill="white" stroke="#0AB3B6" stroke-width="2"/>
                            <path d="M256 80 L259 83 L264 77" stroke="#0AB3B6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- STEP 2: MARKETING --}}
            <div class="flex flex-col items-center relative group">
                 {{-- Number Background --}}
                <span class="text-[10rem] font-black text-[#FF8A65]/5 leading-none absolute -top-20 z-0 select-none">
                    {{ $content['col2_numero'] ?? '02' }}
                </span>
                
                <div class="relative z-10 w-full flex flex-col items-center">
                    {{-- Icon --}}
                    <div class="w-16 h-16 rounded-2xl bg-[#0AB3B6]/10 flex items-center justify-center text-[#0AB3B6] text-3xl mb-6 transform group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fas fa-bullhorn"></i>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-2xl font-bold text-gray-900 text-center leading-tight min-h-[3rem] px-4">
                        {{ $content['col2_titulo'] ?? '2. Marketing Digital Masivo' }}
                    </h3>

                    {{-- Illustration --}}
                    <div class="w-full h-56 flex items-center justify-center bg-transparent mt-2">
                        <svg class="w-full h-full drop-shadow-xl" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Laptop Base -->
                            <path d="M50 150 H250 L260 160 H40 L50 150 Z" fill="#9CA3AF"/>
                            <rect x="55" y="60" width="190" height="90" rx="4" fill="#1F2937"/>
                            <rect x="65" y="70" width="170" height="70" fill="#E0F2F1"/>
                            
                            <!-- Content -->
                            <rect x="65" y="70" width="170" height="20" fill="#0AB3B6"/>
                            <circle cx="80" cy="100" r="5" fill="#FF8A65"/>
                            <circle cx="100" cy="100" r="5" fill="#CBD5E1"/>
                            <circle cx="120" cy="100" r="5" fill="#CBD5E1"/>
                            <rect x="80" y="115" width="40" height="4" fill="#94A3B8"/>
                            <rect x="80" y="125" width="60" height="4" fill="#94A3B8"/>
                            <path d="M150 130 L170 110 L190 120 L220 90" stroke="#FF8A65" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            
                            <!-- Popout -->
                            <circle cx="240" cy="60" r="15" fill="#FF8A65"/>
                            <path d="M235 58 L240 65 L248 55" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="30" y="80" width="40" height="30" rx="4" fill="#0AB3B6" transform="rotate(-10)"/>
                            <path d="M35 90 H65 M35 98 H55" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            
                            <!-- Hands -->
                            <circle cx="100" cy="155" r="10" fill="#FFCCBC"/>
                            <circle cx="200" cy="155" r="10" fill="#FFCCBC"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- STEP 3: CLOSING --}}
            <div class="flex flex-col items-center relative group">
                {{-- Number Background --}}
                <span class="text-[10rem] font-black text-[#FF8A65]/5 leading-none absolute -top-20 z-0 select-none">
                    {{ $content['col3_numero'] ?? '03' }}
                </span>
                
                <div class="relative z-10 w-full flex flex-col items-center">
                    {{-- Icon --}}
                    <div class="w-16 h-16 rounded-2xl bg-[#0AB3B6]/10 flex items-center justify-center text-[#0AB3B6] text-3xl mb-6 transform group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fas fa-handshake"></i>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-2xl font-bold text-gray-900 text-center leading-tight min-h-[3rem] px-4">
                        {{ $content['col3_titulo'] ?? '3. Cierre Seguro ante Notario' }}
                    </h3>

                    {{-- Illustration --}}
                    <div class="w-full h-56 flex items-center justify-center bg-transparent mt-2">
                         <svg class="w-full h-full drop-shadow-xl" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Table -->
                            <rect x="40" y="140" width="220" height="10" fill="#9CA3AF"/>
                            <rect x="60" y="150" width="10" height="30" fill="#6B7280"/>
                            <rect x="230" y="150" width="10" height="30" fill="#6B7280"/>
                            
                            <!-- Document -->
                            <rect x="120" y="120" width="60" height="30" fill="white" stroke="#D1D5DB"/>
                            <path d="M125 125 H175 M125 130 H175 M125 135 H150" stroke="#9CA3AF" stroke-width="2"/>
                            
                            <!-- Pen -->
                            <path d="M170 110 L175 130 L165 110 Z" fill="#374151"/>
                            
                            <!-- Arms -->
                            <path d="M50 80 Q80 120 110 110" stroke="#0AB3B6" stroke-width="20" stroke-linecap="round"/>
                            <path d="M250 80 Q220 120 190 110" stroke="#FF8A65" stroke-width="20" stroke-linecap="round"/>
                            
                            <!-- Handshake -->
                            <circle cx="150" cy="110" r="15" fill="#FFCCBC"/>
                            
                            <!-- Sparkles -->
                            <g transform="translate(150, 70)">
                                 <path d="M0 0 L0 -10 M7 7 L14 14 M-7 7 L-14 14" stroke="#FFD700" stroke-width="3" stroke-linecap="round"/>
                                 <circle cx="0" cy="-20" r="2" fill="#0AB3B6"/>
                                 <circle cx="20" cy="0" r="2" fill="#FF8A65"/>
                                 <circle cx="-20" cy="0" r="2" fill="#FF8A65"/>
                            </g>

                            <!-- Blur Hints -->
                            <circle cx="40" cy="60" r="20" fill="#0AB3B6" opacity="0.1"/>
                            <circle cx="260" cy="60" r="20" fill="#FF8A65" opacity="0.1"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
         
    </div>
</div>
