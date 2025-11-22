<?php

namespace App\View\Components;

use App\Models\BlogPost;
use Illuminate\View\Component;

class Blog extends Component
{
    public $posts;
    public $search;

    /**
     * Crear nueva instancia del componente.
     */
    public function __construct($search = null, $limit = 6)
    {
        $this->search = $search;

        $query = BlogPost::with(['translation' => fn($q) => $q->where('lang', app()->getLocale())])
            ->where('status', 'published');

        if ($search) {
            $query->whereHas('translation', function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%")
                    ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(meta, '$.description')) LIKE ?", ["%{$search}%"]);
            });
        }

        $this->posts = $query->orderByDesc('created_at')->paginate($limit);
        // dd($this->posts);
    }

    /**
     * Renderizar la vista del componente.
     */
    public function render()
    {
        return view('components.blog', [
            'posts' => $this->posts,
            'search' => $this->search,
        ]);
    }
}
