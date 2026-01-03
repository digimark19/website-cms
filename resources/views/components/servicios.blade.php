<section class="relative bg-white pt-24 pb-32 overflow-hidden font-['Rubik']">
  <!-- Decorative background elements -->
  <div class="absolute top-0 left-0 w-64 h-64 bg-[#0AB3B6]/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#FF8A65]/5 rounded-full translate-x-1/2 translate-y-1/2 blur-3xl"></div>

  <div class="max-w-7xl mx-auto px-4 relative">
    
    <!-- Section Header -->
    <div class="text-center max-w-3xl mx-auto mb-16">
      <span class="inline-block px-4 py-1.5 rounded-full bg-[#0AB3B6]/10 text-[#0AB3B6] text-xs font-bold uppercase tracking-widest mb-4">
        {{ $content['titulo'] ?? 'Nuestros Servicios' }}
      </span>
      <h2 class="text-3xl md:text-5xl font-extrabold text-[#052669] leading-tight font-['Rubik']">
        {{ $content['subtitulo'] ?? 'Lo que podemos hacer por ti' }}
      </h2>
      <div class="w-20 h-1.5 bg-[#FF8A65] mx-auto mt-6 rounded-full"></div>
    </div>

    <!-- Main Content Area -->
    <div class="relative">
      {{-- Background Image - Temporarily disabled to test clean look
      <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-16 h-[200px] md:h-[350px] group">
        <img 
          src="https://images.unsplash.com/photo-1560520653-9e0e4c89eb11?q=80&w=1973&auto=format&fit=crop" 
          alt="Modern Architecture"
          class="w-full h-full object-cover opacity-60 grayscale-[30%] transition-transform duration-1000 group-hover:scale-105"
        >
        <div class="absolute inset-0 bg-gradient-to-b from-[#052669]/20 via-[#052669]/40 to-[#052669]/80"></div>
      </div>
      --}}

      <!-- Service Cards -->
      @if(!empty($content['tarjetas']))
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10 relative z-10 px-8 md:px-14 lg:px-20 mx-auto">
        @foreach($content['tarjetas'] as $card)
        <div class="group bg-white rounded-2xl p-10 shadow-[0_30px_60px_rgba(0,0,0,0.12)] border border-gray-50 transition-all duration-500 hover:-translate-y-4 hover:shadow-[0_50px_100px_rgba(0,0,0,0.18)] flex flex-col h-full ring-1 ring-black/5">
          
          <!-- Icon Container -->
          <div class="w-20 h-20 bg-gradient-to-br from-[#0AB3B6] to-[#052669] rounded-2xl flex items-center justify-center mb-8 shadow-xl shadow-[#0AB3B6]/20 transform group-hover:rotate-6 transition-transform duration-300">
            <i class="{{ $card['icono'] ?? 'fas fa-check' }} text-white text-3xl"></i>
          </div>

          <!-- Card Content -->
          <h3 class="text-2xl font-black text-[#052669] mb-4 group-hover:text-[#0AB3B6] transition-colors duration-300">
            {{ $card['titulo'] ?? 'Servicio' }}
          </h3>
          
          <p class="text-gray-600 leading-relaxed text-lg mb-10 flex-grow">
            {{ $card['descripcion'] ?? '' }}
          </p>

          <!-- Action Link -->
          <div class="mt-auto">
            <a href="#" class="inline-flex items-center text-[#FF8A65] font-black text-sm tracking-widest group-hover:gap-4 transition-all duration-300 uppercase">
              <span>Saber más</span>
              <i class="fas fa-long-arrow-alt-right ml-2 text-base"></i>
            </a>
          </div>

        </div>
        @endforeach
      </div>
      @endif
    </div>

  </div>
</section>

<!-- Include Rubik from Google Fonts if not already in layout -->
@once
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@endonce

