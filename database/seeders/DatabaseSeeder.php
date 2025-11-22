<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            LocalesSeeder::class,
            MenuItemsSeeder::class,
            SectionsSeeder::class,
            SiteSettingsSeeder::class,
            BlogSeeder::class,
            PagesSeeder::class,
            TiposInmuebleSeeder::class,
            TiposOperacionSeeder::class,
            AmenidadesSeeder::class,
            LocalidadesSeeder::class,
            PropiedadesSeeder::class,
            PropiedadAmenidadSeeder::class,
            GaleriasSeeder::class,
            CaracteristicasSeeder::class,
            PropiedadCaracteristicaSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
