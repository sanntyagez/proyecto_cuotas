<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    protected $fillable = [
    'client_id', 
    'article', 
    'total_value', 
    'down_payment', 
    'installments_count', 
    'installment_value'
];
}
