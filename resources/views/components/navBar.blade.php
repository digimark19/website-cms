{{-- 🔝 Barra superior (solo escritorio) --}}
<div class="bg-white z-10 fixed w-full h-10 shadow-sm hidden md:block fixed top-0 left-0 ">
  <div class="max-w-7xl mx-auto flex justify-between items-center h-10 px-4 sm:px-6 lg:px-8">
    {{-- 📧 Correo y teléfono --}}
    <div class="flex items-center space-x-6">
      @if(!empty($siteSettings->email))
      <a href="mailto:{{ $siteSettings->email }}" class="flex items-center hover:text-gray-900 transition">
        <span class="flex items-center justify-center w-7 h-7 rounded-full bg-[#e9ecf5] mr-2">
          <i class="fa-solid fa-envelope text-[#052669] text-sm"></i>
        </span>
        <span class="text-sm text-[#052669]">{{ $siteSettings->email }}</span>
      </a>
      @endif
      @if(!empty($siteSettings->phone))
      <a href="tel:{{ $siteSettings->phone }}" class="flex items-center hover:text-gray-900 transition">
        <span class="flex items-center justify-center w-7 h-7 rounded-full bg-[#e9ecf5] mr-2">
          <i class="fa-solid fa-phone text-[#052669] text-sm"></i>
        </span>
        <span class="text-sm text-[#052669]">{{ $siteSettings->phone }}</span>
      </a>
      @endif
    </div>

    {{-- 🌐 Redes sociales --}}
    <div class="flex items-center space-x-2">
      @if(!empty($siteSettings->facebook_url))
      <a href="{{ $siteSettings->facebook_url }}" class="flex items-center justify-center w-6 h-6 text-white rounded-full hover:opacity-90 transition" style="background-color: #052669;">
        <i class="fa-brands fa-facebook-f text-[11px]"></i>
      </a>
      @endif
      @if(!empty($siteSettings->instagram_url))
      <a href="{{ $siteSettings->instagram_url }}" class="flex items-center justify-center w-6 h-6 text-white rounded-full hover:opacity-90 transition" style="background-color: #052669;">
        <i class="fa-brands fa-instagram text-[11px]"></i>
      </a>
      @endif
      @if(!empty($siteSettings->twitter_url))
      <a href="{{ $siteSettings->twitter_url }}" class="flex items-center justify-center w-6 h-6 text-white rounded-full hover:opacity-90 transition" style="background-color: #052669;">
        <i class="fa-brands fa-twitter text-[11px]"></i>
      </a>
      @endif
      @if(!empty($siteSettings->linkedin_url))
      <a href="{{ $siteSettings->linkedin_url }}" class="flex items-center justify-center w-6 h-6 text-white rounded-full hover:opacity-90 transition" style="background-color: #052669;">
        <i class="fa-brands fa-linkedin-in text-[11px]"></i>
      </a>
      @endif
    </div>
  </div>
</div>

