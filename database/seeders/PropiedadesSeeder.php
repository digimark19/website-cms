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
            ['es'=>'Playa del Carmen','en'=>'Playa del Carmen'],
            ['es'=>'Tulum','en'=>'Tulum'],
            ['es'=>'Mérida','en'=>'Merida'],
            ['es'=>'Cancún','en'=>'Cancun'],
        ];
        foreach ($localidades as $loc) {
            DB::table('localidades')->insert([
                'nombre' => json_encode($loc),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $localidadesIds = DB::table('localidades')->pluck('id')->toArray();

        // Tipos de inmueble (incluyendo "Desarrollo")
        $tiposInmueble = ['Desarrollo','Departamento','Casa','Condominio','Villa'];
        foreach ($tiposInmueble as $tipo) {
            DB::table('tipos_inmueble')->insert([
                'nombre' => json_encode(['es'=>$tipo,'en'=>$tipo]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $tiposInmuebleIds = DB::table('tipos_inmueble')->pluck('id')->toArray();

        // Tipos de operación
        $tiposOperacion = ['Venta','Renta','Preventa','Alquiler vacacional'];
        foreach ($tiposOperacion as $op) {
            DB::table('tipos_operacion')->insert([
                'nombre' => json_encode(['es'=>$op,'en'=>$op]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $tiposOperacionIds = DB::table('tipos_operacion')->pluck('id')->toArray();

        // Generar propiedades
        for ($i = 1; $i <= 40; $i++) {
            $idTipoInmueble = $tiposInmuebleIds[array_rand($tiposInmuebleIds)];
            $idLocalidad = $localidadesIds[array_rand($localidadesIds)];
            $idTipoOperacion = $tiposOperacionIds[array_rand($tiposOperacionIds)];

            $precio = rand(100000, 1500000);

            DB::table('propiedades')->insert([
                'id_localidad' => $idLocalidad,
                'id_tipo_inmueble' => $idTipoInmueble,
                'id_tipo_operacion' => $idTipoOperacion,
                'nombre' => json_encode(['es'=>"Propiedad $i",'en'=>"Property $i"]),
                'descripcion' => json_encode(['es'=>"Descripción de propiedad $i",'en'=>"Description of property $i"]),
                'ubicacion' => json_encode(['es'=>"Ubicación $i",'en'=>"Location $i"]),
                'latitud' => rand(2000000, 2200000)/100000,
                'longitud' => rand(-9000000, -8700000)/100000,
                'precio' => $precio,
                'status' => 'disponible',
                'created_at' => now(),
                'updated_at' => now(),
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
