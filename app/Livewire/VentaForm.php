<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\sale;

class VentaForm extends Component
{
    // Definimos los campos de tu planilla
    public $name, $dni, $phone, $address;
    public $article, $total_value, $down_payment, $installments_count;

    public function save()
    {
        // 1. Guardamos los datos del Cliente
        $client = Client::create([
            'name' => $this->name,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        // 2. Calculamos el valor de la cuota: (Total - Entrega) / Cantidad
        $remainder = $this->total_value - $this->down_payment;
        $installment_value = $this->installments_count > 0 ? $remainder / $this->installments_count : 0;

        // 3. Guardamos la Venta vinculada al cliente
        sale::create([
            'client_id' => $client->id,
            'article' => $this->article,
            'total_value' => $this->total_value,
            'down_payment' => $this->down_payment,
            'installments_count' => $this->installments_count,
            'installment_value' => $installment_value,
        ]);

        session()->flash('message', '¡Venta registrada con éxito!');
        $this->reset(); // Limpia el formulario para el siguiente cliente
    }

    public function render()
    {
        return view('livewire.venta-form');
    }
}