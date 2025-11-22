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
        Schema::create('page_section', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->integer('position')->default(0);    // orden de la sección en la página
            $table->json('content')->nullable();        // datos dinámicos de la sección
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section');
    }
};
