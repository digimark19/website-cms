
<div class="relative w-full py-20 lg:py-32 font-rubik overflow-hidden">
    {{-- Background Image & Overlay --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/contact-bg.png') }}" class="w-full h-full object-cover" alt="Background">
        {{-- Blue Overlay with Texture --}}
        <div class="absolute inset-0 bg-[#001f3f]/90 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-blue-900/60"></div>
        
        {{-- Texture removed --}}
    </div>

    {{-- Content Container (Centered) --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row shadow-2xl rounded-3xl overflow-hidden bg-white">
            
            {{-- Left Column: Contact Info --}}
            <div class="w-full lg:w-5/12 bg-gradient-to-br from-[#0a1e45] to-[#040f26] text-white p-8 md:p-12 lg:p-16 relative flex flex-col justify-center overflow-hidden">
                {{-- Subtle Modern Accent (Optional: minimalist circle glow) --}}
                <div class="absolute top-0 left-0 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-blue-400/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">{{ $content['title'] }}</h2>
                    <p class="text-blue-100 mb-10 text-lg leading-relaxed">
                        {{ $content['description'] }}
                    </p>

                    <div class="grid grid-cols-1 gap-4">
                        {{-- WhatsApp Action Card (Featured) --}}
                        @if($siteSettings->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings->whatsapp) }}" target="_blank" 
                               class="group flex items-center gap-5 p-5 bg-white/5 border border-white/10 rounded-2xl hover:bg-[#25D366] hover:border-[#25D366] transition-all duration-300 shadow-lg hover:shadow-green-500/20 hover:-translate-y-1">
                                <div class="w-14 h-14 rounded-full bg-white/10 flex items-center justify-center text-green-400 group-hover:bg-white group-hover:text-[#25D366] transition-colors duration-300">
                                    <i class="fab fa-whatsapp text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-blue-200 uppercase tracking-wider mb-1 group-hover:text-green-100">{{ $content['whatsapp_label'] }}</h3>
                                    <p class="text-xl font-bold text-white">{{ $siteSettings->whatsapp }}</p>
                                    <p class="text-xs text-gray-400 mt-1 group-hover:text-white/80">{{ $content['whatsapp_cta'] }}</p>
                                </div>
                                <i class="fas fa-arrow-right ml-auto text-white/20 group-hover:text-white transition-all transform group-hover:translate-x-1"></i>
                            </a>
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            {{-- Phone --}}
                            @if($siteSettings->phone)
                                <a href="tel:{{ $siteSettings->phone }}" 
                                   class="group flex flex-col justify-center p-5 bg-white/5 border border-white/10 rounded-2xl hover:bg-white hover:border-white transition-all duration-300 hover:-translate-y-1">
                                    <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-300 mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <h3 class="text-xs font-semibold text-blue-200 uppercase tracking-wider mb-1 group-hover:text-gray-500">{{ $content['phone_label'] }}</h3>
                                    <p class="text-sm font-bold text-white group-hover:text-[#0a1e45]">{{ $siteSettings->phone }}</p>
                                </a>
                            @endif

                            {{-- Email --}}
                            @if($siteSettings->email)
                                <a href="mailto:{{ $siteSettings->email }}" 
                                   class="group flex flex-col justify-center p-5 bg-white/5 border border-white/10 rounded-2xl hover:bg-white hover:border-white transition-all duration-300 hover:-translate-y-1">
                                    <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-300 mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h3 class="text-xs font-semibold text-blue-200 uppercase tracking-wider mb-1 group-hover:text-gray-500">{{ $content['email_label'] }}</h3>
                                    <p class="text-sm font-bold text-white group-hover:text-[#0a1e45] break-words">{{ $siteSettings->email }}</p>
                                </a>
                            @endif
                        </div>

                        {{-- Location (Full Width) --}}
                        @if($siteSettings->address)
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($siteSettings->address . ' ' . $siteSettings->city . ' ' . $siteSettings->state) }}" target="_blank"
                               class="group flex items-start gap-4 p-5 bg-white/5 border border-white/10 rounded-2xl hover:bg-white hover:border-white transition-all duration-300 hover:-translate-y-1">
                                <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-300 flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h3 class="text-xs font-semibold text-blue-200 uppercase tracking-wider mb-1 group-hover:text-gray-500">{{ $content['address_label'] }}</h3>
                                    <p class="text-sm text-gray-300 leading-relaxed group-hover:text-[#0a1e45] font-medium">
                                        {{ $siteSettings->address }}
                                    </p>
                                </div>
                            </a>
                        @endif
                    </div>

                    {{-- Social Media --}}
                    <div class="mt-12 pt-8 border-t border-white/10">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-blue-200 mb-4">{{ $content['social_label'] }}</h3>
                        <div class="flex gap-4">
                            @if($siteSettings->facebook_url)
                                <a href="{{ $siteSettings->facebook_url }}" target="_blank" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-[#0a1e45] transition duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            @if($siteSettings->instagram_url)
                                <a href="{{ $siteSettings->instagram_url }}" target="_blank" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-[#0a1e45] transition duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                            @if($siteSettings->twitter_url)
                                <a href="{{ $siteSettings->twitter_url }}" target="_blank" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-[#0a1e45] transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a> <!-- Fixed icon class from twitter to x-twitter or generic twitter -->
                            @endif
                            @if($siteSettings->youtube_url)
                                <a href="{{ $siteSettings->youtube_url }}" target="_blank" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-[#0a1e45] transition duration-300">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif
                            @if($siteSettings->linkedin_url)
                                <a href="{{ $siteSettings->linkedin_url }}" target="_blank" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-[#0a1e45] transition duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif
                            @if($siteSettings->tiktok_url)
                                <a href="{{ $siteSettings->tiktok_url }}" target="_blank" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-[#0a1e45] transition duration-300">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Form --}}
            <div class="w-full lg:w-7/12 bg-gray-50 p-6 md:p-8 lg:p-12 flex flex-col justify-center">
                
                <div class="mb-4 px-4">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $content['form_title'] }}</h2>
                </div>
                <div class="px-4">
                    <x-contact-form tipo="contacto" />
                </div>
                
            </div>
        </div>
    </div>
</div>

