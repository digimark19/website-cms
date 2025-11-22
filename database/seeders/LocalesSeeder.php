<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('locales')->insert([
           [
                'code' => 'es',
                'name' => 'Español',
                'native_name' => 'Español',
                'url_prefix' => null, // sin prefijo
                'is_default' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'en',
                'name' => 'English',
                'native_name' => 'English',
                'url_prefix' => 'en',
                'is_default' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'fr',
                'name' => 'Français',
                'native_name' => 'Français',
                'url_prefix' => 'fr',
                'is_default' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
