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
    Schema::table('sales', function (Blueprint $table) {
        // Agregamos ->default(0) para que SQLite no se queje
        $table->decimal('saldo_pendiente', 12, 2)->default(0)->after('total_value'); 
        
        $table->integer('cuotas_restantes')->default(0)->after('installments_count'); 
        
        $table->decimal('valor_cuota_actual', 10, 2)->default(0)->after('installment_value'); 
        
        // Este ya estaba bien porque es nullable
        $table->date('proximo_vencimiento')->nullable()->after('updated_at'); 
        
        // Este ya tenía default
        $table->string('estado')->default('al_dia'); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }
};
