<!-- Footer -->
<footer class="relative text-white mt-16 ">

    <!-- Newsletter (componente) -->
        <x-newsLetter />

    <!-- Sección Principal del Footer -->
    <div class="bg-[#052669] pt-52 pb-12 mt-16 "> {{-- pt-52 crea espacio para el newsletter flotante --}}
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Logo y marca -->
                <div class="lg:col-span-1">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold mb-2">{{ $siteSettings->site_name }}</h2>
                        <p class="text-gray-300 text-lg font-light">B I E N E S P A L C E S</p>
                    </div>
                </div>

                <!-- Mapa del sitio -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Mapa del sitio</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Propiedades</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Desarrollos</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">BIOS</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Alianzas / Partners</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Nosotros</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>

                <!-- Tendencias -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tendencias</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Quiero vender mi propiedad</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">¿Por qué invertir con nosotros?</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Desarrollos más populares</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Inversiones inteligentes</a></li>
                    </ul>
                </div>

                <!-- Cotización + redes sociales -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Empieza tu cotización</h3>
                    <button class="w-full bg-[#FF8A65] hover:bg-[#ff7043] text-white py-3 px-6 rounded-lg font-medium transition duration-300 mb-6">
                        Solicitar Cotización
                    </button>

                    <p class="text-gray-300 text-sm mb-4">
                        Recibe una evaluación gratuita de tu propiedad en menos de 24 horas.
                    </p>

                    <!-- Redes sociales -->
                    <div class="flex space-x-3">
                        <a href="#" class="p-3 bg-[#FF8A65] hover:bg-[#ff7043] rounded-lg transition" aria-label="Facebook">
                            <i class="fab fa-facebook-f text-white text-lg"></i>
                        </a>
                        <a href="#" class="p-3 bg-[#FF8A65] hover:bg-[#ff7043] rounded-lg transition" aria-label="Instagram">
                            <i class="fab fa-instagram text-white text-lg"></i>
                        </a>
                        <a href="#" class="p-3 bg-[#FF8A65] hover:bg-[#ff7043] rounded-lg transition" aria-label="Twitter">
                            <i class="fab fa-twitter text-white text-lg"></i>
                        </a>
                        <a href="#" class="p-3 bg-[#FF8A65] hover:bg-[#ff7043] rounded-lg transition" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in text-white text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección inferior -->
    <div class="bg-[#1D293F] border-t border-gray-700">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-400 text-sm mb-4 md:mb-0">
                    Copyright © 2025 Inmobilen Inc.
                </div>
                <div class="flex space-x-6">
                    <a href="terminos-y-condiciones" class="text-gray-400 hover:text-white text-sm transition">Términos de Servicio</a>
                    <a href="aviso-de-privacidad" class="text-gray-400 hover:text-white text-sm transition">Aviso de Privacidad</a>
                </div>
            </div>
        </div>
    </div>
</footer>

