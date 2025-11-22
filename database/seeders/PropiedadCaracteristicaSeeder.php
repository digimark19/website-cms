<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropiedadCaracteristicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propiedades = DB::table('propiedades')->pluck('id')->toArray();
        $caracteristicas = DB::table('caracteristicas')->get();

        foreach ($propiedades as $propiedadId) {

            // 🔥 Escoger 4 características al azar para marcarlas como destacadas
            $destacadasIds = $caracteristicas->pluck('id')->shuffle()->take(4)->toArray();

            foreach ($caracteristicas as $caracteristica) {

                // Generar valores dependiendo del tipo
                $valor = null;

                switch ($caracteristica->tipo) {

                    case 'numero':
                        $valor = rand(1, 5); // Ej: recámaras, estacionamientos
                        break;

                    case 'decimal':
                        $valor = rand(40, 300); // Ej: metros cuadrados
                        break;

                    case 'booleano':
                        $valor = rand(0, 1) ? 'Sí' : 'No'; // Ej: jardín, alberca
                        break;

                    case 'texto':
                        $valor = 'N/A';
                        break;
                }

                DB::table('propiedad_caracteristica')->insert([
                    'propiedad_id'      => $propiedadId,
                    'caracteristica_id' => $caracteristica->id,
                    'valor'             => $valor,
                    'destacada'         => in_array($caracteristica->id, $destacadasIds),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }
        }
    }
}
