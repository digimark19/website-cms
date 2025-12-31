<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Primero, migrar los datos existentes
        $propiedades = DB::table('propiedades')->get();
        
        foreach ($propiedades as $propiedad) {
            $precioActual = $propiedad->precio ?? 0;
            
            $precioJson = json_encode([
                'es' => [
                    'precio' => $precioActual,
                    'moneda' => 'MXN'
                ],
                'en' => [
                    'precio' => round($precioActual / 20, 2),
                    'moneda' => 'USD'
                ]
            ]);
            
            DB::table('propiedades')
                ->where('id', $propiedad->id)
                ->update(['precio' => $precioJson]);
        }
        
        // Cambiar el tipo de columna a JSON
        Schema::table('propiedades', function (Blueprint $table) {
            $table->json('precio')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir a decimal, tomando el precio en español
        $propiedades = DB::table('propiedades')->get();
        
        foreach ($propiedades as $propiedad) {
            $precioData = json_decode($propiedad->precio, true);
            $precioDecimal = $precioData['es']['precio'] ?? 0;
            
            DB::table('propiedades')
                ->where('id', $propiedad->id)
                ->update(['precio' => $precioDecimal]);
        }
        
        Schema::table('propiedades', function (Blueprint $table) {
            $table->decimal('precio', 12, 2)->nullable()->change();
        });
    }
};
