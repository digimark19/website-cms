@props([
    'image' => null,
    'title' => 'Título por defecto',
    'description' => 'Descripción por defecto',
    'link' => null,
    'link_text' => 'Ver más'
])

@php
    // Si no hay imagen o el archivo no existe, usar fondo sólido
    $background = (!empty($image) && file_exists(public_path($image)))
        ? "background-image: url('$image');"
        : "background-color: #101828;";
@endphp

<div class="hero bg-cover bg-center text-center text-white flex items-center justify-center"
     style="{{ $background }} min-height: 580px; padding: 80px 20px;">
    
    <div class="bg-black/50 p-12 rounded-2xl inline-block max-w-3xl">
        <h1 class="text-5xl font-bold mb-4">{{ $title }}</h1>
        <p class="text-xl mb-6">{{ $description }}</p>

        @if (!empty($link))
            <a href="{{ $link }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold inline-block text-lg">
                {{ $link_text }}
            </a>
        @endif
    </div>
</div>
