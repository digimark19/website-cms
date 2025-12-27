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
        DB::table('menu_items')->truncate();
        DB::table('menu_item_translations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $pages = [
            ['slug' => 'inicio', 'position' => 1],
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

        foreach ($pages as $page) {
            $menuItemId = DB::table('menu_items')->insertGetId([
                'menu_code' => 'main',
                'parent_id' => null,
                'position' => $page['position'],
                'is_active' => true,
            ]);

            $titleEs = $page['title_es'] ?? ucfirst(str_replace('-', ' ', $page['slug']));

            // Traducción del slug al inglés
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

            DB::table('menu_item_translations')->insert([
                [
                    'menu_item_id' => $menuItemId,
                    'locale_code' => 'es',
                    'title' => $titleEs,
                    'slug' => $page['slug'],
                ],
                [
                    'menu_item_id' => $menuItemId,
                    'locale_code' => 'en',
                    'title' => $titleEn,
                    'slug' => $slugEn,
                ],
            ]);

            // Insertar hijos si existen
            if (isset($page['children']) && is_array($page['children'])) {
                foreach ($page['children'] as $index => $child) {
                    $childId = DB::table('menu_items')->insertGetId([
                        'menu_code' => 'main',
                        'parent_id' => $menuItemId,
                        'position' => $index + 1,
                        'is_active' => true,
                    ]);

                    DB::table('menu_item_translations')->insert([
                        [
                            'menu_item_id' => $childId,
                            'locale_code' => 'es',
                            'title' => $child['title_es'],
                            'slug' => $child['slug'],
                        ],
                        [
                            'menu_item_id' => $childId,
                            'locale_code' => 'en',
                            'title' => $child['title_en'] ?? $child['title_es'],
                            'slug' => $child['slug'], // Asumimos mismo slug para simplificar, o agregar lógica si se requiere distinto
                        ],
                    ]);
                }
            }
        }
    }
}
