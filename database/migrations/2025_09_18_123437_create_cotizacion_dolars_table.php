<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(){
    Schema::create('cotizacion_dolars', function (Blueprint $table) {
        $table->id();
        $table->string('tipo'); // oficial, blue, bolsa, etc.
        $table->decimal('compra', 10, 2);
        $table->decimal('venta', 10, 2);
        $table->date('fecha');
        $table->timestamps();
    
        // Índices para búsquedas eficientes
        $table->index(['tipo', 'fecha']);
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacion_dolars');
    }
};
