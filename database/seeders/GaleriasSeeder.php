<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('galerias')->insert([
            [
                'id_propiedad' => 1,
                'imagen_url' => 'https://example.com/images/casa-mar.jpg',
                'descripcion' => 'Vista frontal de la casa frente al mar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_propiedad' => 1,
                'imagen_url' => 'https://example.com/images/interior-mar.jpg',
                'descripcion' => 'Interior moderno y espacioso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_propiedad' => 2,
                'imagen_url' => 'https://example.com/images/departamento-selva.jpg',
                'descripcion' => 'Vista desde la terraza privada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_propiedad' => 3,
                'imagen_url' => 'https://example.com/images/terreno-cancun.jpg',
                'descripcion' => 'Vista aérea del terreno',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
