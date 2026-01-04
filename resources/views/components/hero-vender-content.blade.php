

<div class="relative w-full h-[600px] lg:h-[700px] overflow-hidden group">
    
    {{-- Background Image with Zoom Effect --}}
    <img src="{{ $image }}" 
         alt="Hero Background" 
         class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
         onerror="this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'">

    {{-- Dark Gradient Overlay (Bottom Focused) --}}
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>

    {{-- Content --}}
    <div class="absolute bottom-0 left-0 w-full pb-16 md:pb-20 z-10 font-rubik">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center md:items-start text-left">
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight drop-shadow-lg max-w-4xl text-center md:text-left">
                {{ $title }}
            </h1>
            
            <p class="text-xl text-gray-200 mb-8 max-w-2xl font-light text-center md:text-left">
                {{ $subtitle }}
            </p>

            <a href="#formulario" 
               class="inline-flex items-center gap-3 px-8 py-4 bg-[#FF8A65] text-white font-bold uppercase tracking-wider rounded-full hover:bg-[#FF7043] transition-all duration-300 shadow-lg hover:shadow-[#FF8A65]/50 transform hover:-translate-y-1">
                <span>{{ $buttonText }}</span>
                <i class="fas fa-arrow-down animate-bounce"></i>
            </a>

        </div>
    </div>
</div>
