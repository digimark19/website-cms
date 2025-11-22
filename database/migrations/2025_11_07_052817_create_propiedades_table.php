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
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_localidad')->nullable()->constrained('localidades')->nullOnDelete();
            $table->foreignId('id_tipo_inmueble')->constrained('tipos_inmueble');
            $table->foreignId('id_tipo_operacion')->constrained('tipos_operacion');
            $table->json('nombre');
            $table->json('descripcion')->nullable();
            $table->json('ubicacion');
            $table->decimal('latitud', 10, 7)->nullable();
            $table->decimal('longitud', 10, 7)->nullable();
            $table->decimal('precio', 12, 2)->nullable();
            $table->string('status')->default('disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
};

