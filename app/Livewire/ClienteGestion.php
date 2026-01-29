<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Payment;
use Carbon\Carbon;

class ClienteGestion extends Component
{
    public $saleId;
    public $editando = false; // Nueva variable para saber si estamos editando
    public $phone, $address;  // Variables para guardar los cambios temporales

    public function mount($saleId)
    {
        $this->saleId = $saleId;
        $sale = Sale::find($saleId);
        $this->phone = $sale->client->phone;
        $this->address = $sale->client->address;
    }

    // Función para activar el modo edición
    public function activarEdicion()
    {
        $this->editando = true;
    }

    // Función para guardar los cambios del cliente
    public function guardarCambios()
    {
        $sale = Sale::find($this->saleId);
        $sale->client->update([
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        $this->editando = false;
        session()->flash('message', 'Datos de contacto actualizados.');
    }

    public function registrarPago($paymentId)
    {
        $payment = Payment::find($paymentId);
        $sale = Sale::find($this->saleId);

        if ($payment && $payment->estado == 'pendiente') {
            $payment->update([
                'estado' => 'pagado',
                'fecha_pago' => now(),
            ]);

            $nuevo_saldo = $sale->saldo_pendiente - $payment->monto;
            
            $sale->update([
                'saldo_pendiente' => max(0, $nuevo_saldo),
                'cuotas_restantes' => max(0, $sale->cuotas_restantes - 1),
                'proximo_vencimiento' => Carbon::parse($sale->proximo_vencimiento)->addMonth(),
            ]);

            session()->flash('message', '¡Pago registrado con éxito!');
        }
    }

    public function render()
    {
        $sale = \App\Models\sale::with(['client', 'payments'])->findOrFail($this->saleId);

        return view('livewire.cliente-gestion', [
            'sale' => $sale
        ]);
    }
}