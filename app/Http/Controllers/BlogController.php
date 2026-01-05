<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPostTranslation;
use App\Models\BlogCategoryTranslation;
use App\Models\BlogTagTranslation;
use App\Models\BlogPost;

class BlogController extends Controller
{
    /**
     * Listado general de posts (opcional búsqueda)
     */
    public function index(Request $request)
    {
        $lang = app()->getLocale();
        $search = $request->input('search');

        $query = BlogPost::with(['translation' => fn($q) => $q->where('lang', $lang)])
            ->where('status', 'published');

        if ($search) {
            $query->whereHas('translation', function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        $posts = $query->orderByDesc('created_at')->paginate(6);

        return view('pages.blog', compact('posts', 'search'));
    }

    /**
     * Mostrar post individual por slug
     */
    public function show($slug)
    {
        $lang = app()->getLocale();

        // 1. Obtener el post actual con su traducción
        $post = BlogPost::with(['translation' => fn($q) => $q->where('lang', $lang), 'category.translations'])
            ->whereHas('translation', fn($q) => $q->where('slug', $slug)->where('lang', $lang))
            ->firstOrFail();

        // 2. Obtener categorías activas (con traducciones)
        $categories = \App\Models\BlogCategory::with(['translations' => fn($q) => $q->where('lang', $lang)])
            ->get();

        // 3. Obtener posts recientes (los últimos 5)
        $recentPosts = BlogPost::with(['translation' => fn($q) => $q->where('lang', $lang)])
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->limit(5)
            ->get();

        // 4. Obtener posts relacionados (misma categoría)
        $relatedPosts = BlogPost::with(['translation' => fn($q) => $q->where('lang', $lang)])
            ->where('status', 'published')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();

        return view('pages.show', compact('post', 'categories', 'recentPosts', 'relatedPosts'));
    }

    /**
     * Listado de posts por categoría
     */
    public function category($slug)
    {
        $lang = app()->getLocale();

        $category = BlogCategoryTranslation::where('slug', $slug)
            ->where('lang', $lang)
            ->firstOrFail();

        $posts = BlogPost::where('status', 'published')
            ->where('category_id', $category->blog_category_id)
            ->with(['translation' => fn($q) => $q->where('lang', $lang)])
            ->orderByDesc('created_at')
            ->paginate(6);

        return view('pages.blog', [
            'posts' => $posts,
            'category' => $category,
        ]);
    }

    /**
     * Listado de posts por tag
     */
    public function tag($slug)
    {
        $lang = app()->getLocale();

        $tag = BlogTagTranslation::where('slug', $slug)
            ->where('lang', $lang)
            ->firstOrFail();

        $posts = BlogPost::where('status', 'published')
            ->whereHas('tags', fn($q) => $q->where('id', $tag->blog_tag_id))
            ->with(['translation' => fn($q) => $q->where('lang', $lang)])
            ->orderByDesc('created_at')
            ->paginate(6);

        return view('pages.blog', [
            'posts' => $posts,
            'tag' => $tag,
        ]);
    }
}
