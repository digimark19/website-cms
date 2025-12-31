<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative">
    <div class="flex flex-col lg:flex-row items-center relative lg:min-h-[850px]">
        
        {{-- Element 1: Background Image & Text --}}
        <div class="w-full lg:w-3/5 relative h-[500px] lg:h-[800px] rounded-2xl overflow-hidden shadow-xl z-0">
            {{-- Background Image --}}
            <img 
                src="{{ asset('images/contact-bg.png') }}" 
                alt="Contact Background" 
                class="absolute inset-0 w-full h-full object-cover"
            >
            {{-- Dark Overlay to ensure text readability --}}
            <div class="absolute inset-0 bg-black/40"></div>
            
            {{-- Centered Vertical / Left Aligned Text --}}
            <div class="absolute inset-x-0 top-0 lg:inset-y-0 flex items-start lg:items-center justify-center lg:justify-start px-6 lg:px-32 pt-12 lg:pt-0">
                <div class="text-white font-rubik text-center lg:text-left">
                    {{-- Mobile Text: Single Line --}}
                    <h2 class="block lg:hidden text-3xl md:text-4xl font-bold leading-tight">
                        Envíanos un mensaje
                    </h2>
                    {{-- Desktop Text: One word per line --}}
                    <h2 class="hidden lg:flex flex-col items-start text-7xl font-bold leading-tight">
                        @foreach(explode(' ', "ENVÍANOS UN MENSAJE") as $word)
                            <span>{{ $word }}</span>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

        {{-- Element 2: Overlapping Form Container --}}
        <div class="w-full lg:w-[650px] bg-[#FF8A65] rounded-2xl shadow-2xl p-8 md:p-10 
                    -mt-80 lg:mt-0 
                    lg:absolute lg:right-0 lg:top-1/2 lg:-translate-y-1/2 lg:z-10 
                    transform lg:-translate-x-[20px] relative z-20">
            <div class="text-white">
                <x-contact-form tipo="contacto" />
            </div>
        </div>

    </div>
</div>
