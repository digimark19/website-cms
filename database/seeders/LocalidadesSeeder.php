<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class LocalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('localidades')->insert([
            ['nombre' => json_encode(['es' => 'Playa del Carmen', 'en' => 'Playa del Carmen']), 'activo' => true],
            ['nombre' => json_encode(['es' => 'Tulum', 'en' => 'Tulum']), 'activo' => true],
            ['nombre' => json_encode(['es' => 'Cancún', 'en' => 'Cancun']), 'activo' => true],
            ['nombre' => json_encode(['es' => 'Puerto Morelos', 'en' => 'Puerto Morelos']), 'activo' => true],
            ['nombre' => json_encode(['es' => 'Cozumel', 'en' => 'Cozumel']), 'activo' => true],
            ['nombre' => json_encode(['es' => 'Isla Mujeres', 'en' => 'Isla Mujeres']), 'activo' => true],
            ['nombre' => json_encode(['es' => 'Bacalar', 'en' => 'Bacalar']), 'activo' => true],
            ['nombre' => json_encode(['es' => 'Mahahual', 'en' => 'Mahahual']), 'activo' => true],
            ['nombre' => json_encode(['es' => 'Akumal', 'en' => 'Akumal']), 'activo' => true],
            ['nombre' => json_encode(['es' => 'Felipe Carrillo Puerto', 'en' => 'Felipe Carrillo Puerto']), 'activo' => true],
        ]);
    }
}
