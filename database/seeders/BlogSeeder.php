<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // ======================
        // 1️⃣ CATEGORÍAS
        // ======================
        $categories = [
            ['es' => 'Noticias', 'en' => 'News'],
            ['es' => 'Guías', 'en' => 'Guides'],
            ['es' => 'Consejos', 'en' => 'Tips'],
        ];

        foreach ($categories as $cat) {
            $catId = DB::table('blog_categories')->insertGetId([
                'meta' => json_encode(['image' => null]),
                'sort_order' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach (['es', 'en'] as $lang) {
                DB::table('blog_category_translations')->insert([
                    'blog_category_id' => $catId,
                    'lang' => $lang,
                    'name' => $cat[$lang],
                    'slug' => Str::slug($cat[$lang]),
                    'meta' => json_encode([
                        'title' => $cat[$lang],
                        'description' => "Categoría {$cat[$lang]}",
                    ]),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // ======================
        // 2️⃣ TAGS
        // ======================
        $tags = [
            ['es' => 'Inmuebles', 'en' => 'Real Estate'],
            ['es' => 'Decoración', 'en' => 'Decoration'],
            ['es' => 'Arquitectura', 'en' => 'Architecture'],
            ['es' => 'Consejos de compra', 'en' => 'Buying Tips'],
            ['es' => 'Finanzas', 'en' => 'Finance'],
        ];

        $tagIds = [];
        foreach ($tags as $tag) {
            $tagId = DB::table('blog_tags')->insertGetId([
                'sort_order' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $tagIds[] = $tagId;

            foreach (['es', 'en'] as $lang) {
                DB::table('blog_tag_translations')->insert([
                    'blog_tag_id' => $tagId,
                    'lang' => $lang,
                    'name' => $tag[$lang],
                    'slug' => Str::slug($tag[$lang]),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // ======================
        // 3️⃣ POSTS
        // ======================
        $titles = [
            ['es' => 'Cómo elegir tu primera propiedad', 'en' => 'How to Choose Your First Property'],
            ['es' => 'Tendencias inmobiliarias 2025', 'en' => 'Real Estate Trends 2025'],
            ['es' => 'Errores comunes al comprar casa', 'en' => 'Common Mistakes When Buying a Home'],
            ['es' => 'Decoración moderna para departamentos pequeños', 'en' => 'Modern Decor for Small Apartments'],
            ['es' => 'Cómo obtener un crédito hipotecario', 'en' => 'How to Get a Mortgage Loan'],
            ['es' => 'Guía para invertir en bienes raíces', 'en' => 'Guide to Investing in Real Estate'],
            ['es' => 'Los mejores barrios para vivir en 2025', 'en' => 'Best Neighborhoods to Live in 2025'],
            ['es' => 'Qué debes saber antes de vender tu casa', 'en' => 'What You Should Know Before Selling Your House'],
            ['es' => 'Cómo remodelar con bajo presupuesto', 'en' => 'How to Remodel on a Budget'],
            ['es' => 'Beneficios de comprar sobre planos', 'en' => 'Benefits of Buying Off-Plan'],
            ['es' => 'Consejos para alquilar tu propiedad', 'en' => 'Tips for Renting Your Property'],
            ['es' => 'Claves para aumentar el valor de tu hogar', 'en' => 'Keys to Increase Your Home Value'],
        ];

        $socialExamples = [
            'facebook' => 'https://facebook.com/examplepost',
            'instagram' => 'https://instagram.com/examplepost',
            'twitter' => 'https://twitter.com/examplepost',
            'youtube' => 'https://youtube.com/examplepost'
        ];

        foreach ($titles as $i => $titleSet) {
            $postId = DB::table('blog_posts')->insertGetId([
                'category_id' => rand(1, 3),
                'author_name' => 'Admin',
                'status' => 'published',
                'published_at' => $now->copy()->subDays(rand(1, 60)),
                'social_links' => json_encode($socialExamples),
                'views' => rand(100, 5000),
                'is_featured' => $i % 4 === 0,
                'featured_image' => "https://picsum.photos/seed/post{$i}/1200/800",
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach (['es', 'en'] as $lang) {
                $title = $titleSet[$lang];
                $idioma = $lang === 'es' ? 'español' : 'inglés';
                $content = "<p>{$title}</p><p>Contenido de ejemplo para el post en {$idioma}. Este texto simula el contenido que se guarda desde un editor rich text.</p>";

                DB::table('blog_post_translations')->insert([
                    'blog_post_id' => $postId,
                    'lang' => $lang,
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'content' => $content,
                    'meta' => json_encode([
                        'title' => $title,
                        'description' => "Artículo sobre {$title}",
                        'keywords' => 'inmuebles, propiedades, consejos',
                    ]),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            // Asignar tags aleatorios (2 a 4 por post)
            $usedTags = collect($tagIds)->random(rand(2, 4));
            foreach ($usedTags as $tagId) {
                DB::table('blog_post_tag')->insert([
                    'blog_post_id' => $postId,
                    'blog_tag_id' => $tagId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
