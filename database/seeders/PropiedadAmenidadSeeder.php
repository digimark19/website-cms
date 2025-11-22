<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropiedadAmenidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('propiedad_amenidad')->insert([
            ['id_propiedad' => 1, 'id_amenidad' => 1],
            ['id_propiedad' => 1, 'id_amenidad' => 4],
            ['id_propiedad' => 2, 'id_amenidad' => 2],
            ['id_propiedad' => 2, 'id_amenidad' => 3],
            ['id_propiedad' => 3, 'id_amenidad' => 5],
        ]);
    }
}
