<div class="p-8 bg-white dark:bg-slate-900 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700">
    <form wire:submit.prevent="save" class="space-y-8">
        
        <div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 pb-2 border-b-2 border-slate-800 dark:border-slate-200">Datos del Cliente</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Nombre y Apellido</label>
                    <input type="text" wire:model="name" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white p-3 focus:ring-2 focus:ring-black focus:border-transparent transition">
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">D.N.I.</label>
                    <input type="text" wire:model="dni" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white p-3 focus:ring-2 focus:ring-black focus:border-transparent transition">
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Teléfono</label>
                    <input type="text" wire:model="phone" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white p-3 focus:ring-2 focus:ring-black focus:border-transparent transition">
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Dirección</label>
                    <input type="text" wire:model="address" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white p-3 focus:ring-2 focus:ring-black focus:border-transparent transition">
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 pb-2 border-b-2 border-slate-800 dark:border-slate-200">Datos de la Venta</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Artículo / Vehículo</label>
                    <input type="text" wire:model="article" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white p-3 focus:ring-2 focus:ring-black focus:border-transparent transition">
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Valor Total ($)</label>
                    <input type="number" wire:model="total_value" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white p-3 focus:ring-2 focus:ring-black focus:border-transparent transition">
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Entrega Inicial ($)</label>
                    <input type="number" wire:model="down_payment" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white p-3 focus:ring-2 focus:ring-black focus:border-transparent transition">
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Cantidad de Cuotas</label>
                    <input type="number" wire:model="installments_count" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white p-3 focus:ring-2 focus:ring-black focus:border-transparent transition">
                </div>
            </div>
        </div>

        <div class="pt-8">
            <button type="submit" 
                    style="background-color: #000000 !important; color: #ffffff !important;" 
                    class="w-full font-bold py-4 rounded-lg shadow-md transition-all uppercase tracking-widest flex items-center justify-center gap-3 hover:opacity-90 text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                GUARDAR 
            </button>
        </div>
    </form>
</div>