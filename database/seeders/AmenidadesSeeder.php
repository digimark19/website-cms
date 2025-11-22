<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('amenidades')->insert([
            ['nombre' => json_encode(['es' => 'Alberca', 'en' => 'Pool']), 'icono' => 'pool.svg'],
            ['nombre' => json_encode(['es' => 'Gimnasio', 'en' => 'Gym']), 'icono' => 'gym.svg'],
            ['nombre' => json_encode(['es' => 'Casa club', 'en' => 'Clubhouse']), 'icono' => 'clubhouse.svg'],
            ['nombre' => json_encode(['es' => 'Seguridad 24h', 'en' => '24h Security']), 'icono' => 'security.svg'],
            ['nombre' => json_encode(['es' => 'Área verde', 'en' => 'Green Area']), 'icono' => 'green.svg'],
        ]);
    }
}
