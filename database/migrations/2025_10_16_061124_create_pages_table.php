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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->integer('position')->default(0);
            $table->string('custom_view')->nullable();
            $table->timestamps();
        });

        Schema::create('page_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');
            $table->string('lang', 5);
            $table->string('title');
            $table->string('slug'); // quitamos ->unique()
            $table->boolean('is_main')->default(false);
            $table->longText('content')->nullable();
            $table->timestamps();

            // Cada página solo puede tener un idioma
            $table->unique(['page_id', 'lang']);

            // Opcional: hacer que slug sea único por idioma
            $table->unique(['slug', 'lang']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('page_translations');
    }
};
