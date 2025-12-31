<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropiedadesSeeder extends Seeder
{
    public function run(): void
    {
        // Localidades
        $localidades = [
            ['es' => 'La Paz BCS',     'en' => 'La Paz BCS'],
            ['es' => 'Mazatlán Sinaloa',  'en' => 'Mazatlan Sinaloa'],
            // ['es' => 'Mérida',    'en' => 'Merida'],
            // ['es' => 'Culiacán',  'en' => 'Culiacan'],
        ];

        foreach ($localidades as $loc) {
            DB::table('localidades')->insert([
                'nombre' => json_encode($loc),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // IDs de localidades insertadas
        $localidadesIds = DB::table('localidades')->pluck('id')->toArray();


        // Tipos de inmueble
        DB::table('tipos_inmueble')->insert([
            ['nombre' => json_encode(['es' => 'Casa',           'en' => 'House'])],
            ['nombre' => json_encode(['es' => 'Departamento',   'en' => 'Apartment'])],
            ['nombre' => json_encode(['es' => 'Terreno',        'en' => 'Land'])],
            ['nombre' => json_encode(['es' => 'Local',          'en' => 'Shop'])],
            ['nombre' => json_encode(['es' => 'Oficina',        'en' => 'Office'])],
            ['nombre' => json_encode(['es' => 'Desarrollo',     'en' => 'Development'])],
        ]);

        // IDs tipos de inmueble
        $tiposInmuebleIds = DB::table('tipos_inmueble')->pluck('id')->toArray();


        // Tipos de operación
        DB::table('tipos_operacion')->insert([
            ['nombre' => json_encode(['es' => 'Venta',    'en' => 'Sale'])],
            ['nombre' => json_encode(['es' => 'Renta',    'en' => 'Rent'])],
            // ['nombre' => json_encode(['es' => 'Pre-venta','en' => 'Pre-sale'])],
        ]);

        // IDs tipos de operación
        $tiposOperacionIds = DB::table('tipos_operacion')->pluck('id')->toArray();


        // Generar propiedades fake
        for ($i = 1; $i <= 40; $i++) {

            $idTipoInmueble = $tiposInmuebleIds[array_rand($tiposInmuebleIds)];
            $idLocalidad = $localidadesIds[array_rand($localidadesIds)];
            $idTipoOperacion = $tiposOperacionIds[array_rand($tiposOperacionIds)];

            $precio = rand(100000, 1500000);

            DB::table('propiedades')->insert([
                'id_localidad'       => $idLocalidad,
                'id_tipo_inmueble'   => $idTipoInmueble,
                'id_tipo_operacion'  => $idTipoOperacion,
                'nombre'             => json_encode(['es' => "Propiedad $i", 'en' => "Property $i"]),
                'descripcion'        => json_encode(['es' => "Descripción de propiedad $i", 'en' => "Description of property $i"]),
                'ubicacion'          => json_encode(['es' => "Ubicación $i", 'en' => "Location $i"]),
                'latitud'            => rand(2000000, 2200000) / 100000,
                'longitud'           => rand(-9000000, -8700000) / 100000,
                'precio'             => json_encode([
                    'es' => ['precio' => $precio, 'moneda' => 'MXN'],
                    'en' => ['precio' => round($precio / 20, 2), 'moneda' => 'USD']
                ]),
                'status'             => 'disponible',
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }

        // Galerías para propiedades
        $propiedadesIds = DB::table('propiedades')->pluck('id')->toArray();
        foreach ($propiedadesIds as $propId) {
            $numImages = rand(2,5);
            for ($j=1; $j<=$numImages; $j++) {
                DB::table('galerias')->insert([
                    'id_propiedad' => $propId,
                    'imagen_url' => "propiedad_$propId/image_$j.jpg",
                    'descripcion' => "Imagen $j de propiedad $propId",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
