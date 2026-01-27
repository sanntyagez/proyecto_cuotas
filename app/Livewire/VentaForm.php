<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Sale;    // Asegúrate de que sea mayúscula si tu archivo es Sale.php
use App\Models\Payment; // ¡Importante para crear las cuotas!
use Carbon\Carbon;      // ¡Importante para las fechas!

class VentaForm extends Component
{
    // 1. Definimos los campos del formulario
    public $name, $dni, $phone, $address;
    public $article, $total_value, $down_payment, $installments_count;

    // Reglas de validación (para que no guarden vacío)
    protected $rules = [
        'name' => 'required',
        'dni' => 'required',
        'article' => 'required',
        'total_value' => 'required|numeric',
        'installments_count' => 'required|integer|min:1',
    ];

    public function save()
    {
        // Validamos antes de seguir
        $this->validate();

        // A. CÁLCULOS MATEMÁTICOS (Todo ocurre aquí dentro)
   
        $saldo_a_financiar = $this->total_value - ($this->down_payment ?? 0);
        
        // Evitamos división por cero
        $cantidad_cuotas = $this->installments_count > 0 ? $this->installments_count : 1;
        $valor_cuota = $saldo_a_financiar / $cantidad_cuotas;

        // Fecha del primer vencimiento (1 mes a partir de hoy)
        $primer_vencimiento = Carbon::now()->addMonth();

        // B. GUARDADO EN BASE DE DATOS
        
        // 1. Crear Cliente
        $client = Client::create([
            'name' => $this->name,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        // 2. Crear Venta (Aquí unimos los datos del form + los cálculos)
        $sale = Sale::create([
            'client_id' => $client->id,
            'article' => $this->article,
            'total_value' => $this->total_value,
            'down_payment' => $this->down_payment ?? 0,
            'installments_count' => $this->installments_count,
            'installment_value' => $valor_cuota,
            
            // CAMPOS NUEVOS PARA EL SISTEMA AVANZADO
            'saldo_pendiente' => $saldo_a_financiar,
            'cuotas_restantes' => $this->installments_count,
            'valor_cuota_actual' => $valor_cuota,
            'proximo_vencimiento' => $primer_vencimiento,
            'estado' => 'al_dia'
        ]);

        // 3. Generar las Cuotas Individuales (Tabla Payments)
        for ($i = 1; $i <= $this->installments_count; $i++) {
            Payment::create([
                'sale_id' => $sale->id,
                'numero_cuota' => $i,
                'monto' => $valor_cuota,
                'fecha_vencimiento' => Carbon::now()->addMonths($i),
                'estado' => 'pendiente',
            ]);
        }
        // C. LIMPIEZA
        session()->flash('message', '¡Venta registrada y cuotas generadas correctamente!');
        $this->reset(); 
    }

    public function render()
    {
        return view('livewire.venta-form');
    }
}