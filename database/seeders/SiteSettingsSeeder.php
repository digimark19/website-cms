<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 👈 ESTA LÍNEA ES CLAVE

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->insert([
            'site_name' => 'Inmobien Inmobiliaria',
            'site_title' => 'Tu espacio, tu futuro',
            'site_description' => 'Líderes en bienes raíces con proyectos de alta plusvalía y diseño innovador.',
            'logo_path' => 'storage/images/logos/logo.png',
            'favicon_path' => 'storage/images/logos/favicon.png',

            // Contacto
            'address' => 'Av. Reforma 123, Mazatlán',
            'city' => 'Mazatlán',
            'state' => 'Sinaloa',
            'country' => 'México',
            'postal_code' => '01000',
            'phone' => '+52 1 669 160 0136',
            'mobile' => '+52 1 669 160 0136',
            'whatsapp' => '5216691600136',
            'whatsapp_message' => json_encode([
                "en" => "Hello! I’d like to know more about your services.",
                "es" => "¡Hola! Me gustaría saber más sobre sus servicios.",
                "fr" => "Bonjour ! J’aimerais en savoir plus sur vos services.",
            ]),
            'email' => 'rachel@inmobien.com',

            // Redes sociales
            'facebook_url' => 'https://facebook.com/exagonoinmobiliaria',
            'instagram_url' => 'https://instagram.com/exagonoinmobiliaria',
            'twitter_url' => 'https://twitter.com/exagonoinmo',
            'linkedin_url' => 'https://linkedin.com/company/exagono',
            'youtube_url' => 'https://youtube.com/@exagonoinmobiliaria',
            'tiktok_url' => 'https://tiktok.com/@exagonoinmobiliaria',

            // Mapa
            'latitude' => 23.237033,
            'longitude' => -106.436120,
            'zoom' => 16,

            // Configuraciones
            'language' => 'es',
            'is_active' => true,
            'extra' => json_encode([
                'schedule' => 'Lunes a Viernes: 9:00 - 18:00',
                'support_email' => 'rachel@inmobien.com',
                'theme_color' => '#004aad',
            ]),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
