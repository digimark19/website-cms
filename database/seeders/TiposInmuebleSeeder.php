<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposInmuebleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos_inmueble')->insert([
            ['nombre' => json_encode(['es' => 'Casa', 'en' => 'House'])],
            ['nombre' => json_encode(['es' => 'Departamento', 'en' => 'Apartment'])],
            ['nombre' => json_encode(['es' => 'Terreno', 'en' => 'Land'])],
            ['nombre' => json_encode(['es' => 'Local comercial', 'en' => 'Commercial Space'])],
            ['nombre' => json_encode(['es' => 'Desarrollo', 'en' => 'Development'])],
        ]);
    }
}
