<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique(); // Email del suscriptor
            $table->string('name')->nullable(); // Opcional: nombre
            $table->boolean('subscribed')->default(true); // true si está suscrito
            $table->timestamp('unsubscribed_at')->nullable(); // Fecha de desuscripción
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
