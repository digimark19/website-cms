<!-- Sección Testimonios -->
<section class="pt-24 pb-48 bg-white relative overflow-hidden font-['Rubik']">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#0AB3B6]/5 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#FF8A65]/5 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Section Header (Consistent with Servicios/Cintillo) -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <span class="inline-block px-4 py-1.5 rounded-full bg-[#0AB3B6]/10 text-[#0AB3B6] text-xs font-bold uppercase tracking-widest mb-4">
                {{ $content['titulo_pequeno'] ?? 'Testimonios' }}
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-[#052669] leading-tight font-['Rubik']">
                {{ $content['titulo'] ?? 'Lo que dicen nuestros clientes' }}
            </h2>
            <div class="w-20 h-1.5 bg-[#FF8A65] mx-auto mt-6 rounded-full"></div>
            @if(!empty($content['subtitulo']))
                <p class="text-lg text-gray-500 mt-8 max-w-2xl mx-auto leading-relaxed">{{$content['subtitulo']}}</p>
            @endif
        </div>

        @if(!empty($content['testimonials']))
        <!-- Grid de Testimonios -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-8 gap-y-32">
            @foreach($content['testimonials'] as $card)
            <div class="relative bg-white p-8 md:p-10 rounded-[40px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-50 flex flex-col items-center transition-all duration-500 hover:shadow-[0_30px_70px_rgba(0,0,0,0.1)] group">

                <!-- Quote Icon (Centered) -->
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-[#FF8A65] to-[#FF5A5F] rounded-2xl flex items-center justify-center shadow-lg shadow-[#FF8A65]/30 transform group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                    <i class="fas fa-quote-left text-white text-xl"></i>
                </div>

                <!-- Descripción -->
                <div class="relative z-10 flex-grow pt-4 pb-16">
                    <p class="text-gray-600 italic leading-normal text-lg text-center font-light italic">
                        "{{ $card['descripcion'] }}"
                    </p>
                </div>

                <!-- Author Section (Avatar + Name Below) -->
                <div class="absolute -bottom-24 left-1/2 transform -translate-x-1/2 flex flex-col items-center w-full">
                    <!-- Avatar Structure -->
                    <div class="relative w-28 h-28 mb-4">
                        <!-- Decorative Ring -->
                        <div class="absolute inset-0 rounded-full border-2 border-dashed border-[#FF8A65] animate-[spin_20s_linear_infinite] opacity-40"></div>
                        <!-- White background circle -->
                        <div class="absolute inset-2 bg-white rounded-full shadow-lg z-10"></div>
                        <!-- Real Image -->
                        <div class="absolute inset-3 rounded-full overflow-hidden z-20 border-4 border-white shadow-inner">
                            @if(!empty($card['avatar']))
                                <img src="{{ $card['avatar'] }}" alt="{{ $card['name'] }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-[#FF8A65] text-3xl">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Name and Title -->
                    <div class="text-center">
                        <h4 class="font-bold text-[#052669] text-xl mb-1 tracking-tight">
                            {{ $card['name'] }}
                        </h4>
                        <div class="flex justify-center gap-1 text-[#FF8A65]">
                            <i class="fas fa-star text-[10px]"></i>
                            <i class="fas fa-star text-[10px]"></i>
                            <i class="fas fa-star text-[10px]"></i>
                            <i class="fas fa-star text-[10px]"></i>
                            <i class="fas fa-star text-[10px]"></i>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

@once
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@endonce
