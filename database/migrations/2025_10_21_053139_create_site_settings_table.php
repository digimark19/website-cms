<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
       public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable()->comment('Nombre del sitio o empresa');
            $table->string('site_title')->nullable()->comment('Título principal del sitio');
            $table->string('site_description', 500)->nullable()->comment('Descripción general del sitio');
            $table->string('logo_path')->nullable()->comment('Ruta o URL del logo principal');
            $table->string('favicon_path')->nullable()->comment('Ruta o URL del favicon');

            // 📍 Información de contacto
            $table->string('address')->nullable()->comment('Dirección física');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->json('whatsapp_message')->nullable()->comment('Mensajes de WhatsApp por idioma');
            $table->string('email')->nullable();

            // 🌐 Redes sociales
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();

            // 📍 Ubicación para mapa
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('zoom')->nullable();

            // ⚙️ Configuraciones extra
            $table->string('language', 10)->default('es')->comment('Idioma por defecto');
            $table->boolean('is_active')->default(true);
            $table->json('extra')->nullable()->comment('Campo flexible para otros datos globales');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
