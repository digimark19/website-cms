<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            $nombreEs = "Propiedad $i";

            DB::table('propiedades')->insert([
                'id_localidad'       => $idLocalidad,
                'id_tipo_inmueble'   => $idTipoInmueble,
                'id_tipo_operacion'  => $idTipoOperacion,
                'nombre'             => json_encode(['es' => $nombreEs, 'en' => "Property $i"]),
                'slug'               => Str::slug($nombreEs . " " . uniqid()),
                'descripcion'        => json_encode([
                    'es' => '
                        <h4 class="text-xl font-bold text-[#052669] mb-3">Exclusividad y Confort</h4>
                        <p class="mb-4">
                            Descubre esta magnífica propiedad diseñada para quienes buscan un estilo de vida sofisticado sin renunciar a la comodidad. 
                            Ubicada en una de las zonas más privilegiadas, esta residencia combina arquitectura moderna con acabados de primera calidad. 
                            Cada rincón ha sido pensado para maximizar la luz natural y ofrecer vistas inigualables.
                        </p>

                        <h4 class="text-xl font-bold text-[#052669] mb-3">Detalles que Enamoran</h4>
                        <ul class="list-none space-y-3 mb-6">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-[#0AB3B6] mt-1"></i>
                                <span><strong>Espacios Abiertos:</strong> Sala y comedor con doble altura, creando una atmósfera de amplitud y elegancia incomparable.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-[#0AB3B6] mt-1"></i>
                                <span><strong>Cocina Gourmet:</strong> Equipada con isla de cuarzo, electrodomésticos premium y acabados en madera fina.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-[#0AB3B6] mt-1"></i>
                                <span><strong>Master Suite:</strong> Un santuario personal con walking closet de diseñador y baño tipo spa con tina de hidromasaje.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-[#0AB3B6] mt-1"></i>
                                <span><strong>Área Social:</strong> Terraza techada con asador profesional y jardín con paisajismo, ideal para tus reuniones.</span>
                            </li>
                        </ul>

                        <div class="bg-gray-50 border-l-4 border-[#0AB3B6] p-6 rounded-r-xl my-6">
                            <p class="italic text-gray-600 font-medium">
                                "Una oportunidad única de inversión donde el lujo se encuentra con la funcionalidad. 
                                Vivir aquí es garantizar un patrimonio de alta plusvalía para tu familia."
                            </p>
                        </div>

                        <h4 class="text-xl font-bold text-[#052669] mb-3">Ubicación Estratégica</h4>
                        <p class="mb-4">
                            Conectividad inmediata a las principales vías de la ciudad. A pasos de centros comerciales exclusivos, 
                            colegios de renombre y hospitales de primer nivel. Disfruta de la tranquilidad de un entorno seguro 
                            sin alejarte de la vibrante vida urbana.
                        </p>
                    ',
                    'en' => '
                        <h4 class="text-xl font-bold text-[#052669] mb-3">Exclusivity and Comfort</h4>
                        <p class="mb-4">
                            Discover this magnificent property designed for those seeking a sophisticated lifestyle without sacrificing comfort.
                            Located in one of the most privileged areas, this residence combines modern architecture with top-quality finishes.
                            Every corner has been thought out to maximize natural light and offer unparalleled views.
                        </p>

                        <h4 class="text-xl font-bold text-[#052669] mb-3">Details to Love</h4>
                        <ul class="list-none space-y-3 mb-6">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-[#0AB3B6] mt-1"></i>
                                <span><strong>Open Spaces:</strong> Living and dining room with double height, creating an atmosphere of breadth and incomparable elegance.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-[#0AB3B6] mt-1"></i>
                                <span><strong>Gourmet Kitchen:</strong> Equipped with quartz island, premium appliances, and fine wood finishes.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-[#0AB3B6] mt-1"></i>
                                <span><strong>Master Suite:</strong> A personal sanctuary with a designer walking closet and spa-like bathroom with a whirlpool tub.</span>
                            </li>
                        </ul>

                         <div class="bg-gray-50 border-l-4 border-[#0AB3B6] p-6 rounded-r-xl my-6">
                            <p class="italic text-gray-600 font-medium">
                                "A unique investment opportunity where luxury meets functionality.
                                Living here guarantees high appreciation assets for your family."
                            </p>
                        </div>
                    '
                ]),
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
