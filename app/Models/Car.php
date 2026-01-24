<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand', // marca 
        'model', // modelo
        'plate', // patente
        'price', // precio
        'status', // disponible, apartado, vendido 
        'image_path' //subir imagenes 
    ];
}
