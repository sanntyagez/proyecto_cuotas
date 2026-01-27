<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // Permitimos que se guarden todos estos datos
    protected $fillable = [
        'client_id', 
        'article', 
        'total_value', 
        'down_payment', 
        'installments_count', 
        'installment_value',
        // Campos nuevos del sistema avanzado
        'saldo_pendiente',
        'cuotas_restantes',
        'valor_cuota_actual',
        'proximo_vencimiento',
        'estado'
    ];

    // RELACIÓN 1: Una venta PERTENECE a un Cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // RELACIÓN 2: Una venta TIENE MUCHOS Pagos (Cuotas)
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}