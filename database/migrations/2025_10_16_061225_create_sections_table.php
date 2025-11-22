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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();  // identificador de la sección, ej: 'hero', 'contact_form'
            $table->string('name');            // nombre descriptivo
            $table->boolean('is_global')->default(false); // TRUE = sección global
            $table->json('content')->nullable();
            $table->boolean('is_active')->default(true)->comment('Indica si la sección está activa o no');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
