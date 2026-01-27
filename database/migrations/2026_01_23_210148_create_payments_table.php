<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // Vinculamos con la venta (Si borras la venta, se borran sus cuotas)
            $table->foreignId('sale_id')->constrained()->onDelete('cascade'); 
            
            $table->integer('numero_cuota');          // Ej: 1, 2, 3...
            $table->decimal('monto', 10, 2);          // Ej: 50000.00
            $table->date('fecha_vencimiento');        // Ej: 2026-02-26
            $table->date('fecha_pago')->nullable();   // Se llena cuando pagan
            $table->string('estado')->default('pendiente'); // pendiente/pagado
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};