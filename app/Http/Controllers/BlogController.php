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

        $post = BlogPost::with(['translation' => fn($q) => $q->where('lang', $lang)])
            ->whereHas('translation', fn($q) => $q->where('slug', $slug)->where('lang', $lang))
            ->firstOrFail();
        // dd($post);
        return view('pages.show', compact('post'));
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
