<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Sale;    
use App\Models\Payment; 
use Carbon\Carbon;      

class VentaForm extends Component
{
    public $name, $dni, $phone, $address;
    public $article, $total_value, $down_payment, $installments_count;

    protected $rules = [
        'name' => 'required',
        'dni' => 'required',
        'article' => 'required',
        'total_value' => 'required|numeric',
        'installments_count' => 'required|integer|min:1',
    ];

    public function save()
    {
        // 1. LIMPIEZA: Quitamos los puntos antes de cualquier otra cosa
        if ($this->total_value) {
            $this->total_value = str_replace('.', '', $this->total_value);
        }
        if ($this->down_payment) {
            $this->down_payment = str_replace('.', '', $this->down_payment);
        }

        // 2. VALIDACIÓN: Ahora que son números puros, validamos
        $this->validate();

        // 3. CÁLCULOS
        $saldo_a_financiar = (float)$this->total_value - (float)($this->down_payment ?? 0);
        $cantidad_cuotas = $this->installments_count > 0 ? $this->installments_count : 1;
        $valor_cuota = $saldo_a_financiar / $cantidad_cuotas;
        $primer_vencimiento = Carbon::now()->addMonth();

        // 4. GUARDADO DE CLIENTE
        $client = Client::create([
            'name' => $this->name,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        // 5. GUARDADO DE VENTA
        $sale = Sale::create([
            'client_id' => $client->id,
            'article' => $this->article,
            'total_value' => $this->total_value,
            'down_payment' => $this->down_payment ?? 0,
            'installments_count' => $this->installments_count,
            'installment_value' => $valor_cuota,
            'saldo_pendiente' => $saldo_a_financiar,
            'cuotas_restantes' => $this->installments_count,
            'valor_cuota_actual' => $valor_cuota,
            'proximo_vencimiento' => $primer_vencimiento,
            'estado' => 'al_dia'
        ]);

        // 6. GENERAR CUOTAS
        for ($i = 1; $i <= $this->installments_count; $i++) {
            Payment::create([
                'sale_id' => $sale->id,
                'numero_cuota' => $i,
                'monto' => $valor_cuota,
                'fecha_vencimiento' => Carbon::now()->addMonths($i),
                'estado' => 'pendiente',
            ]);
        }

        // 7. MENSAJE Y LIMPIEZA FINAL
        session()->flash('message', '¡Venta registrada con puntos procesados correctamente!');
        $this->reset(); 
    }

    public function render()
    {
        return view('livewire.venta-form');
    }
}