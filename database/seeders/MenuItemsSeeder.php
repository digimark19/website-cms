<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['slug' => 'home', 'position' => 1],
            ['slug' => 'propiedades', 'position' => 2],
            ['slug' => 'desarrollos', 'position' => 3],
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

            $titleEs = ucfirst(str_replace('-', ' ', $page['slug']));

            // Traducción del slug al inglés
            $slugEn = match ($page['slug']) {
                'home' => 'home',
                'propiedades' => 'properties',
                'desarrollos' => 'developments',
                'quiero-vender' => 'sell-your-property',
                'blog' => 'blog',
                'nosotros' => 'about-us',
                'contacto' => 'contact',
                default => $page['slug'],
            };

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
                    'title' => ucfirst(str_replace('-', ' ', $slugEn)),
                    'slug' => $slugEn,
                ],
                // [
                //     'menu_item_id' => $menuItemId,
                //     'locale_code' => 'fr',
                //     'title' => $titleEs, // podrías traducir también si lo deseas
                //     'slug' => $page['slug'],
                // ],
            ]);
        }
    }
}
