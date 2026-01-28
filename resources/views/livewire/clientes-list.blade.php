<div class="p-6 bg-white dark:bg-slate-900 rounded-xl shadow-lg border border-slate-200 dark:border-slate-800">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Listado de Clientes</h2>
        <a href="/venta" class="bg-black text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-slate-800 transition">
            + Nueva Venta
        </a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400">
                <tr>
                    <th class="px-6 py-3">Cliente</th>
                    <th class="px-6 py-3">Vehículo</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3">Deuda Total</th>
                    <th class="px-6 py-3">Cuotas Rest.</th>
                    <th class="px-6 py-3">Próx. Venc.</th>
                    <th class="px-6 py-3 text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                <tr class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 transition">
                    
                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                        {{ $sale->client->name }} <br>
                        <span class="text-xs text-slate-500">DNI: {{ $sale->client->dni }}</span>
                    </td>

                    <td class="px-6 py-4">{{ $sale->article }}</td>

                    <td class="px-6 py-4">
                        @if($sale->saldo_pendiente <= 0)
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded border border-blue-400">🏁 PAGADO</span>
                        @elseif($sale->proximo_vencimiento && \Carbon\Carbon::parse($sale->proximo_vencimiento)->isPast())
                            <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-0.5 rounded border border-red-400">🔴 ATRASADO</span>
                        @else
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded border border-green-400">🟢 AL DÍA</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                        $ {{ number_format($sale->saldo_pendiente, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4 text-center">{{ $sale->cuotas_restantes }}</td>

                    <td class="px-6 py-4">
                        {{ $sale->proximo_vencimiento ? \Carbon\Carbon::parse($sale->proximo_vencimiento)->format('d/m/Y') : '-' }}
                    </td>

                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                        
                       <a href="{{ route('clientes.gestion', $sale->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-md text-xs uppercase text-decoration-none">
                        Gestionar
                       </a>

                        <button 
                            wire:click="deleteSale({{ $sale->id }})"
                            wire:confirm="¿Estás seguro de borrar este cliente? Se perderán todas sus cuotas."
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-md text-xs uppercase">
                            🗑️
                        </button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($sales->isEmpty())
            <div class="p-10 text-center text-slate-500">
                <p>No hay clientes cargados todavía.</p>
            </div>
        @endif
    </div>
</div>