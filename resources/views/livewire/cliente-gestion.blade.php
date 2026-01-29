<div class="p-6 max-w-5xl mx-auto">
    <div class="mb-6 flex justify-between items-center border-b-2 border-blue-600 pb-2">
        <a href="/clientes" class="text-slate-500 hover:text-blue-600 font-bold text-sm transition">← VOLVER AL LISTADO</a>
        <h2 class="text-2xl font-bold dark:text-white text-slate-800 italic">Gestión de Cobro</h2>
    </div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg mb-8 border border-slate-200 dark:border-slate-700">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-xs font-black text-blue-600 uppercase tracking-widest">Ficha del Cliente</h3>
            
            @if(!$editando)
                <button wire:click="activarEdicion" class="bg-black hover:bg-slate-800 text-white px-4 py-1.5 rounded-lg text-xs font-bold uppercase transition">
                    Editar Datos
                </button>
            @else
                <button wire:click="guardarCambios" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-lg text-xs font-bold uppercase transition">
                    💾 Guardar
                </button>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <p class="text-xs text-slate-400 uppercase font-bold">Cliente</p>
                <p class="text-lg font-bold dark:text-white text-slate-800">{{ $sale->client->name }}</p>
                <p class="text-xs text-slate-500">DNI: {{ $sale->client->dni }}</p>
            </div>

            <div>
                <p class="text-xs text-slate-400 uppercase font-bold">Vehículo</p>
                <p class="text-lg font-medium dark:text-white text-slate-700">{{ $sale->article }}</p>
            </div>

            <div class="border-l border-slate-100 dark:border-slate-700 pl-4">
                <p class="text-xs text-slate-400 uppercase font-bold">Contacto</p>
                @if($editando)
                    <div class="mt-1 space-y-1">
                        <input type="text" wire:model="phone" class="w-full text-xs border-slate-300 rounded p-1 focus:ring-blue-500" placeholder="Teléfono">
                        <input type="text" wire:model="address" class="w-full text-xs border-slate-300 rounded p-1 focus:ring-blue-500" placeholder="Dirección">
                    </div>
                @else
                    <p class="text-sm font-bold dark:text-white text-slate-800">📞 {{ $sale->client->phone ?? 'No registrado' }}</p>
                    <p class="text-xs text-slate-500 mt-1">🏠 {{ $sale->client->address ?? 'Sin dirección' }}</p>
                @endif
            </div>

            <div class="bg-blue-50 dark:bg-slate-700 p-3 rounded-lg border border-blue-100 dark:border-blue-900">
                <p class="text-xs text-blue-500 dark:text-blue-300 uppercase font-bold">Saldo Pendiente</p>
                <p class="text-xl font-black text-blue-700 dark:text-blue-400">$ {{ number_format($sale->saldo_pendiente, 0, ',', '.') }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 font-bold mt-1">{{ $sale->cuotas_restantes }} de {{ $sale->installments_count }} cuotas</p>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-md font-bold text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-lg border border-slate-200 dark:border-slate-800 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-400 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Cuota</th>
                    <th class="px-6 py-4">Vencimiento</th>
                    <th class="px-6 py-4">Monto</th>
                    <th class="px-6 py-4 text-center">Estado</th>
                    <th class="px-6 py-4 text-center">Acción</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach($sale->payments as $payment)
                <tr class="dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                    <td class="px-6 py-4 font-bold">#{{ $payment->numero_cuota }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($payment->fecha_vencimiento)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 font-bold text-slate-800 dark:text-white">$ {{ number_format($payment->monto, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($payment->estado == 'pagado')
                            <span class="text-green-500 font-bold italic text-xs">✓ Pagado ({{ \Carbon\Carbon::parse($payment->fecha_pago)->format('d/m/Y') }})</span>
                        @else
                            <span class="text-amber-500 font-bold text-xs uppercase">Pendiente</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($payment->estado == 'pendiente')
                            <button 
                                wire:click="registrarPago({{ $payment->id }})"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow text-xs font-bold transition uppercase">
                                Cobrar
                            </button>
                        @else
                            <span class="text-slate-400 text-xs">---</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>