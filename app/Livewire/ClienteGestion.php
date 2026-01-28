<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Payment;
use Carbon\Carbon;

class ClienteGestion extends Component
{
    public $saleId;

    public function mount($saleId)
    {
        $this->saleId = $saleId;
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
        // Usamos sale en minúscula si ese es el nombre de tu archivo de modelo
        $sale = \App\Models\sale::with(['client', 'payments'])->findOrFail($this->saleId);

        return view('livewire.cliente-gestion', [
            'sale' => $sale
        ]);
    }
}