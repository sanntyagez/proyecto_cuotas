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
       Schema::create('sales', function (Blueprint $table) {
    $table->id();
    $table->foreignId('client_id')->constrained(); // Conecta con el cliente
    $table->string('article');
    $table->decimal('total_value', 15, 2);
    $table->decimal('down_payment', 15, 2); // Entrega
    $table->integer('installments_count');  // Cantidad de cuotas
    $table->decimal('installment_value', 15, 2);
    $table->timestamps();
   });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
