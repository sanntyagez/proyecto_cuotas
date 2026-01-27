<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Permitimos que estos campos se puedan guardar
    protected $fillable = [
        'sale_id', 
        'numero_cuota', 
        'monto', 
        'fecha_vencimiento', 
        'estado', 
        'fecha_pago'
    ];
}