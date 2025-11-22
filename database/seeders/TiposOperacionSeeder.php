<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class TiposOperacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_operacion')->insert([
            ['nombre' => json_encode(['es' => 'Venta', 'en' => 'Sale'])],
            ['nombre' => json_encode(['es' => 'Renta', 'en' => 'Rent'])],
            ['nombre' => json_encode(['es' => 'Pre-venta', 'en' => 'Pre-sale'])],
        ]);
    }
}
