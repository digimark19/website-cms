@extends('layouts.app')

@section('title', $post->translation->firstWhere('lang', app()->getLocale())->title . ' | Blog')

@section('content')
<!-- Link a Google Fonts Rubik -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">

<div class="bg-[#FCF9F5] min-h-screen font-['Rubik']">
    {{-- Hero/Header del Post --}}
    <div class="relative w-full h-[300px] md:h-[500px] overflow-hidden">
        <img src="{{ $post->featured_image ?? 'https://via.placeholder.com/1600x800' }}" 
             alt="{{ $post->title_translated }}" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#101828]/80 via-[#101828]/20 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-6 md:p-20">
            <div class="container mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FF8A65] text-white text-xs font-bold uppercase tracking-wider mb-4 shadow-lg">
                    <i class="fa-solid fa-bookmark"></i>
                    {{ $post->category->name_translated ?? 'Blog' }}
                </div>
                <h1 class="text-3xl md:text-6xl font-bold text-white leading-tight max-w-4xl shadow-sm drop-shadow-md">
                    {{ $post->title_translated }}
                </h1>
            </div>
        </div>
    </div>

    {{-- Main Content Section --}}
    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="flex flex-col lg:flex-row gap-12 xl:gap-20">
            
            {{-- Columna Izquierda: El Post --}}
            <article class="flex-1 max-w-full lg:max-w-[70%]">
                <div class="bg-white rounded-[2rem] p-6 md:p-12 shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-gray-100">
                    
                    {{-- Metadatos superiores --}}
                    <div class="flex flex-wrap items-center gap-6 mb-10 pb-8 border-b border-gray-100 text-gray-500 text-sm md:text-base">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-full bg-[#F4E6D4] flex items-center justify-center text-[#FF8A65]">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <span class="font-medium text-gray-900">{{ $post->author_name ?? 'Duna Realty' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-calendar-alt text-[#FF8A65]"></i>
                            <span>{{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F, Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-clock text-[#FF8A65]"></i>
                            <span>5 min lectura</span>
                        </div>
                    </div>

                    {{-- Contenido Principal --}}
                    <div class="prose prose-lg md:prose-xl prose-gray max-w-none 
                                prose-headings:text-gray-900 prose-headings:font-bold prose-headings:tracking-tight
                                prose-p:text-gray-700 prose-p:leading-relaxed prose-p:mb-6
                                prose-strong:text-gray-900 prose-strong:font-bold
                                prose-img:rounded-3xl prose-img:shadow-2xl">
                        {!! $post->content_translated !!}
                    </div>

                    {{-- Footer del Post / Compartir --}}
                    <div class="mt-16 pt-8 border-t border-gray-100">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-4">
                                <span class="font-bold text-gray-900 uppercase tracking-widest text-xs">Etiquetas:</span>
                                @if($post->tags->count() > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($post->tags as $tag)
                                            <span class="px-3 py-1 bg-gray-50 text-gray-600 text-xs rounded-lg border border-gray-100 hover:bg-[#F4E6D4] transition-colors cursor-default">
                                                #{{ $tag->name_translated }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs italic">Sin etiquetas</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Artículos Relacionados (Debajo del post en desktop, opcional) --}}
                @if(count($relatedPosts) > 0)
                <div class="mt-20">
                    <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-2 h-8 bg-[#FF8A65] rounded-full"></span>
                        Tal vez te interese
                    </h3>
                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($relatedPosts as $related)
                        <a href="{{ url('/blog/' . $related->slug_translated) }}" class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                            <div class="relative h-44 overflow-hidden">
                                <img src="{{ $related->featured_image ?? 'https://via.placeholder.com/600x400' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-gray-900 group-hover:text-[#FF8A65] transition-colors line-clamp-2">
                                    {{ $related->title_translated }}
                                </h4>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </article>

            {{-- Columna Derecha: Sidebar (Sticky) --}}
            <aside class="w-full lg:w-[30%]">
                <div class="sticky top-28 space-y-10">
                    
                    {{-- Widget: Redes Sociales --}}
                    <div class="bg-white rounded-3xl p-8 shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-gray-100 flex flex-col items-center text-center">
                        <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-6">Redes Sociales</h4>
                        <div class="flex justify-center gap-4">
                            @php
                                $shareUrl = urlencode(Request::fullUrl());
                                $shareTitle = urlencode($post->title_translated);
                            @endphp
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="w-12 h-12 rounded-2xl bg-[#f0f2f5] text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all transform hover:-rotate-12">
                                <i class="fa-brands fa-facebook-f text-xl"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" class="w-12 h-12 rounded-2xl bg-[#f0f2f5] text-sky-400 flex items-center justify-center hover:bg-sky-400 hover:text-white transition-all transform hover:rotate-12">
                                <i class="fa-brands fa-x-twitter text-xl"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}" target="_blank" class="w-12 h-12 rounded-2xl bg-[#f0f2f5] text-blue-700 flex items-center justify-center hover:bg-blue-700 hover:text-white transition-all transform hover:-rotate-12">
                                <i class="fa-brands fa-linkedin-in text-xl"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Widget: Categorías --}}
                    <div class="bg-white rounded-3xl p-8 shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-gray-100">
                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 border-l-4 border-[#FF8A65] pl-3">Categorías</h4>
                        <ul class="space-y-3">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ url('/blog/categoria/' . $category->slug_translated) }}" class="flex items-center justify-between group">
                                    <span class="text-gray-600 group-hover:text-[#FF8A65] transition-colors font-medium">
                                        {{ $category->name_translated }}
                                    </span>
                                    <span class="text-xs bg-gray-50 text-gray-400 px-2 py-1 rounded-lg group-hover:bg-[#F4E6D4] group-hover:text-[#FF8A65] transition-all">
                                        {{ $category->posts_count ?? count($category->posts) }}
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Widget: Recientes / Más Populares --}}
                    <div class="bg-white rounded-3xl p-8 shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-gray-100">
                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 border-l-4 border-[#FF8A65] pl-3">Recientes</h4>
                        <div class="space-y-6">
                            @foreach($recentPosts as $recent)
                            <a href="{{ url('/blog/' . $recent->slug_translated) }}" class="flex gap-4 group">
                                <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                                    <img src="{{ $recent->featured_image ?? 'https://via.placeholder.com/150x150' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-sm font-bold text-gray-900 group-hover:text-[#FF8A65] transition-colors line-clamp-2 leading-tight">
                                        {{ $recent->title_translated }}
                                    </h5>
                                    <span class="text-[10px] text-gray-400 block mt-1">
                                        {{ \Carbon\Carbon::parse($recent->published_at)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Widget: Newsletter Call to Action --}}
                    <div class="bg-gradient-to-br from-[#101828] to-[#1D293F] rounded-3xl p-8 text-center relative overflow-hidden shadow-2xl">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-white/5 rounded-full -mr-10 -mt-10 blur-xl"></div>
                        <i class="fa-solid fa-envelope-open-text text-4xl text-[#FF8A65] mb-4"></i>
                        <h4 class="text-white font-bold text-lg mb-2">¿Te gusta lo que lees?</h4>
                        <p class="text-gray-400 text-xs mb-6">Suscríbete y recibe lo mejor del mundo inmobiliario en tu email.</p>
                        <a href="{{ url('/#newsletter-section') }}" class="inline-block w-full py-3 bg-[#FF8A65] text-white rounded-xl font-bold hover:bg-[#ff7b54] transition-all shadow-lg hover:shadow-[#FF8A65]/20">
                            Suscribirme ahora
                        </a>
                    </div>

                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

