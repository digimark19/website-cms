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
        Schema::create('menu_item_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('menu_item_translations')->nullOnDelete();
            $table->integer('position')->default(0);
            $table->string('locale_code', 5);  // 'es', 'en', 'fr'
            $table->string('title');           // título del menú
            $table->string('slug');            // slug para URL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_item_translations');
    }
};
