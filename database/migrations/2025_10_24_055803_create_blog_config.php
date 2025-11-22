<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * CATEGORIES (base) + TRANSLATIONS
         */
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            // Campos no translatables de categoría (por ejemplo, imagen, orden, flags)
            $table->json('meta')->nullable(); // metadata general (ej. imagen)
            $table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blog_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_category_id')->constrained('blog_categories')->cascadeOnDelete();
            $table->string('lang', 5); // 'es', 'en', etc.
            $table->string('name');
            $table->string('slug');
            $table->json('meta')->nullable(); // SEO por idioma
            $table->timestamps();

            // Un registro por idioma por categoría
            $table->unique(['blog_category_id', 'lang']);
            // Slug único por idioma (evita colisiones en rutas)
            $table->unique(['slug', 'lang']);
        });

        /**
         * TAGS (base) + TRANSLATIONS
         */
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blog_tag_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_tag_id')->constrained('blog_tags')->cascadeOnDelete();
            $table->string('lang', 5);
            $table->string('name');
            $table->string('slug');
            $table->timestamps();

            $table->unique(['blog_tag_id', 'lang']);
            $table->unique(['slug', 'lang']);
        });

        /**
         * POSTS (base) + TRANSLATIONS
         */
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('blog_categories')->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete()->comment('Relacion opcional al usuario autor (si aplica)');
            // Si no usas users table, puedes cambiar author_id por author_name string
            $table->string('author_name')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            // Social links flexibles en JSON { "facebook": "...", "instagram": "...", ... }
            $table->json('social_links')->nullable();
            // Campos que no se traducen (views, featured flag, featured image)
            $table->unsignedBigInteger('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->string('featured_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blog_post_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id')->constrained('blog_posts')->cascadeOnDelete();
            $table->string('lang', 5); // 'es', 'en', ...
            $table->string('title');
            $table->string('slug'); // slug por idioma
            $table->longText('content'); // HTML del rich text
            $table->json('meta')->nullable(); // SEO por idioma { title, description, keywords }
            $table->timestamps();

            // Una traducción por idioma por post
            $table->unique(['blog_post_id', 'lang']);
            // Slug único por idioma (evita colisiones en rutas)
            $table->unique(['slug', 'lang']);
        });

        /**
         * PIVOT posts <-> tags
         */
        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id')->constrained('blog_posts')->cascadeOnDelete();
            $table->foreignId('blog_tag_id')->constrained('blog_tags')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['blog_post_id', 'blog_tag_id']);
        });

        /**
         * INDEXES ADICIONALES (opcional pero recomendado)
         * - Buscar posts por status/published_at/fecha/visitas etc.
         */
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->index(['status', 'published_at']);
            $table->index('views');
            $table->index('is_featured');
        });

        Schema::table('blog_post_translations', function (Blueprint $table) {
            $table->index(['lang', 'slug']);
        });

        Schema::table('blog_category_translations', function (Blueprint $table) {
            $table->index(['lang', 'slug']);
        });

        Schema::table('blog_tag_translations', function (Blueprint $table) {
            $table->index(['lang', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop in reverse order to avoid foreign key issues
        Schema::table('blog_tag_translations', function (Blueprint $table) {
            $table->dropIndex(['lang', 'slug']);
        });
        Schema::table('blog_category_translations', function (Blueprint $table) {
            $table->dropIndex(['lang', 'slug']);
        });
        Schema::table('blog_post_translations', function (Blueprint $table) {
            $table->dropIndex(['lang', 'slug']);
        });
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex(['status', 'published_at']);
            $table->dropIndex(['views']);
            $table->dropIndex(['is_featured']);
        });

        Schema::dropIfExists('blog_post_tag');
        Schema::dropIfExists('blog_post_translations');
        Schema::dropIfExists('blog_posts');

        Schema::dropIfExists('blog_tag_translations');
        Schema::dropIfExists('blog_tags');

        Schema::dropIfExists('blog_category_translations');
        Schema::dropIfExists('blog_categories');
    }
};
