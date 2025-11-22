@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Cabecera del post -->
    <section class="relative w-full h-[400px] bg-gray-200 overflow-hidden">
        <img src="{{ $post->featured_image ?? 'https://via.placeholder.com/1200x600' }}" 
             alt="{{ $post->translation[0]->title }}" 
             class="w-full h-full object-cover opacity-90">

        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex flex-col justify-end px-6 md:px-20 py-10">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-3">
                {{ $post->translation[0]->title }}
            </h1>
            <div class="flex items-center gap-4 text-gray-200 text-sm">
                <span>👤 {{ $post->author_name ?? 'Admin' }}</span>
                <span>📅 {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d M, Y') }}</span>
                @if(isset($post->category->name))
                    <span class="bg-blue-600 text-white px-2 py-1 rounded text-xs">
                        {{ $post->category->name }}
                    </span>
                @endif
            </div>
        </div>
    </section>

    <!-- Contenido principal -->
    <section class="max-w-5xl mx-auto px-6 md:px-12 py-10">
        <div class="prose prose-lg prose-blue max-w-none">
            {!! $post->translation[0]->content !!}
        </div>

        <!-- Social links -->
        @if($post->social_links)
            <div class="mt-10 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold mb-4">Comparte este artículo</h3>
                <div class="flex gap-4">
                    @foreach($post->social_links as $key => $url)
                        <a href="{{ $url }}" target="_blank" 
                           class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">
                            @if($key === 'facebook')
                                <i class="fab fa-facebook-f"></i>
                            @elseif($key === 'twitter')
                                <i class="fab fa-twitter"></i>
                            @elseif($key === 'linkedin')
                                <i class="fab fa-linkedin-in"></i>
                            @else
                                <i class="fas fa-link"></i>
                            @endif
                            <span>{{ ucfirst($key) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Artículos relacionados (ejemplo estático, puedes llenarlo dinámicamente luego) -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6 border-b pb-2">Artículos relacionados</h2>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($relatedPosts ?? [] as $related)
                    <a href="{{ getLocalizedUrl('blog.show', ['slug' => $related->slug_translated]) }}" 
                       class="group block bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                        <img src="{{ $related->featured_image ?? 'https://via.placeholder.com/600x400' }}" 
                             alt="{{ $related->title_translated }}" 
                             class="h-48 w-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="p-5">
                            <h3 class="font-semibold text-lg mb-2 group-hover:text-blue-600">
                                {{ $related->title_translated }}
                            </h3>
                            <p class="text-gray-600 text-sm">
                                {!! Str::limit(strip_tags($related->content_translated), 100) !!}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Volver -->
        <div class="mt-10">
            <a href="{{ getLocalizedUrl('blog') }}" 
               class="inline-block text-blue-600 hover:text-blue-800 font-semibold">
                ← Volver al Blog
            </a>
        </div>
    </section>
</div>
@endsection
