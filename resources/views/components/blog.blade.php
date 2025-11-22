<div class="container mx-auto py-10 px-4">
    <h1 class="text-4xl font-bold mb-8 text-center">Blog</h1>

    {{-- 🔍 Buscador --}}
    <form method="GET" action="{{ getLocalizedUrl('blog.' . app()->getLocale()) }}" class="mb-10 flex justify-center">
        <div class="w-full max-w-lg flex rounded overflow-hidden shadow">
            <input
                type="text"
                name="search"
                placeholder="Buscar por título o descripción..."
                value="{{ $search }}"
                class="flex-grow px-4 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-l"
            >
            <button
                type="submit"
                class="bg-blue-500 text-white px-6 py-2 font-semibold rounded-r hover:bg-blue-600 transition"
            >
                Buscar
            </button>
        </div>
    </form>

    {{-- 📰 Listado de posts en cuadrícula --}}
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($posts as $post)
            @php
                $lang = app()->getLocale();
                $translation = $post->translation->firstWhere('lang', $lang);

                $title = $translation->title ?? '';
                $slug = $translation->slug ?? '';
                $content = $translation->content ?? '';
                $image = $post->featured_image ?? asset('images/default-post.jpg');
                $authorName = $post->author->name ?? 'Autor Desconocido';
                $authorAvatar = $post->author->avatar ?? null;
                $postDate = $post->created_at->format('d M Y');
                
                // Categorías y etiquetas hardcodeadas
                $categories = ['Inmuebles', 'Inversiones'];
                $tags = ['Venta', 'Propiedades', 'Destacado'];
            @endphp

            <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                {{-- Imagen destacada --}}
                <div class="relative h-64 w-full bg-gray-200 overflow-hidden"> {{-- Cambiado de h-48 a h-64 --}}
                    <img
                        src="{{ $image }}"
                        alt="{{ $title }}"
                        class="w-full h-full object-cover transform hover:scale-105 transition duration-300"
                    >
                    {{-- Categorías y etiquetas --}}
                    <div class="absolute bottom-2 left-2 flex flex-wrap gap-2">
                        @foreach($categories as $category)
                            <span class="bg-blue-600 text-white px-2 py-1 text-xs rounded">{{ $category }}</span>
                        @endforeach
                        @foreach($tags as $tag)
                            <span class="bg-gray-300 text-gray-800 px-2 py-1 text-xs rounded">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Contenido del post --}}
                <div class="p-5 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold mb-2">{{ $title }}</h2>
                    <p class="text-gray-700 flex-grow">
                        {!! Str::limit(strip_tags($content), 120) !!}
                    </p>

                    {{-- Autor y fecha --}}
                    <div class="flex items-center mt-4 mb-3">
                        @if($authorAvatar)
                            <img src="{{ $authorAvatar }}" alt="{{ $authorName }}" class="w-10 h-10 rounded-full mr-3 object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full mr-3 bg-gray-300 flex items-center justify-center text-white" title="{{ $authorName }}">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div>
                            <p class="text-gray-800 font-semibold text-sm">{{ $authorName }}</p>
                            <p class="text-gray-500 text-xs">{{ $postDate }}</p>
                        </div>
                    </div>

                    {{-- Botón Leer más + Redes sociales --}}
                    <div class="flex justify-between items-center mt-2">
                        <a
                            href="{{ 'blog/'.$slug }}"
                            class="bg-[#FF8A65] text-white px-4 py-2 rounded hover:bg-[#ff7043] transition font-semibold"
                        >
                            Leer más
                        </a>

                        <div class="flex space-x-2">
                            <a href="#" class="w-10 h-10 flex items-center justify-center bg-[#FF8A65] rounded-md transition hover:bg-[#ff7043]" aria-label="Facebook">
                                <i class="fab fa-facebook-f text-white text-sm"></i>
                            </a>
                            <a href="#" class="w-10 h-10 flex items-center justify-center bg-[#FF8A65] rounded-md transition hover:bg-[#ff7043]" aria-label="Instagram">
                                <i class="fab fa-instagram text-white text-sm"></i>
                            </a>
                            <a href="#" class="w-10 h-10 flex items-center justify-center bg-[#FF8A65] rounded-md transition hover:bg-[#ff7043]" aria-label="Twitter">
                                <i class="fab fa-twitter text-white text-sm"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                No se encontraron publicaciones.
            </div>
        @endforelse
    </div>

    {{-- 📄 Paginación con más espacio --}}
    <div class="flex justify-center items-center space-x-2 mt-12 mb-24">

        {{-- Botón Anterior --}}
        @if ($posts->onFirstPage())
            <button class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl text-gray-400 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
        @else
            <a href="{{ $posts->previousPageUrl() }}" class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl hover:bg-gray-100 transition font-semibold">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
        @endif

        {{-- Números de página --}}
        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
            @if ($page == $posts->currentPage())
                <span class="w-12 h-12 flex items-center justify-center border border-blue-600 bg-blue-600 text-white rounded-xl font-semibold">
                    {{ $page }}
                </span>
            @elseif($page == 1 || $page == $posts->lastPage() || ($page >= $posts->currentPage() - 1 && $page <= $posts->currentPage() + 1))
                <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl hover:bg-gray-100 transition font-semibold">
                    {{ $page }}
                </a>
            @elseif($page == 2 && $posts->currentPage() > 4)
                <span class="px-2 text-gray-500">...</span>
            @elseif($page == $posts->lastPage() - 1 && $posts->currentPage() < $posts->lastPage() - 3)
                <span class="px-2 text-gray-500">...</span>
            @endif
        @endforeach

        {{-- Botón Siguiente --}}
        @if ($posts->hasMorePages())
            <a href="{{ $posts->nextPageUrl() }}" class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl hover:bg-gray-100 transition font-semibold">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        @else
            <button class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-xl text-gray-400 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif

    </div>

</div>

