<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar tablas para evitar duplicados
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('menus')->truncate();
        DB::table('menu_item_translations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $pages = [
            // ['slug' => 'inicio', 'position' => 1],
            ['slug' => 'propiedades', 'position' => 2],
            [
                'slug' => '#', 
                'position' => 3, 
                'title_es' => 'Desarrollos',
                'title_en' => 'Developments',
                'children' => [
                    ['slug' => 'torre-futura', 'title_es' => 'Torre Futura', 'title_en' => 'Future Tower'],
                    ['slug' => 'residencial-verde', 'title_es' => 'Residencial Verde', 'title_en' => 'Green Residential'],
                    ['slug' => 'lago-azul', 'title_es' => 'Lago Azul', 'title_en' => 'Blue Lake'],
                ]
            ],
            ['slug' => 'quiero-vender', 'position' => 4],
            ['slug' => 'blog', 'position' => 5],
            ['slug' => 'nosotros', 'position' => 6],
            ['slug' => 'contacto', 'position' => 7],
        ];

        $menus = [
            'main' => $pages,
            'footer' => array_filter($pages, fn($page) => !isset($page['children'])),
        ];

        foreach ($menus as $menuCode => $menuPages) {
            // 1. Insertar el Menú (el "padre" conceptual de la colección)
            $menuId = DB::table('menus')->insertGetId([
                'menu_code' => $menuCode,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($menuPages as $page) {
                // Preparar datos comunes
                $titleEs = $page['title_es'] ?? ucfirst(str_replace('-', ' ', $page['slug']));
                $slugEn = match ($page['slug']) {
                    'inicio' => 'home',
                    'propiedades' => 'properties',
                    'quiero-vender' => 'sell-your-property',
                    'blog' => 'blog',
                    'nosotros' => 'about-us',
                    'contacto' => 'contact',
                    default => $page['slug'],
                };
                $titleEn = $page['title_en'] ?? ucfirst(str_replace('-', ' ', $slugEn));

                // 2. Insertar Translations directamente (ahora actúan como los items)
                
                // ES
                $parentIdEs = DB::table('menu_item_translations')->insertGetId([
                    'menu_id' => $menuId,
                    'parent_id' => null,
                    'position' => $page['position'],
                    'locale_code' => 'es',
                    'title' => $titleEs,
                    'slug' => $page['slug'],
                ]);

                // EN
                $parentIdEn = DB::table('menu_item_translations')->insertGetId([
                    'menu_id' => $menuId,
                    'parent_id' => null,
                    'position' => $page['position'],
                    'locale_code' => 'en',
                    'title' => $titleEn,
                    'slug' => $slugEn,
                ]);

                // Insertar hijos si existen
                if (isset($page['children']) && is_array($page['children'])) {
                    foreach ($page['children'] as $index => $child) {
                        // ES Child
                        DB::table('menu_item_translations')->insert([
                            'menu_id' => $menuId,
                            'parent_id' => $parentIdEs,
                            'position' => $index + 1,
                            'locale_code' => 'es',
                            'title' => $child['title_es'],
                            'slug' => $child['slug'],
                        ]);

                        // EN Child
                        DB::table('menu_item_translations')->insert([
                            'menu_id' => $menuId,
                            'parent_id' => $parentIdEn,
                            'position' => $index + 1,
                            'locale_code' => 'en',
                            'title' => $child['title_en'] ?? $child['title_es'],
                            'slug' => $child['slug'],
                        ]);
                    }
                }
            }
        }
    }
}
