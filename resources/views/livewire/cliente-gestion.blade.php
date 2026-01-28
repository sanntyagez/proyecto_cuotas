<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <a href="/clientes" class="text-indigo-600 hover:underline font-bold">← Volver al listado</a>
        <h2 class="text-2xl font-bold dark:text-white text-slate-800 text-right">Gestión de Cobro</h2>
    </div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg mb-8 border border-slate-200 dark:border-slate-700">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <p class="text-xs text-slate-500 uppercase font-bold">Cliente</p>
                <p class="text-lg font-medium dark:text-white">{{ $sale->client->name }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase font-bold">Vehículo</p>
                <p class="text-lg font-medium dark:text-white">{{ $sale->article }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase font-bold">Saldo Pendiente</p>
                <p class="text-xl font-bold text-indigo-600">$ {{ number_format($sale->saldo_pendiente, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase font-bold">Cuotas Restantes</p>
                <p class="text-lg font-medium dark:text-white">{{ $sale->cuotas_restantes }} de {{ $sale->installments_count }}</p>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow">
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
                <tr class="dark:text-slate-300">
                    <td class="px-6 py-4 font-bold">#{{ $payment->numero_cuota }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($payment->fecha_vencimiento)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 font-medium">$ {{ number_format($payment->monto, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($payment->estado == 'pagado')
                            <span class="text-green-500 font-bold italic">✓ Pagado ({{ \Carbon\Carbon::parse($payment->fecha_pago)->format('d/m/Y') }})</span>
                        @else
                            <span class="text-amber-500 font-bold">Pendiente</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($payment->estado == 'pendiente')
                            <button 
                                wire:click="registrarPago({{ $payment->id }})"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow text-xs font-bold transition">
                                COBRAR
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