@if($name === 'servicios')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-4">{{ $content['titulo'] }}</h2>
        <p class="text-lg text-gray-600 mb-8">{{ $content['subtitulo'] }}</p>
        <img src="{{ $content['imagen'] }}" alt="Servicios" class="mx-auto mb-12 rounded-lg shadow-lg">

        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($content['tarjetas'] as $tarjeta)
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <i class="{{ $tarjeta['icono'] }} text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-2xl font-semibold mb-2">{{ $tarjeta['titulo'] }}</h3>
                    <p class="text-gray-600">{{ $tarjeta['descripcion'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif


