<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Page;
use App\Models\Section;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Obtener la página de Inicio (Home)
        // La identificamos por su vista personalizada o por su relación (asumiendo que es la que usa 'home')
        // 1. Obtener la página de Inicio (Home) buscar directo desde page_translations mediante el slug home
        $homePage = Page::whereHas('translations', function($q) {
            $q->where('slug', 'home');
        })->first();

        if (!$homePage) {
            $this->command->error("No se encontró la página de Inicio (slug='home').");
            return;
        }

        // Ya no usamos is_home

        // 2. Obtener la sección Hero
        $heroSection = Section::where('code', 'hero')->first();

        if (!$heroSection) {
            $this->command->error("No se encontró la sección Hero (code='hero').");
            return;
        }

        // 3. Definir el contenido (JSON)
        $content = [
            "es" => [
                "title" => "Dunarealty encuentra lo mejor para ti",
                "image" => "/storage/hero/hero.jpg"
            ],
            "en" => [
                "title" => "Dunarealty finds the best for you",
                "image" => "/storage/hero/hero.jpg"
            ]
        ];

        // 4. Insertar o actualizar en la tabla pivote
        // Usamos syncWithoutDetaching o una inserción directa con comprobación
        
        $exists = DB::table('page_section')
            ->where('page_id', $homePage->id)
            ->where('section_id', $heroSection->id)
            ->exists();

        if (!$exists) {
            DB::table('page_section')->insert([
                'page_id' => $homePage->id,
                'section_id' => $heroSection->id,
                'position' => 0, // Primera posición
                'content' => json_encode($content),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info("Sección Hero vinculada a la página de Inicio correctamente.");
        } else {
            // Si ya existe, actualizamos el contenido
            DB::table('page_section')
                ->where('page_id', $homePage->id)
                ->where('section_id', $heroSection->id)
                ->update([
                    'content' => json_encode($content),
                    'updated_at' => now(),
                ]);
            $this->command->info("Sección Hero actualizada en la página de Inicio.");
        }
    }
}
