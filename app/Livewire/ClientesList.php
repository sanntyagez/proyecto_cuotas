<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale; // Asegúrate que tu modelo sea 'Sale' o 'sale' según tu archivo en Models
use Carbon\Carbon;

class ClientesList extends Component
{
    
   // Función para ELIMINAR
    public function deleteSale($saleId)
    {
        // Busca la venta
        $sale = Sale::find($saleId);

        if ($sale) {
            // Borra la venta (y las cuotas se borran solas por el efecto cascada)
            $sale->delete();
            session()->flash('message', 'Venta eliminada correctamente.');
        }
    }


   public function render()
    {
        // Traemos las ventas con el cliente
        // Si tienes datos viejos sin 'proximo_vencimiento', no fallará gracias a la vista
        $sales = Sale::with('client')->orderBy('created_at', 'desc')->get();

        return view('livewire.clientes-list', [
            'sales' => $sales
        ]);
    }
}