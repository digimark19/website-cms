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
        Schema::create('propiedad_amenidad', function (Blueprint $table) {
            $table->foreignId('id_propiedad')->constrained('propiedades')->cascadeOnDelete();
            $table->foreignId('id_amenidad')->constrained('amenidades')->cascadeOnDelete();
            $table->primary(['id_propiedad', 'id_amenidad']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedad_amenidad');
    }
};