{{-- Navbar principal --}}
<nav x-data="{ open: false, openQuote: false, openLang: false }" class="bg-[#0AB3B6] fixed w-full z-20 top-0 md:top-10 shadow-md">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      {{-- Logo --}}
      <a href="{{ app()->getLocale() === 'es' ? url('/') : url(app()->getLocale()) }}" class="text-xl font-bold text-white">MiSitio</a>

      {{-- Menú desktop --}}
      <div class="hidden md:flex space-x-6 items-center">
        @foreach ($menuItems as $item)
          @if (count($item['children']) > 0)
            <div class="relative group">
              <a href="{{ $item['route'] }}" class="text-white hover:text-gray-200">{{ $item['title'] }}</a>
              <div class="absolute left-0 hidden group-hover:block bg-[#0AB3B6] mt-2 rounded shadow-lg">
                @foreach ($item['children'] as $child)
                <a href="{{ $child['route'] }}" class="block px-4 py-2 text-white hover:bg-white/10">{{ $child['title'] }}</a>
                @endforeach
              </div>
            </div>
          @else
            <a href="{{ $item['route'] }}" class="text-white hover:text-gray-200">{{ $item['title'] }}</a>
          @endif
        @endforeach

        {{-- Botón Cotizar Ahora --}}
        <button @click="openQuote = true" 
                class="border-2 border-[#4A4A4A] text-[#4A4A4A] hover:bg-[#4A4A4A] hover:text-white px-4 py-2 rounded-md font-semibold transition">
            Cotizar Ahora
        </button>

        <!-- {{-- Selector de idioma --}}
        <div x-data="{ openLang: false }" class="ml-4 relative" @click.away="openLang = false">
          <button @click="openLang = !openLang"
                  class="flex items-center text-white font-semibold focus:outline-none hover:text-white/80 transition">
            {{ strtoupper($currentLocale) }}
            <i class="fa-solid fa-chevron-down text-xs ml-1 transition-transform"
               :class="{ 'rotate-180': openLang }"></i>
          </button>
          <div x-show="openLang" 
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 transform scale-95"
               x-transition:enter-end="opacity-100 transform scale-100"
               x-transition:leave="transition ease-in duration-150"
               x-transition:leave-start="opacity-100 transform scale-100"
               x-transition:leave-end="opacity-0 transform scale-95"
               class="absolute right-0 mt-2 w-32 bg-white border border-[#0AB3B6]/20 rounded-lg shadow-lg overflow-hidden z-50">
            @foreach ($translatedUrls as $lang)
              @if ($lang['code'] !== $currentLocale)
              <a href="{{ $lang['url'] }}" class="block px-4 py-2 text-[#052669] text-sm hover:bg-[#0AB3B6]/10 transition">
                {{ strtoupper($lang['code']) }}
              </a>
              @endif
            @endforeach
          </div>
        </div>  -->


      </div>

      {{-- Botón menú móvil --}}
      <div class="md:hidden">
        <button @click="open = !open" class="focus:outline-none text-white">
          <i :class="open ? 'fa-solid fa-xmark text-2xl' : 'fa-solid fa-bars text-2xl'"></i>
        </button>
      </div>
    </div>
  </div>

  {{-- Menú móvil --}}
  <div x-show="open" @click.away="open = false"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0 transform -translate-y-4"
       x-transition:enter-end="opacity-100 transform translate-y-0"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100 transform translate-y-0"
       x-transition:leave-end="opacity-0 transform -translate-y-4"
       class="md:hidden bg-white border-t border-[#0AB3B6]/20 shadow-inner z-50">
    <div class="px-4 py-3 space-y-3">
      @foreach ($menuItems as $item)
        <a href="{{ $item['route'] }}" class="block py-2 text-[#052669] hover:bg-[#0AB3B6]/10 rounded px-2">{{ $item['title'] }}</a>
        @foreach ($item['children'] as $child)
          <a href="{{ $child['route'] }}" class="block pl-6 py-1 text-sm text-[#052669]/90 hover:bg-[#0AB3B6]/10 rounded">
            └ {{ $child['title'] }}
          </a>
        @endforeach
      @endforeach

      {{-- Botón Cotizar Ahora móvil --}}
      <button @click="openQuote = true" class="w-full border-2 border-[#4A4A4A] text-[#4A4A4A] hover:bg-[#4A4A4A] hover:text-white px-4 py-2 rounded-md font-semibold transition">
        Cotizar Ahora
      </button>

      <!-- {{-- Idioma móvil --}}
      <div x-data="{ openLangMobile: false }" class="pt-3 border-t border-[#0AB3B6]/20">
        <button @click="openLangMobile = !openLangMobile" 
                class="flex justify-between w-full text-[#052669] font-semibold py-2">
          {{ strtoupper($currentLocale) }}
          <i class="fa-solid fa-chevron-down text-sm transition-transform"
             :class="{ 'rotate-180': openLangMobile }"></i>
        </button>
        <div x-show="openLangMobile" x-transition class="pl-4 mt-1 space-y-1">
          @foreach ($translatedUrls as $lang)
            @if ($lang['code'] !== $currentLocale)
            <a href="{{ $lang['url'] }}" class="block text-[#052669] hover:bg-[#0AB3B6]/10 px-2 py-1 rounded text-sm">
              {{ strtoupper($lang['code']) }}
            </a>
            @endif
          @endforeach
        </div>
      </div> -->
      
      
    </div>
  </div>

  {{-- Popup Cotizar Ahora --}}
  <div x-show="openQuote"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0 scale-90"
       x-transition:enter-end="opacity-100 scale-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100 scale-100"
       x-transition:leave-end="opacity-0 scale-90"
       class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 overflow-auto p-4"
       style="display: none;"
       @click.away="openQuote = false">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl p-6 relative overflow-auto max-h-[90vh]">
        <button @click="openQuote = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <x-contact-form tipo="contacto" />
        
    </div>
</div>
</nav>

<!-- ReCAPTCHA script -->
<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
