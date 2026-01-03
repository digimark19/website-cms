<!-- PROPIEDADES RECIENTES -->
@if($recentProperties->count() > 0)
<div class="bg-gray-50 py-20" x-data="{ view: 'grid', mobile: window.innerWidth < 768 }" @resize.window="mobile = window.innerWidth < 768">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#052669] mb-4">Propiedades Recientes</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Explora nuestras últimas captaciones y encuentra tu próximo hogar hoy mismo.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recentProperties as $prop)
                <x-propiedad-card 
                    :prop="$prop" 
                    :view="'grid'"
                    :labels="$labels ?? []" 
                />
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="{{ app()->getLocale() == 'es' ? '/propiedades' : '/en/properties' }}" class="inline-block bg-[#052669] text-white px-8 py-4 rounded-xl font-bold hover:bg-[#031b4e] transition-all shadow-lg shadow-[#052669]/20">
                Ver todas las propiedades
            </a>
        </div>
    </div>
</div>
@endif
