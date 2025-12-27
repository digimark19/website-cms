<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['title' => 'Home', 'slug' => 'home', 'position' => 1, 'custom_view' => 'home'],
            ['title' => 'Propiedades', 'slug' => 'propiedades', 'position' => 2, 'custom_view' => 'propiedades'],
            ['title' => 'Desarrollos', 'slug' => '#', 'position' => 3, 'custom_view' => 'desarrollos'],
            ['title' => 'Quiero vender', 'slug' => 'quiero-vender', 'position' => 4, 'custom_view' => 'quierovender'],
            ['title' => 'Blog', 'slug' => 'blog', 'position' => 5, 'custom_view' => 'blog'],
            ['title' => 'Nosotros', 'slug' => 'nosotros', 'position' => 6, 'custom_view' => 'nosotros'],
            ['title' => 'Contacto', 'slug' => 'contacto', 'position' => 7, 'custom_view' => 'contacto'],

            // 🔥 NUEVAS PÁGINAS
            ['title' => 'Aviso de privacidad', 'slug' => 'aviso-de-privacidad', 'position' => 8, 'custom_view' => 'avisoPrivacidad'],
            ['title' => 'Términos y condiciones', 'slug' => 'terminos-y-condiciones', 'position' => 9, 'custom_view' => 'terminosCondiciones'],
        ];

        foreach ($pages as $page) {

            // Insertar página base
            $pageId = DB::table('pages')->insertGetId([
                'custom_view' => $page['custom_view'],
                'is_active' => true,
                'position' => $page['position'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Traducciones
            $is_main = $page['slug'] === 'home' ? 1 : 0;

            DB::table('page_translations')->insert([
                [
                    'page_id' => $pageId,
                    'lang' => 'es',
                    'title' => $page['title'],
                    'slug' => $page['slug'],
                    'is_main' => $is_main,
                    'content' => "<h1>{$page['title']} (ES)</h1><p>Contenido en español.</p>",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'page_id' => $pageId,
                    'lang' => 'en',
                    'title' => match ($page['title']) {
                        'Home' => 'Home',
                        'Desarrollos' => '#',
                        'Propiedades' => 'Properties',
                        'Quiero vender' => 'Sell Your Property',
                        'Blog' => 'Blog',
                        'Nosotros' => 'About Us',
                        'Contacto' => 'Contact',
                        'Aviso de privacidad' => 'Privacy Policy',
                        'Términos y condiciones' => 'Terms and Conditions',
                        default => $page['title'],
                    },
                    'slug' => match ($page['slug']) {
                        'home' => 'home',
                        'desarrollos' => '#',
                        'propiedades' => 'properties',
                        'quiero-vender' => 'sell-your-property',
                        'blog' => 'blog',
                        'nosotros' => 'about-us',
                        'contacto' => 'contact',
                        'aviso-de-privacidad' => 'privacy-policy',
                        'terminos-y-condiciones' => 'terms-and-conditions',
                        default => $page['slug'],
                    },
                    'is_main' => $is_main,
                    'content' => "<h1>{$page['title']} (EN)</h1><p>English content here.</p>",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
