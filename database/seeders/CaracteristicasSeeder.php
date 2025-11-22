<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaracteristicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        DB::table('caracteristicas')->insert([
            [
                'nombre' => json_encode(['es' => 'Metros cuadrados', 'en' => 'Square meters']),
                'tipo' => 'decimal'
            ],
            [
                'nombre' => json_encode(['es' => 'Baños', 'en' => 'Bathrooms']),
                'tipo' => 'decimal'
            ],
            [
                'nombre' => json_encode(['es' => 'Estacionamientos', 'en' => 'Parking']),
                'tipo' => 'numero'
            ],
            [
                'nombre' => json_encode(['es' => 'Recámaras', 'en' => 'Bedrooms']),
                'tipo' => 'numero'
            ],
            [
                'nombre' => json_encode(['es' => 'Terreno (m²)', 'en' => 'Land (sqft)']),
                'tipo' => 'decimal'
            ],
            [
                'nombre' => json_encode(['es' => 'Construcción (m²)', 'en' => 'Construction (sqft)']),
                'tipo' => 'decimal'
            ],
            [
                'nombre' => json_encode(['es' => 'Antigüedad', 'en' => 'Age']),
                'tipo' => 'numero'
            ],
            [
                'nombre' => json_encode(['es' => 'Alberca', 'en' => 'Pool']),
                'tipo' => 'booleano'
            ],
            [
                'nombre' => json_encode(['es' => 'Jardín', 'en' => 'Garden']),
                'tipo' => 'booleano'
            ],
            [
                'nombre' => json_encode(['es' => 'Aire acondicionado', 'en' => 'Air conditioning']),
                'tipo' => 'booleano'
            ],

        ]);
    }
}
